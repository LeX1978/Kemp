<?
	//Подключаем нужные библиотеки
	include("../class/connect.php");
	
	$item_id = $_REQUEST['item_id'];
	$cart_id = $_REQUEST['cart_id'];
	$kol = $_REQUEST['kol'];
	$summa = 0;
	$total_summa = 0;
	
	//Изменение стоимости конкретной записи в корзине
	$s0 = "select * from cart_item where id=".$item_id." and cart_id=".$cart_id;
	$q0 = mysql_query($s0);
	while($r0 = mysql_fetch_assoc($q0))
	{
		$prod_id = $r0['prod_id'];
	}
	//меняем кол-во
	$s1 = "update cart_item set kol =".$kol." where id=".$item_id." and cart_id=".$cart_id;
	mysql_query($s1);
	//находим цену товара
	if($kol > 0)
	{
		$s2 = "select * from product where id = ".$prod_id;
		$q2 = mysql_query($s2);
		while($r2 = mysql_fetch_assoc($q2))
		{
			$cena = $r2['cena'];
		}
		//Рассчитываем новую сумму и изменяем в таблице
		$summa = $kol * $cena;
		$s3 = "update cart_item set summa =".$summa." where id=".$item_id." and cart_id=".$cart_id;
		mysql_query($s3);
	}
	//Рассчитываем общую стоимость заказа и общее кол-во
	$s4 = "select sum(summa) as summ, sum(kol) as kol from cart_item where cart_id = ".$cart_id;
	$q4 = mysql_query($s4);
	while($r4 = mysql_fetch_assoc($q4))
	{
		$total_summa = $r4['summ'];
		$total_kol = $r4['kol'];
	}
	echo "{\"summa\": \"".$summa."\",\"totalsumma\": \"".$total_summa."\", \"item_id\": \"".$item_id."\",\"totalkol\": \"".$total_kol."\"}";
?>