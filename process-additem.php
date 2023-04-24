<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO item(title, description, date_posted, price)
        VALUES (?, ?, ?, ?, ?);
        INSERT INTO categories(name) VALUE (?)";



$stmt = $mysqli -> stmt_init();

if (! $stmt -> prepare($sql)){
    die ("SQL error: " . $mysqli -> error);
}

echo $_POST["date_posted"];
var_dump($_POST["date_posted"]);

$stmt ->bind_param("ssssss",
                   $_POST["title"],
                   $_POST["description"],
                   $_POST["date_posted"],
                   $_POST["price"],
                   $_POST["name"]);

if ($stmt -> execute()){

    header("Location: additem-success.html");
    exit;

} else {
    
    if ($mysqli->errno === 1062){
        echo("username/email already taken");
    } else {
    die($mysqli -> error . "  " . $mysqli->errno);
    }
}
