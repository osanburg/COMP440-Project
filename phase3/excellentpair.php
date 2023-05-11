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

            $query = "SELECT DISTINCT 
                        LEAST(p.poster, r.reviewer) AS user1,
                        GREATEST(p.poster, r.reviewer) AS user2
                    FROM 
                    (SELECT reviewer
                        FROM item_pr
                        WHERE score = 'excellent'
                        GROUP BY reviewer) AS r
                    JOIN 
                        (SELECT poster
                        FROM item_pr
                        WHERE score = 'excellent'
                        GROUP BY poster) AS p
                    ON p.poster IN 
                        (SELECT reviewer
                        FROM item_pr
                        WHERE score = 'excellent'
                        GROUP BY reviewer)
                    AND r.reviewer IN 
                        (SELECT poster
                        FROM item_pr
                        WHERE score = 'excellent'
                        GROUP BY poster)
                    AND p.poster <> r.reviewer";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                echo "User Pairs:<br><br>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo $row["user1"]. " - " . $row["user2"]. "<br>--------------------------------------------<br>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?> 
        <button onclick="window.location.href='http://localhost/COMP440-Project/index.php'">Go back to home page</button> 
    </div>
</div>



</body>

</html>