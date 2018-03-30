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
        echo "|Configuration was saved to local.xml |";

    }

//create DB
    require __DIR__ . "/../connector.php";

    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $db_name;");
    mysqli_select_db($conn, $db_name);

//create table Users

    $sql = "CREATE TABLE `Users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "|Table 'Users' was created successfully|";
    }
    //create table expenses
    $sql2 = "CREATE TABLE `expenses` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `goods_type_id` int(20) DEFAULT NULL,
  `costs` int(30) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_type_id` (`goods_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;";

    $sql3 = "CREATE TABLE `goods` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `goods_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNI` (`user_id`,`goods_type`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;";


    if (mysqli_query($conn, $sql2) === TRUE) {
        echo "|Table 'expenses' was created successfully|";
    }
    if (mysqli_query($conn, $sql3) === TRUE) {
        echo "|Table 'goods' was created successfully|";
    }
}

?>
<br />
<a href="/../index.php">Home Page</a>
</body>
</html>
