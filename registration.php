<?php

include ("connector.php");
$email = "";
$pass = "";
$entered_pass = "";

if (!empty($_POST['email'])) $entered_email = $_POST['email'];

if (!empty($_POST['password'])) $entered_pass = $_POST['password'];
if (!empty($_POST['re-password'])) $re_pass = $_POST['re-password'];
if ($entered_pass !== $re_pass) {
    echo "password does not match";
    exit();
}

$check_email = "select email FROM MyGuests WHERE email = '$entered_email';";

if ($result = mysqli_query($conn,$check_email)){
    while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    }
    if ($email == $entered_email){
        echo "user with such email already exists";
        exit();
    }
}
$insert = "INSERT INTO MyGuests (email,password) VALUES ('$entered_email', '$entered_pass');";
if (mysqli_query($conn,$insert)){
    if ($result = mysqli_query($conn,"SELECT ID FROM MyGuests WHERE email = '$entered_email'")){
        while ($row = $result->fetch_assoc()) {
            $ID = $row['ID'];
        }
    }
    echo "Customer registered. Customer ID = '$ID'";

} else {
    echo mysqli_error($conn);
}
