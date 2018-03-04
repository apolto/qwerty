<?php session_start();

/**define("INDEX", ""); // УСТАНОВКА КОНСТАНТЫ ГЛАВНОГО КОНТРОЛЛЕРА
require_once($_SERVER[DOCUMENT_ROOT]."/cfg/core.php"); // ПОДКЛЮЧЕНИЕ ЯДРА
 * 
 */
include ("connector.php");
include ("home.php");
$database = 'lesson1';

// ПОДКЛЮЧЕНИЕ К БД
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
