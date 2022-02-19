<?php
include '../db/connection.php';
include '../models/Tag.php';

if ($_POST["request"] == 'create') {

    if ($_POST["id"] == -1) {
        if (create($_POST["name"])) {
            echo json_encode(array("success" => true));
            return true;
        }
    } else {
        if (update($_POST["id"], $_POST["name"])) {
            echo json_encode(array("success" => true));
            return true;
        }
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'loadTags') {
    if ($tags = loadTags()) {
        echo json_encode(array("success" => true, "html" => $tags));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'edit') {
    if ($tag = edit($_POST["id"])) {
        echo json_encode(array("success" => true, "name" => $tag));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'delete') {
    if (delete($_POST["id"])) {
        echo json_encode(array("success" => true));
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'LoadTagProducts') {
    if ($tag = LoadTagProducts($_POST["id"])) {
        echo json_encode(array("success" => true, "html" => $tag));
        return true;
    }

    echo json_encode(array("success" => false));
}
