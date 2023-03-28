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
$sql = "create table user (username varchar(255) PRIMARY KEY, password varchar(255) NOT NULL, 
    firstName varchar(255) NOT NULL, lastName varchar (255) NOT NULL, 
    email varchar(255) NOT NULL UNIQUE KEY)";
if($mysqli->query($sql)){
    echo("Table 'user' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'user' already created. <br/>" , $mysqli->error);
}

//create the item table if not created already
$sql = "create table item (item_id int NOT NULL PRIMARY KEY, title varchar(255) NOT NULL, 
    description varchar(255) NOT NULL, date_posted char (10) NOT NULL, price float NOT NULL)";
if($mysqli->query($sql)){
    echo("Table 'item' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'item' already created. <br/>" , $mysqli->error);
}

//create the categories table if not created already
$sql = "create table categories (name varchar(15) NOT NULL PRIMARY KEY, c_item_id int NOT NULL, 
    FOREIGN KEY (c_item_id) REFERENCES item(item_id))";
if($mysqli->query($sql)){
    echo("Table 'categories' created successfully. <br/>");
}
if($mysqli->errno){
    printf("Table for 'categories' already created. <br/>" , $mysqli->error);
}

//create the review table if not created already
$sql = "create table reviews (r_item_id int NOT NULL, username varchar(255) NOT NULL, 
    date char(10) NOT NULL, score varchar(10) NOT NULL, remark varchar(255) NOT NULL, 
    FOREIGN KEY (r_item_id) REFERENCES item(item_id), 
    FOREIGN KEY (username) REFERENCES user(username))";
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
$sql = "insert into user (username, password, firstName, lastName, email) 
    values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("User data already inserted...<br/>", $mysqli -> error);
}
$username = "Billybob";
$password = "yeehaw";
$firstName = "Billy";
$lastName = "bob";
$email = "billybob@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) 
    values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("User data already inserted...<br/>", $mysqli -> error);
}
$username = "Donny123";
$password = "password";
$firstName = "Donald";
$lastName = "Trump";
$email = "realdonaldtrump@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email)
    values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("User data already inserted...<br/>", $mysqli -> error);
}
$username = "Unknownperson";
$password = "unknown";
$firstName = "John";
$lastName = "Doe";
$email = "jd@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) 
    values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("User data already inserted...<br/>", $mysqli -> error);
}
$username = "WhoisJoe?";
$password = "idk";
$firstName = "Joe";
$lastName = "Mama";
$email = "gottem@fakemail.com";
$sql = "insert into user (username, password, firstName, lastName, email) 
    values ('".$username."', '".$password."', '".$firstName."', '".$lastName."','".$email."')";
