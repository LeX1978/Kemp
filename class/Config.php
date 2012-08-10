<?php 

class Class_Config {
  const DB_HOST = "kemp-produ.mysql";
  const DB_USER = "kemp-produ_mysql";
  const DB_PASS = "lory00vy";
  const DB_NAME = "kemp_produ_db";
  static public $root = "";
  static public $DBPointer;

  static public function ConnectDB() {
    self::$DBPointer = mysql_connect(self::DB_HOST,
                                     self::DB_USER,
                                     self::DB_PASS)
    or die("could not connect database - " . mysql_error());
    mysql_select_db(self::DB_NAME, self::$DBPointer);
    mysql_query("SET NAMES utf8", self::$DBPointer);
  }
}

function __autoload($className) {
  $file = str_replace('\\', '/', str_replace('_', '/', ltrim($className, '\\')));

  if (substr($file, 0, 1) == "C") {
    $file = "c" . substr($file, 1);
  }
  include_once Class_Config::$root . "/{$file}.php";
}
