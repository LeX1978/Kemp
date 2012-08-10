<?
	//Подключаем нужные библиотеки
	include("../class/connect.php");
	if($_REQUEST['item_id'])
	{
		$item_id = $_REQUEST['item_id'];
	}
	mysql_query("delete from cart_item where id = ".$item_id);
?>