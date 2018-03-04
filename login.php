<?php
include ("connector.php");
mysqli_select_db($conn, "lesson1");
$email = "";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!empty($_POST['email'])) $entered_email = $_POST['email'];
if (!empty($_POST['password'])) $entered_pass = $_POST['password'];


$check_email = "select email FROM myguests WHERE email = '$entered_email';";

if ($result = mysqli_query($conn,$check_email)){
    while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    }
    if ($email !== $entered_email){
        echo "user with such email does not exists";
        exit();
    }
}

$check_pass = "select password FROM MyGuests WHERE email = '$email'";
if ($result = mysqli_query($conn,$check_pass)){
    while ($row = $result->fetch_assoc()) {
    $pass = $row['password'];
    }
    if ($pass == $entered_pass){
        echo "Good password";
    }
    else {
        echo "Wrong password";
    }
}
