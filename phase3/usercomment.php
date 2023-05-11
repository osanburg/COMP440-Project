<!DOCTYPE html>
<html>
<head>
    <title>Never Poor Review</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
<style>
*{
    box-sizing: border-box;
}
.button{
    border-radius: 8px;
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
    <h1>Search Positively Reviewed Items of User</h1>
    <form action="usercomment.php" method="post">
        <label for="poster_name">Poster Name:</label>
        <input type="text" id="poster_name" name="poster_name" value=""><br><br>
        <input type="submit" value="Search">
    </form>

<div class="row">
    <div class="column">
      <?php //Database function to display things on page for a logged in user
            error_reporting(E_ALL ^ E_NOTICE);
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

            // prepare and bind input parameter
            $poster_name = $_POST["poster_name"];
            $stmt = $conn->prepare("SELECT item.title, item.description, item.date_posted, item.price, item.poster 
                        FROM item 
                        INNER JOIN reviews ON item.item_id = reviews.r_item_id 
                        WHERE item.poster = ? AND (reviews.score = 'good' OR reviews.score = 'excellent')");

            $stmt->bind_param("s", $poster_name);
            $stmt->execute();

            // store result
            $result = $stmt->get_result();

            // check if any result is found
            if ($result->num_rows > 0) {
            // loop through result and output data
            while($row = $result->fetch_assoc()) {
                echo "Title: " . $row["title"]. "<br>";
                echo "Description: " . $row["description"]. "<br>";
                echo "Date Posted: " . $row["date_posted"]. "<br>";
                echo "Price: " . $row["price"]. "<br>";
                echo "Poster: " . $row["poster"]. "<br><br>";
            }
            } else {
                echo "0 results";
            }

            // close prepared statement and database connection
            $stmt->close();
            $conn->close();
            ?> 
    </div>
    <button onclick="window.location.href='http://localhost/COMP440-Project/index.php'">Go back to home page</button>  
</div>


</body>

</html>