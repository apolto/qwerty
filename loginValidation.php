<html>
    <body>
<?php
session_start();
include("connector.php");
mysqli_select_db($conn, $db_name);
$email = "";

if (!empty($_POST['email'])) $entered_email = $_POST['email'];
if (!empty($_POST['password'])) $entered_pass = $_POST['password'];

$check_email = "select email FROM Users WHERE email = '$entered_email';";
if ($result = mysqli_query($conn, $check_email)) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
    }
    if ($email !== $entered_email) {
        $_SESSION['wrong_email'] = 1;
    }
} else {
    $_SESSION['wrong_email'] = 1;
    header("Location: login.php");
}
$check_pass = "select id,password FROM Users WHERE email = '$email';";
if ($result = mysqli_query($conn, $check_pass)) {
    while ($row = $result->fetch_assoc()) {
        $pass = $row['password'];
        $id = $row['id'];
    }
    if ($pass == $entered_pass) {
        $_SESSION['user_id'] = $id;
        header("Location: myAccount.php");
    } else {
        $_SESSION['wrong_pass'] = 1;
        header("Location: login.php");
    }
}
?>
    <br />
    <a href="/../index.php">Home Page</a>
    </body>
</html>