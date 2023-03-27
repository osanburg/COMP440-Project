<?php

if($_POST["password"] !== $_POST["password_confirmation"]){
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user(username, firstName, lastName, email, password, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli -> stmt_init();

if (! $stmt -> prepare($sql)){
    die ("SQL error: " . $mysqli -> error);
}

$stmt ->bind_param("ssssss",
                   $_POST["username"],
                   $_POST["firstName"],
                   $_POST["lastName"],
                   $_POST["email"],
                   $_POST["password"], 
                    $password_hash);

if ($stmt -> execute()){

    header("Location: signup-success.html");
    exit;

} else {
    
    if ($mysqli->errno === 1062){
        echo("email already taken");
    } else {
    die($mysqli -> error . "  " . $mysqli->errno);
    }
}
