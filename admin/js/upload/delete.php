<?
//соединение с базой
set_time_limit(0);
$user = 'gepard';
$pswd = 'gepard';
$server = 'localhost';
$db = 'gepardauto';
if (!$my_conn=mysql_connect($server,$user,$pswd))
{
   echo "Ошибка соединения с MSSQL";
   die();
}
mysql_select_db($db,$my_conn);

mysql_query("delete from mag_import");
?>