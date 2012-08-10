<?
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Config.php');
Class_Config::$root = $_SERVER['DOCUMENT_ROOT'];
Class_Config::ConnectDB();
