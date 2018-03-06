<?php session_start();

require dirname(__FILE__)."/connector.php";
require dirname(__FILE__)."/home.php";
$database = 'lesson1';

mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS $database;");
mysqli_select_db($conn, $database);
//create table MyGuests
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE
)";
if (mysqli_query($conn,$sql) === TRUE){
    echo "Table MyGuests was created successfully";
}
