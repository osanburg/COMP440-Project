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
<div class="row">
    <div class="column">
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

            $sql = "SELECT username,r_item_id,score FROM reviews WHERE score = 'poor' ";
            $result = $conn->query($sql);
       
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> User: " .$row["username"]. "<br>Item ID: " .$row["r_item_id"]. "<br> Score: " .$row["score"]. "<br>--------------------------";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>  
    </div>
</div>



</body>

</html>



