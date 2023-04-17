<?php
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO item(title, description, price)
        VALUES (?, ?, ?)";
$sql = "INSERT INTO categories(name) VALUES (?)";


$stmt = $mysqli -> stmt_init();

if (! $stmt -> prepare($sql)){
    die ("SQL error: " . $mysqli -> error);
}

$stmt ->bind_param("ssss",
                   $_POST["title"],
                   $_POST["description"],
                   $_POST["name"],
                   $_POST["price"]);

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
