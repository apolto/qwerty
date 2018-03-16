<html>
<head>
    <title>Registration</title>
</head>
<body>
<form id='register' action="<?=$_SERVER['PHP_SELF']?>" method='post'
      accept-charset='UTF-8'>
    <fieldset >
        <legend>Register</legend>
        <input type='hidden' name='submitted' id='submitted' value='1'/>

        <label for='email' >Email Address*:</label>
        <input type='text' name='email' id='email' maxlength="50" /><br />

        <label for='password' >Password*:</label>
        <input type='password' name='password' id='password' maxlength="50" /><br />

        <label for='password' >Repeat Password*:</label>
        <input type='password' name='re-password' id='re-password' maxlength="50" /><br />
    </fieldset>
    <input type='submit' name='Register' value='Submit' />
</form>
<?php
if (isset($_REQUEST['Register'])) {

    include("connector.php");
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

    $check_email = "select email FROM Users WHERE email = '$entered_email';";

    if ($result = mysqli_query($conn, $check_email)) {
        while ($row = $result->fetch_assoc()) {
            $email = $row['email'];
        }
        if ($email == $entered_email) {
            echo "user with such email already exists";
            exit();
        }
    }
    $insert = "INSERT INTO Users (email,password) VALUES ('$entered_email', '$entered_pass');";
    if (mysqli_query($conn, $insert)) {
        if ($result = mysqli_query($conn, "SELECT ID FROM Users WHERE email = '$entered_email'")) {
            while ($row = $result->fetch_assoc()) {
                $ID = $row['ID'];
            }
        }
        echo "Customer registered. Customer ID = '$ID'";

    } else {
        echo mysqli_error($conn);
    }
}
?>
</body>
</html>
