<!DOCTYPE html>
<html>
<head>
	<title>Favorited by Both</title>
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
	<h1>Favorited by Both Users Search</h1>
	<form method="post">
		<label for="user1">User 1:</label>
		<select name="user1" id="user1">
			<?php
				$conn = mysqli_connect('localhost', 'root', 'password123', 'comp440');
				if (!$conn) {
					die('Connection failed: ' . mysqli_connect_error());
				}
				$sql = "SELECT username FROM user";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo '<option value="' . $row["username"] . '">' . $row["username"] . '</option>';
					}
				}
				mysqli_close($conn);
			?>
		</select>
		<label for="user2">User 2:</label>
		<select name="user2" id="user2">
			<?php
				$conn = mysqli_connect('localhost', 'root', 'password123', 'comp440');
				if (!$conn) {
					die('Connection failed: ' . mysqli_connect_error());
				}
				$sql = "SELECT username FROM user";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo '<option value="' . $row["username"] . '">' . $row["username"] . '</option>';
					}
				}
				mysqli_close($conn);
			?>
		</select>
		<input type="submit" value="Search">
	</form>
	<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$user1 = $_POST['user1'];
			$user2 = $_POST['user2'];

			$conn = mysqli_connect('localhost', 'root', 'password123', 'comp440');
			if (!$conn) {
				die('Connection failed: ' . mysqli_connect_error());
			}
			$sql = "SELECT favorite 
                FROM favorite_user 
                WHERE f_user = '$user1' 
                AND favorite IN (SELECT favorite 
                    FROM favorite_user WHERE f_user = '$user2')";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				echo '<h2>Shared Favorites</h2>';
				echo '<ul>';
				while($row = mysqli_fetch_assoc($result)) {
					echo '<li>' . $row["favorite"] . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<h2>No Shared Favorites Found</h2>';
			}
			mysqli_close($conn);
		}
	?>
</body>
</html>
        