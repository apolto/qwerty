<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("connector.php");
mysqli_select_db($conn, "lesson1");
$email = "";
$pass = "";
$entered_pass = "";


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!empty($_POST['email'])) $entered_email = $_POST['email'];

if (!empty($_POST['password'])) $entered_pass = $_POST['password'];
if (!empty($_POST['re-password'])) $re_pass = $_POST['re-password'];
if ($entered_pass !== $re_pass) {
    echo "password does not match";
    exit();
}

$check_email = "select email FROM myguests WHERE email = '$entered_email';";

if ($result = mysqli_query($conn,$check_email)){
    while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    }
    if ($email == $entered_email){
        echo "user with such email already exists";
        exit();
    }
}
$insert = "INSERT INTO myguests (password,email) VALUES ('$entered_email', '$entered_pass');";
if (mysqli_query($conn,$insert) === TRUE){
    echo "Customer registered";
    exit();
}
