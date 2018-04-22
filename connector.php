<?php
$db_name = '';
$db_host = '';
$db_user = '';
$db_pass = '';
$localConfigFile = __DIR__."/setup/local.xml";

 //parse xml to get credentials for db connection:
function xml_parser($localConfigFile)
{
    $xml = file_get_contents($localConfigFile);
    $credentials = simplexml_load_string($xml);
    return $credentials;
}
if (is_readable($localConfigFile)) {
    $_isInstalled = true;
    $db_name = (string)xml_parser($localConfigFile)->db_name;
    $db_user = (string)xml_parser($localConfigFile)->db_user;
    $db_host = (string)xml_parser($localConfigFile)->db_host;
    $db_pass = (string)xml_parser($localConfigFile)->db_pass;
// Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass);
    if ($conn->connect_errno) {
        printf("Connect failed: %s\n", $conn->connect_error);
        exit();
    }
}

