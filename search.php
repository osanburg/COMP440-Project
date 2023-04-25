<?php

$search = $_POST['search'];

$servername = "localhost";
$username = "root";
$password = "password123";
$db = "comp440";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT item.title, categories.name from item 
    inner join categories
    on item.item_id=categories.c_item_id
    where item.title='%$search%'";

$result = $conn->query($sql);

if ($result ->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo "<br> Item #: " .$row["item_id"]."<br>Item Name: ".$row["title"]."<br>Category:".$row['name']. "<br> Description: ".$row["description"]."<br>";
}
} else {
	echo "0 records";
}

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
</head>
<body>
	<br><br>
    <p>Search complete,
        <a href="index.php">click here </a>
     to return to main page.</p> 
        
</body>
</html>
