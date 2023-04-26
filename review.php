<?php

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "password123";
$dbname = "comp440";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the item ID and review data from the form submission
$item_id = $_POST['item_id'];
$review_text = $_POST['remark'];
$score = $_POST['score'];

// Get the ID of the currently logged-in user (assuming you have a user authentication system)
$user_id = $_SESSION['user_id'];

$sql = "SELECT username FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $username = $row['username'];
} else {
  $username = "unknown user";
}

// Insert the new review into the database
$sql = "INSERT INTO reviews (r_item_id, username, date, score, remark) VALUES ('$item_id', '$username', NOW(), '$score', '$review_text')";
$result = $conn->query($sql);

// Close the database connection
$conn->close();

?>