<!DOCTYPE html>
<html>
<head>
    <title>Most by Date</title>
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
<div class="row">
    <div class="column">

    <form method="post">
        <label for="item_name1">Category Name 1:</label>
        <input type="text" name="item_name1" id="item_name1" required>
        <br><br>
        <label for="item_name2">Category Name 2:</label>
        <input type="text" name="item_name2" id="item_name2" required>
        <br><br>
        <input type="submit" name="submit" value="Search">
    </form>

<?php //Database function to display things on page for a logged in user
            $servername = "localhost";
            $username = "root";
            $password = "password123";
            $dbname = "comp440";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
           // check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if the form was submitted
if (isset($_POST['submit'])) {
    // get the item names from the form
    $itemName1 = $_POST['item_name1'];
    $itemName2 = $_POST['item_name2'];

    // SQL query to retrieve posters who have posted at least twice in a day for the specified items
    $sql = "SELECT ci1.poster, ci1.date_posted
            FROM categorized_items ci1
            JOIN categorized_items ci2 ON ci1.poster = ci2.poster
            WHERE ci1.name = '$itemName1' AND ci2.name = '$itemName2'
            AND DATE(ci1.date_posted) = DATE(ci2.date_posted)
            AND ci1.title <> ci2.title
            GROUP BY ci1.poster, ci1.date_posted";

    // execute the query
    $result = $conn->query($sql);

    // check for errors
    if (!$result) {
        die("Error: " . $sql . "<br>" . $conn->error);
    }

    // display the results
    if ($result->num_rows > 0) {
        echo "<h2>Posters who have posted at least twice in a day for the items '$itemName1' and '$itemName2':</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Poster: " . $row['poster'] . ", Date Posted: " . $row['date_posted'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No posters found.";
    }

    // close the database connection
    $conn->close();
}
?> 
    </div>
</div>



</body>

</html>