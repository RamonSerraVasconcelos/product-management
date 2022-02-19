<?php
ob_start();
session_start();
include '../db/connection.php';

function login($email, $password)
{
    try {
        global $connection;

        $query = "SELECT id, password FROM users WHERE lower(email) = '$email'";
        $result = $connection->query($query);

        if ($result->num_rows == 0) return false;

        $row = mysqli_fetch_array($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION = array();
            $_SESSION["userId"] = $row["id"];
            return true;
        }

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function register($name, $email, $password)
{
    try {
        global $connection;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        $connection->query($query);

        if ($connection->affected_rows > 0) return true;

        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
