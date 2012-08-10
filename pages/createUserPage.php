<?php

echo'<h1 id="pagename">Оформление заказа</h1>';
//Выводим данные из корзины
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
//сохраняем пользователя
$email = $_REQUEST['email'];
$name = $_REQUEST['name'];
$type = $_REQUEST['type'];
$inn = $_REQUEST['inn'];
$kpp = $_REQUEST['kpp'];
$uadres = $_REQUEST['uadres'];
$padres = $_REQUEST['padres'];
$contact = $_REQUEST['contact'];
$phone = $_REQUEST['phone'];
$bank = $_REQUEST['bank'];
$rschet = $_REQUEST['rschet'];
$kschet = $_REQUEST['kschet'];
$bik = $_REQUEST['bik'];
//проверяем есть ли такой имэил
$q = mysql_query("select count(*) as kol from profile where email = '" . $email . "'");
while ($r = mysql_fetch_assoc($q)) {
  $kk = $r['kol'];
}
if ($kk > 0) {
  echo'<br/><b> Такой email уже зарегестрирован !</b><br/>';
} else {
  //Сохраняем
  mysql_query("insert into
									              profile(email,
														  name,
														  type,
														  kpp,
														  uadres,
														  padres,
														  inn,
														  contact,
														  phone,
														  bank,
														  rschet,
														  kschet,
														  bik)
												  values('" . $email . "',
														  '" . $name . "',
														  '" . $type . "',
														  '" . $kpp . "',
														  '" . $uadres . "',
														  '" . $padres . "',
														  '" . $inn . "',
														  '" . $contact . "',
														  '" . $phone . "',
														  '" . $bank . "',
														  '" . $rschet . "',
														  '" . $kschet . "',
														  '" . $bik . "')
												");
}
//определяем user_id
$q = mysql_query("select * from profile where email = '" . $email . "'");
while ($r = mysql_fetch_assoc($q)) {
  $user_id = $r['id'];
}
/////////////////////////////////////////////////////////////////////
echo'<fieldset>
                                        	<legend>Данные о покупателе</legend>';
if ($type == 'Физическое лицо') {
  echo'<b>Контактное лицо: </b> ' . $contact . ' 
											     <input type="text" id="econtact" value="' . $contact . '" style="display: none;"><br/>';
  echo'<b>Email: </b> ' . $email . ' 
												 <input type="text" id="enew_user" value="' . $email . '" style="display: none;"><br/>';
  echo'<b>Телефон: </b> ' . $phone . ' 
											     <input type="text" id="ephone" value="' . $phone . '" style="display: none;"><br/>';
  echo'<b>Почтовый адрес: </b> ' . $padres . ' 
												 <input type="text" id="epadres" value="' . $padres . '" style="display: none;"><br/>';
} else {
  echo'<b>Полное наименование компании: </b> ' . $name . ' 
												<input type="text" id="ename" value="' . $name . '" style="display: none;"><br/>';
  echo'<b>Контактное лицо: </b> ' . $contact . ' 
												<input type="text" id="econtactu" value="' . $contact . '" style="display: none;"><br/>';
  echo'<b>Email: </b> ' . $email . ' 
												<input type="text" id="enew_useru" value="' . $email . '" style="display: none;"><br/>';
  echo'<b>Телефон: </b> ' . $phone . ' 
												<input type="text" id="ephoneu" value="' . $phone . '" style="display: none;"><br/>';
  echo'<b>Почтовый адрес: </b> ' . $padres . ' 
												<input type="text" id="epadresu" value="' . $padres . '" style="display: none;"><br/>';
  echo'<b>Юридический адрес: </b> ' . $uadres . ' 
												<input type="text" id="euadresu" value="' . $uadres . '" style="display: none;"><br/>';
  echo'<b>ИНН: </b> ' . $inn . ' 
												<input type="text" id="einnu" value="' . $inn . '" style="display: none;"><br/>';
  echo'<b>КПП: </b> ' . $kpp . ' 
												<input type="text" id="ekppu" value="' . $kpp . '" style="display: none;"><br/>';
  echo'<b>Рассчетный счет: </b> ' . $rschet . ' 
												<input type="text" id="erschetu" value="' . $rschet . '" style="display: none;"><br/>';
  echo'<b>Корреспондентский счет: </b> ' . $kschet . ' 
												<input type="text" id="ekschetu" value="' . $kschet . '" style="display: none;"><br/>';
  echo'<b>Банк: </b> ' . $bank . ' 
												<input type="text" id="ebanku" value="' . $bank . '" style="display: none;"><br/>';
  echo'<b>БИК: </b> ' . $bik . ' 
												<input type="text" id="ebiku" value="' . $bik . '" style="display: none;"><br/><br/>';
}
echo '<p>
												<a href="#" onclick="javascript:editprof(\'' . $type . '\');">Редактировать профиль</a> |
												<a href="#" onclick="javascript:updateprof(\'' . $email . '\',\'' . $type . '\');">Сохранить профиль</a>
										      </p></fieldset>';
echo'<fieldset>
                                        	<legend>Ваш заказ</legend>';
mysql_query("update sessions set user_id = '" . $user_id . "' where session_id = '" . $session_id . "'");
//изменяем user_id в таблице cart
mysql_query("update cart set user_id = '" . $email . "' where user_id = '" . $session_id . "'");
//отображаем заказ из корзины
//Выбираем идентификатор корзины 
$s1 = "select * from cart where user_id='" . $user_id . "' and status = 0";
$q1 = mysql_query($s1);
while ($r1 = mysql_fetch_assoc($q1)) {
  $cart_id = $r1['id'];
}
//Выбираем составляющие заказа
echo'<table width="100%" class="cart_table">
															<th align="center" valign="middle">Наименование</th>
															<th align="center" valign="middle">Цена с НДС, руб</th>
															<th align="center" valign="middle">Количество</th>
															<th align="center" valign="middle">Стоимость</th>';
if ($cart_id > 0) {
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
      echo'<tr>
														<td align="center" valign="middle">' . $r3['name'] . '</td>
														<td align="center" valign="middle">' . $r3['cena'] . '</td>
														<td align="center" valign="middle">' . $kol . '</td>
														<td align="center" valign="middle">' . $summa . '</td>
												 	</tr>';
    }
  }
}
echo('</table><br>');
echo('<div style="background: #00395a; height: 30px;"><b>Общая стоимость товаров: ' . $total_sum . ' руб.</b></div>');
echo('</fieldset><br/><br/>');
echo'Прежде чем сделать выбор, рекомендуем Вам ознакомиться с возможными <b><a href="/page/s/3/3/'.$katalog.'/">способами оплаты</a></b> и <b><a href="/page/s/4/4/'.$katalog.'/">вариантами доставки</a></b> продукции ОАО КЭМЗ!!!';
echo'<br/><br/>';
//отображаем форму для ввода доставки и оплаты
?>
<input type = 'checkbox' id = 'cb1' onclick = 'showHide("cb1", "doctopl");'/>С Условиями оплаты и доставки ознакомлен.
<input type="hidden" id="prix" value="0" />
<br/><br/>
<div id="doctopl" style = "display: none;">
  <form name="opl_dost" action="" method="post">
    <fieldset>
      <legend>Оплата и доставка</legend>

      <label class="inputLabel" for="oplata">Способ оплаты:</label>
      <select id="oplata">
        <option>Наличный рассчет</option>
        <option>Безналичный рассчет</option>
      </select><br style="clear:both;"/>                                                
      <label class="inputLabel" for="dostavka">Способ доставки:</label>
      <select id="dostavka" onchange="javascript: dost();">
        <option>Самовывоз</option>
        <option>Условный самовывоз(траспортная компания)</option>
        <option>Почтовая посылка</option>
        <option>ЖД багаж</option>
        <option>Доставка транспортом ОАО "КЭМЗ"</option>
      </select>
    </fieldset>
  </form>
</div>
<div id="dost" style = "display: none;">
  Уточните адрес доставки:<br/>
  <input type="text" id="adres_dost"  size="60">
</div>
<div id="zd" style = "display: none;">
  Уточните ж/д реквизиты:<br/> 
  <input type="text" id="adres_st"  size="60">
</div>
<?

//отправляем заказ
echo'<br/><br/>';
echo'<input type="button" value="Отправить заказ" onclick="javascrip: send_zak(' . $cart_id . ',\'' . $user_id . '\');"/>';
echo'</div></div></div>';
?>
