<?php

echo'<h1 id="pagename">Ваша корзина</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
// Тело корзины
//Выбираем пользователя по сессии
$s = "select * from sessions where session_id = '" . $session_id . "'";
$q = mysql_query($s);
while ($r = mysql_fetch_assoc($q)) {
  $user_id = $r['user_id'];
}
//Выбираем идентификатор корзины 
$s1 = "select * from cart where user_id='" . $user_id . "' and status = 0";
$q1 = mysql_query($s1);
while ($r1 = mysql_fetch_assoc($q1)) {
  $cart_id = $r1['id'];
}
echo'<table width="100%" class="cart_table">
													<th align="center" valign="middle">Наименование</th>
													<th align="center" valign="middle">Цена с НДС, руб</th>
													<th align="center" valign="middle">Количество</th>
													<th align="center" valign="middle">Стоимость</th>
													<th align="center" valign="middle">Статус</th>
													<th align="center" valign="middle">Удалить</th>';
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
      echo'<tr>
				<td align="center" valign="middle">' . $r3['name'] . '</td>
					<td align="center" valign="middle">' . $r3['cena'] . '</td>
					<td align="center" valign="middle"><input type="text" id="kolvo_' . $item_id . '" value="' . $kol . '" size="10" onkeyup="javascript: recount(' . $cart_id . ',' . $item_id . ');"></td>
					<td align="center" valign="middle"><input type="text" id="item_' . $item_id . '" value="' . $summa . '" readonly=true size="10"></td>
					<td align="center" valign="middle">' . $r3['status'] . '</td>
					<td align="center" valign="middle"><img src="/images/delete.gif" onclick="javascript:del_item(' . $item_id . ',\'' . $user_id . '\',\'' . $session_id . '\');"></td>
				</tr>';
    }
  }
}
echo('</table><br>');
echo('<div style="background: #00395a; height: 30px;">
								  		<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td valign="middle" height="30px">
													<b>Общая стоимость товаров: <input type="text" id="totalsum" readonly=true value="' . $total_sum . '" size="15"> руб.</b>		
												</td>			
											</tr>
										</table>	
									  </div>');
echo('<br/>');
echo('<a href="/pagef/f/7/'.$katalog.'/"><img src="/images/oform.jpg" width="120" height="23" style="border:none;"/></a>');
echo'</div></div></div>';
?>
