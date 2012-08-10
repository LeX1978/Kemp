<?
	//Подключаем нужные библиотеки
	include("../class/connect.php");
	$session_id = $_REQUEST['session_id'];
	$prod_id = $_REQUEST['prod_id'];
	$kol = $_REQUEST['kol'];
	$summa = $_REQUEST['summa'];
	
	//Определение id пользователя через сессию
	$s0 = "select count(*) as kol from sessions where session_id = '".$session_id."'";
	$q0 = mysql_query($s0);
	while($r0 = mysql_fetch_assoc($q0))
	{
		$k = $r0['kol'];
	}
	if($k > 0 )
	{
		$ss = "select * from sessions where session_id = '".$session_id."'";
		$qq = mysql_query($ss);
		while($rr = mysql_fetch_assoc($qq))
		{
			$user_id = $rr['user_id'];
		}	
	}
	else
	{
		$user_id = $session_id;
	}
	//Проверка существует такая корзина или нет
	
	$s = "select count(*) as kol from cart where user_id='".$user_id."' and status = 0";
	$q = mysql_query($s);
	while($r = mysql_fetch_assoc($q))
	{
		$k = $r['kol'];
	}
	if($k == 0)
	{
		$sql = "insert into cart(user_id, status) values('".$user_id."', 0)";
		mysql_query($sql);
	}
	//Получаем идентификатор корзины
	$sql2 = "select id from cart where user_id='".$user_id."' and status=0";
	$query2 = mysql_query($sql2);
	while($rez2 = mysql_fetch_assoc($query2))
	{
		$cart_id = $rez2['id'];
	}
	//Добавляем продукт в корзину
	$sql3 = "insert into cart_item(cart_id,prod_id,kol,summa) values(".$cart_id.",".$prod_id.",".$kol.",".$summa.")";
	mysql_query($sql3);
?>