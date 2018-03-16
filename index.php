<?php session_start();

$localConfigFile = dirname(__FILE__)."/setup/local.xml";
$_isInstalled = false;

if (is_readable($localConfigFile)) {
    $_isInstalled = true;
    $xml = simplexml_load_file($localConfigFile);
    $db_host = $xml->db_host;
    $db_name = $xml->db_name;
    $db_user = $xml->db_user;
    if ($xml->db_pass) {
        $db_pass = $xml->db_pass;
    } else {
        $db_pass = NULL;
    }
}

if (!$_isInstalled) {
    ?>
<h2>Please click <a href="/setup/install.php">INSTALL</a> to setup environment</h2>
<?php

} else {
    include dirname(__FILE__)."/home.php";
}