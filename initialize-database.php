<?php
$servername = "localhost";
$username = "root";
$password = "password123";
$dbname = "comp440";

// Create connection
$mysqli = new mysqli($servername, $username,$password, $dbname);
if($mysqli -> connect_errno){
    printf("Connection failed", $mysqli -> connect_error);
    exit();
}
printf("connected successfully... <br/>");

//create the user table if not created already
$sql = "create table user (username varchar(255) PRIMARY KEY, password varchar(255) NOT NULL, firstName varchar(255) NOT NULL, lastName varchar (255) NOT NULL, email varchar(255) NOT NULL UNIQUE KEY)";
if($mysqli->query($sql)){
    echo("Table 'user' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'user' already created. <br/>" , $mysqli->error);
}

//create the item table if not created already
$sql = "create table item (item_id int NOT NULL PRIMARY KEY, title varchar(255) NOT NULL, description varchar(255) NOT NULL, date_posted char (10) NOT NULL, price float NOT NULL)";
if($mysqli->query($sql)){
    echo("Table 'item' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'item' already created. <br/>" , $mysqli->error);
}

//create the categories table if not created already
$sql = "create table categories (name varchar(15) NOT NULL PRIMARY KEY, c_item_id int NOT NULL, FOREIGN KEY (c_item_id) REFERENCES item(item_id))";
if($mysqli->query($sql)){
    echo("Table 'categories' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'categories' already created. <br/>" , $mysqli->error);
}

//create the review table if not created already
$sql = "create table reviews (r_item_id int NOT NULL, username varchar(255) NOT NULL, date char(10) NOT NULL, score varchar(10) NOT NULL, remark varchar(255) NOT NULL, FOREIGN KEY (r_item_id) REFERENCES item(item_id), FOREIGN KEY (username) REFERENCES user(username))";
if($mysqli->query($sql)){
    echo("Table 'reviews' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'reviews' already created. <br/>" , $mysqli->error);
}

//inserting User data

$username = "Bidenator";
$password = "hello2023";
$firstName = "Joe";
$lastName = "Biden";
$email = "USpresident@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Data already inserted...<br/>", $mysqli -> error);
}
$username = "Billybob";
$password = "yeehaw";
$firstName = "Billy";
$lastName = "bob";
$email = "billybob@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Data already inserted...<br/>", $mysqli -> error);
}
$username = "Donny123";
$password = "password";
$firstName = "Donald";
$lastName = "Trump";
$email = "realdonaldtrump@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Data already inserted...<br/>", $mysqli -> error);
}
$username = "Unknownperson";
$password = "unknown";
$firstName = "John";
$lastName = "Doe";
$email = "jd@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Data already inserted...<br/>", $mysqli -> error);
}
$username = "WhoisJoe?";
$password = "idk";
$firstName = "Joe";
$lastName = "Mama";
$email = "gottem@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Data already inserted...<br/>", $mysqli -> error);
}

//Insert Review Data


$mysqli -> close();

?>