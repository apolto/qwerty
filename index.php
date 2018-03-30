<?php

$_isInstalled = false;
require_once ("connector.php");

if (!$_isInstalled) {
    ?>
    <h2>Please click <a href="/setup/install.php">INSTALL</a> to setup environment</h2>
    <?php
} else {
    include __DIR__."/home.php";
}