<?php session_start();
$percentage = 0;
?>
<html>
<head>
    <title> My Account Page</title>
    <?php
    $user = $_SESSION['user_name'];
   
    echo "Welcome ".$user;
    
    $sql = "CREATE TABLE expenses (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
meal INT(30) NOT NULL,
things INT(50) NOT NULL)";
    require_once ("connector.php");
    mysqli_select_db($conn, $db_name);
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "|Table 'expenses' was created successfully|";
    }
    
    $results = mysqli_query($conn, "select * from expenses;");
    var_dump($results);
    ?>
</head>
<body>
    <form id="pr" action="report.php">
        <table style="width:100%">
        <tr>
            <th>Type</th>
            <th>Expenses</th> 
            <th>%</th>
        </tr>
        <tr>
            <td>Meal</td>
            <td>
                <input type="number" name="1">
            </td> 
            <td>
                <?php
                    echo $percentage;
                ?>
            </td>
        </tr>
        <tr>
            <td>Things</td>
            <td>
                <input type="number" name="2">
            </td> 
            <td>
                <?php
                    echo $percentage;
                ?>
            </td>
        </tr>
        </table>
        <input type="sumbit" name="btn">
    </form>
</body>
<br />
<a href="login.php">Back to Login page</a>
</html>