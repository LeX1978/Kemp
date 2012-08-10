<?php

echo'<h1 id="pagename">Заказ отправлен</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
$cart_id = $_REQUEST['cart_id'];
$user_id = $_REQUEST['user_id'];
$dost = $_REQUEST['dost'];
$opl = $_REQUEST['opl'];
$adr_dost = $_REQUEST['adr_dost'];
$adr_zd = $_REQUEST['adr_zd'];
mysql_query("update cart set status = 1, 
								                             sposob_opl='" . $opl . "', 
															 dostavka='" . $dost . "',
															 adr_dost ='" . $adr_dost . "',
															 station = '" . $adr_zd . "' where id = " . $cart_id);
//собираем информацию
//о покупателе
$q = mysql_query("select * from profile where id = " . $user_id);
while ($r = mysql_fetch_assoc($q)) {
  $name = $r['name'];
  $contact = $r['contact'];
  $email = $r['email'];
  $phone = $r['phone'];
  $padres = $r['padres'];
  $uadres = $r['uadres'];
  $inn = $r['inn'];
  $kpp = $r['kpp'];
  $rschet = $r['rschet'];
  $kschet = $r['kschet'];
  $bank = $r['bank'];
  $bik = $r['bik'];
  $type = $r['type'];
}
//Отправка письма
$to = "manager@kemp-production.com";
$to2 = $email;
$subject = "Заказ Интернет-магазин Kemp-production.com";

$message = '
								<html>
									<head>
										<title>Заказ Интернет-магазин Kemp-production.com</title>
									</head>
									<body>
										<p align="center"><b>Данные о покупателе</b></p>
										<br/><br/>';
if ($type == 'Физическое лицо') {
  $message .= '<b>ФИО:</b> ' . $name . '<br/><b>Контактное лицо: </b> ' . $contact . '<br/><b>Email: </b> ' . $new_user . '<br/><b>Телефон: </b> ' . $phone . '<br/><b>Почтовый адрес: </b> ' . $padres . '<br/>';
} else {
  $message .= '<b>Название: </b> ' . $name . '<br/><b>Контактное лицо: </b> ' . $contact . '<br/><b>Email: </b> ' . $email . '<br/><b>Телефон: </b> ' . $phone . '<br/><b>Почтовый адрес: </b> ' . $padres . '<br/>
														<b>Юридический адрес: </b> ' . $uadres . '<br/><b>ИНН: </b> ' . $inn . '<br/><b>КПП: </b> ' . $kpp . '<br/><b>Рассчетный счет: </b> ' . $rschet . '<br/><b>Корреспондентский счет: </b> ' . $kschet . '<br/>
														<b>Банк: </b> ' . $bank . '<br/><b>БИК: </b> ' . $bik . '<br/><br/>';
}
$message .= '<p align="center"><b>Ваш заказ</b></p>
													<br/><br/>
													<table width="100%" class="cart_table">
														<th align="center" valign="middle">Наименование</th>
														<th align="center" valign="middle">Цена с НДС, руб</th>
														<th align="center" valign="middle">Количество</th>

														<th align="center" valign="middle">Стоимость</th>';
if ($cart_id > 0) {
  //Выбираем составляющие заказа
  $s2 = "select * from cart_item where cart_id = " . $cart_id;
  $q2 = mysql_query($s2);
  $total_sum = 0;
  while ($r2 = mysql_fetch_assoc($q2)) {
    $prod_id = $r2['prod_id'];
    $kol = $r2['kol'];
    $item_id = $r2['id'];
    $summa = $r2['summa'];
    $total_sum = $total_sum + $summa;
    $s3 = "select * from product where id=" . $prod_id;
    $q3 = mysql_query($s3);
    while ($r3 = mysql_fetch_assoc($q3)) {
      $prod_name = $r3['name'];
      $prod_cena = $r3['cena'];
      $prod_model = $r3['model_id'];
      $prod_kat = $r3['kat_id'];
      $q7 = mysql_query("select * from kategoriya where id = " . $prod_kat);
      while ($r7 = mysql_fetch_assoc($q7)) {
        $kat_name = $r7['name'];
      }
      if ($prod_model != '') {
        $q6 = mysql_query("Select * from model where id = " . $prod_model);
        while ($r6 = mysql_fetch_assoc($q6)) {
          $kat_n_id = $r6['kat_id'];
        }
        $q7 = mysql_query("select * from kategoriya where id = " . $kat_n_id);
        while ($r7 = mysql_fetch_assoc($q7)) {
          $kat_name = $r7['name'];
        }
      }

      $message .= '<tr>
																<td align="center" valign="middle">' . $kat_name . ' ' . $prod_name . '</td>
																<td align="center" valign="middle">' . $prod_cena . '</td>
																<td align="center" valign="middle">' . $kol . '</td>
																<td align="center" valign="middle">' . $summa . '</td>
															</tr>';
    }
  }
}
$message .= '</table><br>';
$message .= '<b>Доставка: </b>' . $dost . '<br/><br/>';
if ($adr_dost != '') {
  $message .= '<b>Адрес доставка: </b>' . $adr_dost . '<br/><br/>';
}
if ($adr_zd != '') {

  $message .= '<b>Адрес ж/д станции: </b>' . $adr_zd . '<br/><br/>';
}
$message .= '<b>Способо оплаты: </b>' . $opl . '<br/><br/>';
$message .= '<div style="background: #CCFFFF; height: 30px;"><b>Общая стоимость товаров: ' . $total_sum . ' руб.</b></div>';
$message .= '<br/><br/>';
$message .= '</body></html>';

$headers = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: " . $email . " \r\n";

mail($to, $subject, $message, $headers);
mail($to2, $subject, $message, $headers);
echo'<br/>';
echo'<b>Благодарим за покупку !</b><br/>';
echo'<b>В ближайшее время наш менеджер свяжется с Вами  !</b><br/>';
echo'</div></div></div>';
//Удаляем сессию
mysql_query("delete from sessions where session_id = " . $session_id);
?>
