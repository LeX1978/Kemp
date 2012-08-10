<?php

if ($_REQUEST['id']) {
  $modelid = $_REQUEST['id'];
}
$q = mysql_query("select * from model where id = " . $modelid);
while ($r = mysql_fetch_assoc($q)) {
  $pagename = $r['name'];
}
echo'<h1 id="pagename">' . $pagename . '</h1>';
$query = "SELECT *
											FROM  product where model_id = " . $modelid;
$sql = mysql_query($query) or die(mysql_error());
//Выводим данные
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
echo'<div id="maincontent">';
echo'<table width="100%" class="katalog_table">
										<th align="center" valign="middle">Наименование</th>
										<th align="center" valign="middle">Краткие техн.храктеристики</th>
										<th align="center" valign="middle">Гарантия, мес</th>
										<th align="center" valign="middle">Цена с НДС, руб</th>
										<th align="center" valign="middle">Статус</th>
                    <th align="center" valign="middle">Кол-во</th>
										<th align="center" valign="middle">Добавить</th>';
while ($row = mysql_fetch_assoc($sql)) {
  // здесь выводим наши записи из базы
  echo'<tr>
											<td align="center" valign="middle""><a href="/product/' . $row['id'] . '/1/' . $ko . '/'.$katalog.'/' . $mo . '/">' . $row['name'] . '</a></td>
											<td align="center" valign="middle">' . $row['text'] . '</td>
											<td align="center" valign="middle">' . $row['garant'] . '</td>
											<td align="center" valign="middle">' . $row['cena'] . '</td>
											<td align="center" valign="middle">' . $row['status'] . '</td>
                      <td align="center" valign="middle">
                        <input type="text" id="kolvo_'.$row['id'].'" size="5" onkeypress="javascript: return set_cart13(event,' . $row['id'] . ',' . $row['cena'] . ',\'' . $session_id . '\');"/>
                      </td>  
											<td align="center" valign="middle"><img src="/images/korzina.png" onclick="javascript:set_cart_new(' . $row['id'] . ',' . $row['cena'] . ',\'' . $session_id . '\');" title="Кликните для добавления в корзину"></td>
										 </tr>';
}
echo'</table>';
echo'</div></div></div>';
?>
