<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO item(title, description, date_posted, price, poster)
        VALUES (?, ?, ?, ?, ?)";
$sql = "INSERT INTO categories(name) VALUES (?)";


$stmt = $mysqli -> stmt_init();

if (! $stmt -> prepare($sql)){
    die ("SQL error: " . $mysqli -> error);
}

echo $_POST["currentDate"];
var_dump($_POST["currentDate"]);

$stmt ->bind_param("ssssss",
                   $_POST["title"],
                   $_POST["description"],
                   $_POST["price"],
                   $_POST["currentDate"],
                   $_SESSION["user_id"],
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
