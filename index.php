<?php
session_start();

//import of the sql file
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["database"]["name"] != '')
 {
  $array = explode(".", $_FILES["database"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
   $connect = mysqli_connect("localhost", "root", "password123", "comp440");
   $output = '';
   $count = 0;
   $file_data = file($_FILES["database"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($connect, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    $message = '<label class="text-danger">There is an error in Database Import</label>';
   }
   else
   {
    $message = '<label class="text-success">Database Successfully Imported</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger">Invalid File</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select Sql File</label>';
 }
}

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
        <p>Hello <?= htmlspecialchars($user["firstName"]) ?></p>
        <p><a href="logout.php">Log out</a></p>
        <div class="container" style="width:700px;">  
        <br/>
        <div><?php echo $message; ?></div>
        <form method="post" enctype="multipart/form-data">
            <p><label>Select Sql File</label>
            <input type="file" name="database" /></p>
            <br />
            <input type="submit" name="import" class="btn btn-info" value="Import" />
        </form>
        </div>  
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a> </p>
    <?php endif; ?>

</body>
</html>