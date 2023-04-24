<?php
session_start();
include 'database.php';
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
.button{
    border-radius: 8px;
}
.column {
 flex: 50%;
}

/* Clear floats after the columns */
.row {
display: flex;
}
</style>
</head>
<body>

    <h1>Home</h1>
    <?php if (isset($_SESSION["user_id"])): ?>

    <div class="row">
        <div class="column">
        <p>Hello User!</p>

        <form action="search.php" method="post">Search for an Item <br> by Name or Category<input type="text" name="search"><br>
        <input type ="submit">
        </form>
        
        <p><a href="additem.html">Add an Item</a></p>
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
    </div>   
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        <form action="initialize-database.php">
        <button>Initialize Database</button>
        </form>


    <?php endif; ?>

</body>
</html>

<?php 
$con = new PDO("mysql:host=localhost; dbname=comp440", 'root','password123');

if(isset($_POST["submit"])){
    $str = $_POST["item"];
    $sth = $con->prepare("SELECT * FROM 'item' WHERE title = '$str'");
    
    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth-> execute();

    if($row = $sth->fetch())
    {
        ?>
        <br><br><br>
        <table>
            <tr>
                <th>title</th>
                <th>description</th>
            </tr>
            <tr>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->description; ?></td>

            </tr>
        </table>
       <?php     
    }
    else{
        echo "Item not existent...";
    }
}
?>