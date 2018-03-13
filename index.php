<?php session_start();

$localConfigFile = dirname(__FILE__)."/setup/local.xml";
static $_isInstalled = false;
static $db_host;
static $db_name;
static $db_user;
static $db_pass;

if (is_readable($localConfigFile)) {
    $_isInstalled = true;
    $xml = simplexml_load_file($localConfigFile);
    $db_host = $xml->db_host;
    $db_name = $xml->db_name;
    $db_user = $xml->db_user;
    $db_pass = $xml->db_pass;
}
if (!$_isInstalled) {
    include dirname(__FILE__)."/setup/install.html";
} else {
    include dirname(__FILE__)."/home.php";
}