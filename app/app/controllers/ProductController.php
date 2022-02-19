<?php
include '../db/connection.php';
include '../models/Product.php';

if ($_POST["request"] == 'create') {

    if ($_POST["id"] == -1) {
        if ($id = create($_POST["name"], $_POST["price"])) {
            echo json_encode(array("success" => true, "id" => $id));
            return true;
        }
    } else {
        if (update($_POST["id"], $_POST["name"], $_POST["price"])) {
            echo json_encode(array("success" => true, "id" => $_POST["id"]));
            return true;
        }
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'uploadProductImage') {
    if (uploadProductImage($_FILES, $_POST["id"])) {
        echo json_encode(array("success" => true));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'loadProducts') {
    if ($products = loadProducts()) {
        echo json_encode(array("success" => true, "html" => $products));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'edit') {
    if ($product = edit($_POST["id"])) {
        echo json_encode(array("success" => true, "name" => $product["name"], "price" => $product["price"]));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'delete') {
    if (delete($_POST["id"])) {
        echo json_encode(array("success" => true));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'loadTags') {
    if ($tags = loadTags()) {
        echo json_encode(array("success" => true, "html" => $tags));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'addTag') {
    if (addTag($_POST["product"], $_POST["tag"])) {
        echo json_encode(array("success" => true));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'loadProductTags') {
    if ($productTags = loadProductTags($_POST["id"])) {
        echo json_encode(array("success" => true, "html" => $productTags));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'deleteProductTag') {
    if (deleteProductTag($_POST["product"], $_POST["tag"])) {
        echo json_encode(array("success" => true));
        return true;
    }

    echo json_encode(array("success" => false));
}
