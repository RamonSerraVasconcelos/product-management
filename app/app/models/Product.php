<?php

ob_start();
session_start();
include '../db/connection.php';

function upload($arrArquivo, $arrExt, $dir = "../temp/", $nome = '', $tamBytes = 5242880)
{
    try {
        if (($arrArquivo) && (file_exists($arrArquivo['tmp_name'])) && (filesize($arrArquivo['tmp_name']) > 0)) {

            $ext = getExtension($arrArquivo['name']);
            if ($nome == '') {
                $dest = "upfile_" . date("s") . rand(1000, 9999) . '.' . $ext;
            } else {
                $dest = $nome . '.' . $ext;
            }
            $file_dest = $dir . $dest;

            if (($arrArquivo['size'] > $tamBytes) && ($arrArquivo['size'] == 0)) {
                return false;
            }

            if (!in_array($arrArquivo['type'], $arrExt)) {
                return false;
            }

            if (move_uploaded_file($arrArquivo['tmp_name'], $file_dest)) {
                return $dest;
            } else {
                return false;
            }
        } else {
            return false;
        }

        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function getExtension($arquivo)
{
    $arr = explode(".", $arquivo);
    return $arr[count($arr) - 1];
}

function create($name, $price)
{
    try {
        global $connection;

        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);

        $query = "INSERT INTO product (name, price) VALUES ('$name', '$price')";
        $connection->query($query);

        if ($connection->affected_rows > 0) {
            return mysqli_insert_id($connection);
        }

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function uploadProductImage($files, $id)
{
    try {
        $dir_temp = "../../public/images/temp";

        $dir_images = "../../public/images/";

        $fileToUpload = upload($files['fileToUpload'], array("image/gif", "image/jpg", "image/jpeg", "image/pjpeg", "image/png"), $dir_temp);

        $nFile = 'thumb_' . $id . '.jpg';

        $newImg = $dir_temp . $fileToUpload;

        rename($newImg, $dir_images . $nFile);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function loadProducts()
{
    try {
        global $connection;

        $query = "SELECT * FROM product ORDER BY name";
        $result = $connection->query($query);
        $html = "";

        foreach ($result as $row) {

            $queryTags = "SELECT t.name FROM product_tag p LEFT JOIN tag t ON p.tag_id = t.id WHERE p.product_id = " . $row["id"];
            $resultTag = $connection->query($queryTags);

            $thumb = file_exists('../../public/images/thumb_' . $row["id"] . '.jpg') ? 'thumb_' . $row["id"] . '.jpg' : 'promobit.png';

            $html .= "<a class='myCards' href='javascript:editProduct(" . $row["id"] . ")'>";
            $html .= "  <div class='product'>";
            $html .= "      <div class='product-title'>";
            $html .= "          <h3>" . $row["name"] . "</h3>";
            $html .= "      </div>";
            $html .= "      <div class='product-description text-center'>";
            $html .= "          <img style='max-width: 200px;' src='public/images/$thumb'>";
            $html .= "      </div>";
            $html .= "      <div class='product-description text-center'>";
            $html .= "          <h3>R$ " . number_format($row["price"], 2, ",", ".") . "</h3>";
            $html .= "      </div>";
            $html .= "      <div class='product-description text-center' style='padding:0 !important'>";

            if (!empty($resultTag->num_rows)) {
                $html .= "      <p>Tags: ";
                foreach ($resultTag as $tag) {
                    $html .= "       " . $tag["name"] . ", ";
                }
                $html = rtrim($html, ", ");
                $html .= "      </p>";
            }

            $html .= "      </div>";
            $html .= "  </div>";
            $html .= "</a>";
        }

        return $html;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function edit($id)
{
    try {
        global $connection;

        $query = "SELECT * FROM product WHERE id = $id";
        $result = $connection->query($query);

        $product = mysqli_fetch_array($result);

        return array("name" => $product["name"], "price" => number_format($product["price"], 2, ",", "."));
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function update($id, $name, $price)
{
    try {
        global $connection;

        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);

        $query = "UPDATE product SET name = '$name', price = '$price' WHERE id = $id";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function loadTags()
{
    try {
        global $connection;

        $query = "SELECT * FROM tag ORDER BY name";
        $result = $connection->query($query);
        $html = "<option value='-1'>Selecione</option>";

        foreach ($result as $row) {
            $html .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
        }

        return $html;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function addTag($product, $tag)
{
    try {
        global $connection;

        $query = "INSERT INTO product_tag (product_id, tag_id) VALUES ('$product', '$tag')";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function loadProductTags($id)
{
    try {
        global $connection;

        $query = "SELECT p.tag_id, t.name FROM product_tag p JOIN tag t ON p.tag_id = t.id WHERE p.product_id = $id";
        $result = $connection->query($query);
        $html = "";

        foreach ($result as $row) {
            $html .= "<tr>";
            $html .= "  <td>" . $row["name"] . "</td>";
            $html .= "  <td><a onclick=\"deleteProductTag(" . $row["tag_id"] . ")\" href=\"#\"><i style=\"color: #47281f\" class=\"material-icons text-danger\">delete</i></a></td>";
            $html .= "</tr>";
        }

        return $html;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function delete($id)
{
    try {
        global $connection;

        $query = "DELETE FROM product WHERE id = $id";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function deleteProductTag($product, $tag)
{
    try {
        global $connection;

        $query = "DELETE FROM product_tag WHERE product_id = '$product' AND tag_id = '$tag'";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
