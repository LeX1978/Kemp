<?php
set_time_limit(0);
$user = 'p49076_kemp';
$pswd = 'himera';
$server = 'p49076.mysql.ihc.ru';
$db = 'p49076_kemp';
if (!$my_conn=mysql_connect($server,$user,$pswd))
{
   echo "Ошибка соединения с MSSQL";
   die();
}
mysql_query("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");
mysql_select_db($db,$my_conn);
?>