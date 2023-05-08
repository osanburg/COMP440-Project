<?php
session_start();
include 'database.php';
?>

<?php

// Connect to the MySQL database for the search
$servername = "localhost";
$username = "root";
$password = "password123";
$dbname = "comp440";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database based on user input
if(isset($_POST['search'])){
  $search = $_POST['search'];
  $sql = "SELECT item.item_id, item.title, item.description, item.price, categories.name
  FROM item
  INNER JOIN categories ON item_id = c_item_id
  WHERE item.item_id LIKE '%$search%' OR item.title LIKE '%$search%' OR categories.name LIKE '%$search%' OR item.description LIKE '%$search%' OR item.price LIKE '%$search%'";
  $result = $conn->query($sql); 
}

if(isset($_POST['review'])){

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
<style>
*{
    box-sizing: border-box;
}
button{
    border-radius: 8px;
    font-size: 17px;
    padding: 5px;
}

.column {
 flex: 30%;
 padding: 15px;
 border: 5px solid lightblue;
 border-radius: 12px;
}
body{
  max-width: fit-content;
}

/* Clear floats after the columns */
.row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
}
</style>
</head>
<body>

    <h1>Home</h1>
    <?php if (isset($_SESSION["user_id"])): ?>

    <div class="row">
        <div class="column">
        <p>Hello User!</p>

      <form method="POST">
        <label>Looking for a Specific Item?</label>
        <input type="text" name="search">
        <button type="submit">Search</button>
      </form>

<?php
if(isset($_POST['search']) && $result->num_rows > 0) {
  echo "<table>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<br>ID: ".$row['item_id']. "<br> Item: ". $row["title"]. " <br> Description: ". $row["description"]. "<br> Category: ". $row["name"]. " <br> Price: $" . $row["price"] . "<br>--------------------------";
    echo "</tr>";
  }

} else if(isset($_POST['search'])) {
  echo "No data found";
}
?> 
        <p><a href="additem.html">Add an Item</a></p>
        <p><a href="review.php">Write a review on a product?</a></p>
        <p><a href="logout.php">Log out</a></p>
        </div>


        <div class="column">
            <h2>Some of our items in stock!!</h2>
            <?php //Database function to display things on page for a logged in user
            $servername = "localhost";
            $username = "root";
            $password = "password123";
            $dbname = "comp440";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT item.title, item.description, item.price, categories.name FROM item INNER JOIN
            categories WHERE item.item_id = categories.c_item_id";
            $result = $conn->query($sql);
       
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> Item: ". $row["title"]. " <br> Description: ". $row["description"]. "<br> Category: ". $row["name"]. " <br> Price: $" . $row["price"] . "<br>--------------------------";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>


          <div class="column">
              <h2>Looking for specifics?</h2>
              <form action = "phase3/expensiveitems.php">
                <button>1. Most expensive items</button>
                </form><br>
                  <form action = "phase3/twoitems.php">
                <button>2. List the users who posted at least two items that are posted on the same day, one has a category
                        of X, and another has a category of Y </button>
                </form><br>
                <form action = "phase3/usercomment.php">
                <button>3. List all the items posted by user X, such that all the comments are "Excellent" or "good" for
                          these items</button>
                </form><br>
                <form action = "phase3/mostdate.php">
                <button>4. List the users who posted the most number of items since 5/1/2020 (inclusive); if there is a tie,
                        list all the users who have a tie</button>
                </form><br>
                <form action = "phase3/dropdownfavorite.php">
                <button>5. List the other users who are favorited by both users X, and Y. Usernames X and Y will be
                        selected from dropdown menus by the instructor</button>
                </form><br>
                <form action = "phase3/excellentreviews.php">
                <button>6. Display all the users who never posted any "excellent" items: an item is excellent if at least
                          three reviews are excellent</button>
                </form><br>
                <form action = "phase3/neverpoor.php">
                <button>7. Users who never posted a "poor" review</button>
                </form><br>
                <form action = "phase3/eachpoor.php">
                <button>8. Display all the users who posted some reviews, but each of them is "poor"</button>
                </form><br>
                <form action = "phase3/userneverpoor.php">
                <button>9. Display those users such that each item they posted so far never received any "poor" reviews</button>
                </form><br>
                <form action = "phase3/excellentpair.php">
                <button>10. User pair (A/B) such that they always give each other "excellent" reviews</button>
                </form>
          </div>


    </div>   
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        <form action="initialize-database.php">
        <button>Initialize Database</button>
        </form>


    <?php endif; ?>

</body>
</html>