if($mysqli ->query($sql)){
    echo("User data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("User data already inserted...<br/>", $mysqli -> error);
}

//Insert Item Data
$item_id = 10001;
$title = "Smartphone";
$description = "the new iphone 14";
$date_posted = "2022-09-16";
$price = 799;
$sql = "insert into item (item_id, title, description, date_posted, price) 
    values ('".$item_id."', '".$title."', '".$description."', '".$date_posted."', '".$price."')";
if($mysqli ->query($sql)){
    echo("Item data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Item data already inserted...<br/>", $mysqli -> error);
}

$item_id = 12345;
$title = "Flex Tape";
$description = "I sawed this boat in half!!!";
$date_posted = "2017-12-25";
$price = 19.99;
$sql = "insert into item (item_id, title, description, date_posted, price) 
    values ('".$item_id."', '".$title."', '".$description."', '".$date_posted."', '".$price."')";
if($mysqli ->query($sql)){
    echo("Item data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Item data already inserted...<br/>", $mysqli -> error);
}

$item_id = 28592;
$title = "Graphics Card";
$description = "Nvidia GeForce RTX 4090";
$date_posted = "2023-01-01";
$price = 2100;
$sql = "insert into item (item_id, title, description, date_posted, price)
    values ('".$item_id."', '".$title."', '".$description."', '".$date_posted."', '".$price."')";
if($mysqli ->query($sql)){
    echo("Item data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Item data already inserted...<br/>", $mysqli -> error);
}

$item_id = 45096;
$title = "Forklift";
$description = "the ultimate vehicle for lifting objects";
$date_posted = "2020-02-02";
$price = 50000;
$sql = "insert into item (item_id, title, description, date_posted, price) 
    values ('".$item_id."', '".$title."', '".$description."', '".$date_posted."', '".$price."')";
if($mysqli ->query($sql)){
    echo("Item data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Item data already inserted...<br/>", $mysqli -> error);
}

$item_id = 70707;
$title = "Mystery Meat";
$description = "dont know where it came from";
$date_posted = "2023-03-21";
$price = 2;
$sql = "insert into item (item_id, title, description, date_posted, price) 
    values ('".$item_id."', '".$title."', '".$description."', '".$date_posted."', '".$price."')";
if($mysqli ->query($sql)){
    echo("Item data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Item data already inserted...<br/>", $mysqli -> error);
}

//Insert Review Data
$r_item_id = 10001;
$username = "Bidenator";
$date = "2022-12-25";
$score = "poor";
$remark = "how do you use these newfangled gadgets???";
$sql = "insert into reviews (r_item_id, username, date, score, remark) 
    values ('".$r_item_id."', '".$username."', '".$date."', '".$score."', '".$remark."')";
if($mysqli ->query($sql)){
    echo("Review data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Review data already inserted...<br/>", $mysqli -> error);
}

$r_item_id = 12345;
$username = "BillyBob";
$date = "2020-01-01";
$score = "good";
$remark = "for my boat.";
$sql = "insert into reviews (r_item_id, username, date, score, remark) 
    values ('".$r_item_id."', '".$username."', '".$date."', '".$score."', '".$remark."')";
if($mysqli ->query($sql)){
    echo("Review data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Review data already inserted...<br/>", $mysqli -> error);
}

$r_item_id = 28592;
$username = "BillyBob";
$date = "2022-02-02";
$score = "fair";
$remark = "it''s ok I guess...";
$sql = "insert into reviews (r_item_id, username, date, score, remark) 
    values ('".$r_item_id."', '".$username."', '".$date."', '".$score."', '".$remark."')";
if($mysqli ->query($sql)){
    echo("Review data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Review data already inserted...<br/>", $mysqli -> error);
}

$r_item_id = 45096;
$username = "WhoIsJoe?";
$date = "2021-06-07";
$score = "excellent";
$remark = "I''m addicted to buying these!";
$sql = "insert into reviews (r_item_id, username, date, score, remark) 
    values ('".$r_item_id."', '".$username."', '".$date."', '".$score."', '".$remark."')";
if($mysqli ->query($sql)){
    echo("Review data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Review data already inserted...<br/>", $mysqli -> error);
}

$r_item_id = 70707;
$username = "Donny123";
$date = "2023-03-22";
$score = "excellent";
$remark = "this is the best meat in the history of meat";
$sql = "insert into reviews (r_item_id, username, date, score, remark) 
    values ('".$r_item_id."', '".$username."', '".$date."', '".$score."', '".$remark."')";
if($mysqli ->query($sql)){
    echo("Review data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Review data already inserted...<br/>", $mysqli -> error);
}

//Insert category data

$name = "cellphone";
$c_item_id= 10001;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "electronic";
$c_item_id= 10001;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "home repair";
$c_item_id= 12345;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "computer part";
$c_item_id= 28592;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "vehicle";
$c_item_id= 45096;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "food";
$c_item_id= 70707;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$name = "non-vegan";
$c_item_id= 70707;
$sql = "insert into categories (name, c_item_id) 
    values ('".$name."', '".$c_item_id."')";
if($mysqli ->query($sql)){
    echo("Category data inserted successfully<br/>");
}
if($mysqli -> errno){
    printf("Category data already inserted...<br/>", $mysqli -> error);
}

$mysqli -> close();

?>