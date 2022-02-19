<?php

ob_start();
session_start();
include '../db/connection.php';

function create($name)
{
    try {
        global $connection;

        $query = "INSERT INTO tag (name) VALUES ('$name')";
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
        $html = "";

        foreach ($result as $row) {
            $html .= "<tr>";
            $html .= "  <td>" . $row["name"] . "</td>";
            $html .= "  <td><a onclick=\"editTag(" . $row["id"] . ")\" href=\"#\"><i style=\"color: #47281f\" class=\"material-icons\">edit</i></a></td>";
            $html .= "  <td><a onclick=\"LoadTagProducts(" . $row["id"] . ")\" href=\"#\"><i style=\"color: #47281f\" class=\"material-icons\">visibility</i></a></td>";
            $html .= "  <td><a onclick=\"deleteTag(" . $row["id"] . ")\" href=\"#\"><i style=\"color: #47281f\" class=\"material-icons\">delete</i></a></td>";
            $html .= "</tr>";
        }

        return $html;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function LoadTagProducts($id)
{
    try {
        global $connection;

        $query = "SELECT p.name FROM product p LEFT join product_tag pt ON p.id = pt.product_id WHERE pt.tag_id = $id";
        $result = $connection->query($query);
        $html = "<div class='text-center'>";

        foreach ($result as $row) {
            $html .= "  <h3>" . $row["name"] . "</h3>";
        }

        $html .= "</div>";

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

        $query = "SELECT * FROM tag WHERE id = $id";
        $result = $connection->query($query);

        $tag = mysqli_fetch_array($result);

        return $tag["name"];
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function update($id, $name)
{
    try {
        global $connection;

        $query = "UPDATE tag SET name = '$name' WHERE id = $id";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function delete($id)
{
    try {
        global $connection;

        $query = "DELETE FROM tag WHERE id = $id";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
