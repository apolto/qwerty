<?php
/**
 * Created by PhpStorm.
 * User: apoltoratskyi
 * Date: 3/13/18
 * Time: 5:05 PM
 */
if (!empty($_POST['db_name'])) $entered_db = $_POST['db_name'];
if (!empty($_POST['db_host'])) $entered_host = $_POST['db_host'];
if (!empty($_POST['db_user'])) $entered_user = $_POST['db_user'];
if (!empty($_POST['db_password'])) {
    $entered_pass = $_POST['db_password'];
}else {
    $entered_pass = NULL;
}

require dirname(__FILE__)."/../connector.php";
//create DB
mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS $entered_db;");
mysqli_select_db($conn, $entered_db);
//create table MyGuests
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE
)";
if (mysqli_query($conn,$sql) === TRUE){
    echo "Table MyGuests was created successfully";
}

// generate local.xml
$xmlDoc = new DOMDocument();
$root = $xmlDoc->appendChild(
    $xmlDoc->createElement("config"));
$db = $root->appendChild(
    $xmlDoc->createElement("db_host", $entered_host));
$db = $root->appendChild(
    $xmlDoc->createElement("db_name", $entered_db));
$db = $root->appendChild(
    $xmlDoc->createElement("db_user", $entered_user));
if ($entered_pass){
    $db = $root->appendChild(
    $xmlDoc->createElement("db_pass", $entered_pass));
}
//make the output pretty
$xmlDoc->formatOutput = true;

echo $xmlDoc->save("local.xml");

if (file_exists("local.xml")) include (dirname(__FILE__)."/../home.php");