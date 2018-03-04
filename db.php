<?php

class MyDB
{
var $dblogin = "root"; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
var $dbpass = ""; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ
var $db = "lesson1"; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
var $dbhost="localhost";

var $link;
var $query;
var $err;
var $result;
var $data;
var $fetch;

function connect() {
$this->link = mysql_connect($this->dbhost, $this->dblogin, $this->dbpass);
//mysqli_query($this->link,"CREATE DATABASE IF NOT EXISTS $this->db;");
mysql_select_db($this->db);
mysql_query('SET NAMES utf8');
}

function close() {
mysql_close($this->link);
}

function run($query) {
$this->query = $query;
$this->result = mysql_query($this->query, $this->link);
$this->err = mysql_error();
}
function row() {
$this->data = mysql_fetch_assoc($this->result);
}
function fetch() {
while ($this->data = mysql_fetch_assoc($this->result)) {
$this->fetch = $this->data;
return $this->fetch;
}
}
function stop() {
unset($this->data);
unset($this->result);
unset($this->fetch);
unset($this->err);
unset($this->query);
}
}