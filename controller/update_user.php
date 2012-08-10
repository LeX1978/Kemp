<?
//Подключаем нужные библиотеки
	include("../class/connect.php");
	if($_REQUEST['contact'])
	{
	$contact = $_REQUEST['contact'];
	}
	if($_REQUEST['new_user'])
	{
	$new_user = $_REQUEST['new_user'];
	}
	if($_REQUEST['phone'])
	{
	$phone = $_REQUEST['phone'];
	}
	if($_REQUEST['padres'])
	{
	$padres = $_REQUEST['padres'];
	}
	if($_REQUEST['bik'])
	{
	$bik = $_REQUEST['bik'];
	}
	if($_REQUEST['uadres'])
	{
	$uadres = $_REQUEST['uadres'];
	}
	if($_REQUEST['inn'])
	{
	$inn = $_REQUEST['inn'];
	}
	if($_REQUEST['kpp'])
	{
	$kpp = $_REQUEST['kpp'];
	}
	if($_REQUEST['rschet'])
	{
	$rschet = $_REQUEST['rschet'];
	}
	if($_REQUEST['kschet'])
	{
	$kschet = $_REQUEST['kschet'];
	}
	if($_REQUEST['bank'])
	{
	$bank = $_REQUEST['bank'];
	}
	if($_REQUEST['login'])
	{
	$login = $_REQUEST['login'];
	}

	$s = 'update profile set email = \''.$new_user.'\',
								 kpp = \''.$kpp.'\',  
								 uadres = \''.$uadres.'\',
								 padres = \''.$padres.'\',
								 inn = \''.$inn.'\',
								 contact = \''.$contact.'\',
								 phone = \''.$phone.'\',
								 bank = \''.$bank.'\',
								 rschet = \''.$rschet.'\',
								 kschet = \''.$kschet.'\',
								 bik = \''.$bik.'\'
								where email = \''.$login.'\'';
	echo $s;
	mysql_query($s);							
  								
?>	