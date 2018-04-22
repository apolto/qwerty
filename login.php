<?php
session_start();
?>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="/loginValidation.php">
    <fieldset>
        Email:*   <input type="email" name="email" size="15" required/><br />
        Password:  <input type="password" name="password" size="15" /><br />
        <?php
            if(isset($_SESSION['wrong_pass'])||isset($_SESSION['wrong_email'])){
                echo "Wrong credentials";
                session_destroy();
            }
        ?>
    </fieldset>
    <div align="center">
        <p>
            <input type="submit" name='Login' value="Login" />
        </p>

    </div>
</form>
<br />
<a href="/../index.php">Home Page</a>
</body>
</html>