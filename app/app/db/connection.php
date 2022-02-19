<?php

$host = "mysql";
$banco = "promobit";
$user = $_ENV['MYSQL_USER'];
$pass = $_ENV['MYSQL_PASS'];

$connection = new mysqli($host, $user, $pass, $banco);
