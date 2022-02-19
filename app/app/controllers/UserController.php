<?php
include '../db/connection.php';
include '../models/User.php';

if ($_POST["request"] == 'login') {
    if (login($_POST["email"], $_POST["password"])) {
        $return_arr = array("success" => true);
        echo json_encode($return_arr);
        return true;
    }

    echo json_encode(array("success" => false));
} else if ($_POST["request"] == 'register') {

    $fields = array('name', 'email', 'password');
    for ($i = 1; $i < count($fields); $i++) {
        if ($_POST[$fields[$i]] == '') {
            echo json_encode(array("success" => false, "error" => "Todos os campos são necessários."));
            return false;
        }
    }

    if (register($_POST["name"], $_POST["email"], $_POST["password"])) {
        $return_arr = array("success" => true);
        echo json_encode($return_arr);
        return true;
    }

    echo json_encode(array("success" => false, "error" => "Acontece um erro inesperado. Por favor tente novamente."));
} else if ($_POST["request"] == 'logout') {
    session_destroy();
    echo json_encode(array("success" => true));
}
