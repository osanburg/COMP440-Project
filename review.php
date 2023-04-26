<!DOCTYPE html>
<html>
<head>
	<title>Review</title>
  <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">

</head>
<body>
	<h1>Item Review</h1>

	<?php
	// database connection information
	$servername = "localhost";
	$username = "root";
	$password = "password123";
	$dbname = "comp440";

	// create database connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// check database connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// fetch items from database
	$sql = "SELECT item_id, title, description, price FROM item";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // display items in a dropdown menu
	    echo "<form method='post'>";
	    echo "<select name='item_id'>";
	    echo "<option value=''>Select an item to review</option>";
	    while($row = $result->fetch_assoc()) {
	        echo "<option value='" . $row["item_id"] . "'>" . $row["title"] . "</option>";
	    }
	    echo "</select>";
	    echo "<br><br>";
	    
	    // display rating options
	    echo "Rating: ";
	    echo "<select name='rating'>";
	    echo "<option value='poor'>poor</option>";
	    echo "<option value='fair'>fair</option>";
	    echo "<option value='good'>good</option>";
	    echo "<option value='excellent'>excellent</option>";
	    echo "</select>";
	    echo "<br><br>";

	    // display review text box
	    echo "Review: ";
	    echo "<textarea name='review'></textarea>";
	    echo "<br><br>";

	    // display submit button
	    echo "<input type='submit' name='submit' value='Submit Review'>";
	    echo "</form>";

	    // process submitted review
	    if(isset($_POST['submit'])) {
	    	$item_id = $_POST['item_id'];
        $username = $_SESSION['user_id'];
	    	$rating = $_POST['rating'];
	    	$review = $_POST['review'];
	    	$date = date("Y-m-d");

	    	// insert review into database
	    	$sql = "INSERT INTO reviews (r_item_id, username, date, score, remark) VALUES ('$item_id', '$username','$date', '$rating', '$review')";
	    	if ($conn->query($sql) === TRUE) {
			    echo "Review submitted successfully!";
			} else {
			    echo "Error submitting review: " . $conn->error;
			}
	    }
	} else {
	    echo "No items found";
	}

	// close database connection
	$conn->close();
	?>
</body>
</html>