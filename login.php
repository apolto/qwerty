<html>
<head>
    <title>Login</title>
</head>
<body>
<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <fieldset>
        Email:   <input type="email" name="email" size="15" /><br />
        Password:  <input type="password" name="password" size="15" /><br />
    </fieldset>
    <div align="center">
        <p>
            <input type="submit" name='Login' value="Login" />
        </p>

    </div>
</form>

<?php
if (isset($_REQUEST['Login'])) {

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
            echo "invalid user email";
        }
    }

    $check_pass = "select password FROM Users WHERE email = '$email'";

    if ($result = mysqli_query($conn, $check_pass)) {
        while ($row = $result->fetch_assoc()) {
            $pass = $row['password'];
        }
        if ($pass == $entered_pass) {
            echo "Good password";
        } else {
            echo "Wrong password";
        }
    }
}
?>
<br />
<a href="/../index.php">Home Page</a>
</body>
</html>