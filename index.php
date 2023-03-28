<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
</head>
<body>

    <h1>Home</h1>
    <?php if (isset($_SESSION["user_id"])): ?>
        <p>Hello User!</p>
       
        <p><a href="logout.php">Log out</a></p>
       
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a> </p>
        <form action="initialize-database.php">
        <button>Initialize Database</button>
        </form>
    <?php endif; ?>

</body>
</html>