<?php

$host = "localhost";
$dbname = "comp440";
$username = "root";
$password = "password123";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;