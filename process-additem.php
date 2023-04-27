<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

$date = "2023-04-27";
$stmt = $mysqli->prepare("SELECT COUNT(date_posted) FROM item WHERE date_posted = ? AND poster = ?");
$stmt->bind_param("ss", $date, $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['COUNT(date_posted)'];
if ($count >= 3){
    echo "Can not post more than 3 items a day!";
} else{
    
    $sql = "INSERT INTO item(title, description, date_posted, price, poster)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $mysqli -> stmt_init();

    if (! $stmt -> prepare($sql)){
        die ("SQL error: " . $mysqli -> error);
    }

    $stmt ->bind_param("sssss",
                        $_POST["title"],
                        $_POST["description"],
                        $date,
                        $_POST["price"],
                        $_SESSION["user_id"]);

    if ($stmt -> execute()){
        $name = $_POST["name"];
        $last_id = $mysqli->insert_id;
        $sql = "INSERT INTO categories(name, c_item_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $name, $last_id);
        $stmt->execute();

        header("Location: additem-success.html");
        exit;

    } else {
    
        if ($mysqli->errno === 1062){
            echo("username/email already taken");
        } else {
            die($mysqli -> error . "  " . $mysqli->errno);
        }
    }
}
