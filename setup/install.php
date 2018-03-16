<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Installation</title>
</head>
<br>
<form id='install' action="<?=$_SERVER['PHP_SELF']?>" method='post'
      accept-charset='UTF-8'>
    <fieldset >

        <label for='db_name' >DB name*:</label>
        <input type='text' name='db_name' id='db_name' maxlength="50" /><br />

        <label for='db_host' >DB host*:</label>
        <input type='text' name='db_host' id='db_host' maxlength="50" /><br />

        <label for='db_user' >DB user*:</label>
        <input type='text' name='db_user' id='db_user' maxlength="50" /><br />

        <label for='db_password' >DB password*:</label>
        <input type='db_password' name='db_password' id='db_password' maxlength="50" /><br />
    </fieldset>
    <input type='submit' name='Install' value='Install' />
</form>
<?php

if (isset($_REQUEST['Install'])) {


    if (!empty($_POST['db_name'])) $entered_db = $_POST['db_name'];
    if (!empty($_POST['db_host'])) $entered_host = $_POST['db_host'];
    if (!empty($_POST['db_user'])) $entered_user = $_POST['db_user'];
    if (!empty($_POST['db_password'])) {
        $entered_pass = $_POST['db_password'];
    } else {
        $entered_pass = NULL;
    }

    require dirname(__FILE__) . "/../connector.php";
//create DB
    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $entered_db;");
    mysqli_select_db($conn, $entered_db);
    $table = "Users";
//create table MyGuests
    $sql = "CREATE TABLE $table (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE
)";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "Table $table was created successfully";
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
    if ($entered_pass) {
        $db = $root->appendChild(
            $xmlDoc->createElement("db_pass", $entered_pass));
    }
//make the output pretty
$xmlDoc->formatOutput = true;

    echo $xmlDoc->save("local.xml");

    if (file_exists("local.xml")) {
        echo "Installation finished. Configuration was saved to local.xml";

    }
}
?>
<br>
<a href="/../index.php">Home Page</a>
</body>
</html>
