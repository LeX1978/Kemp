<?php

$key = $_REQUEST['key'];
echo'<h1 id="pagename">Результаты поиска</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
//Полнотекстный поиск в базе продуктов по полю find_text
$s = "SELECT count(*) as kol FROM product WHERE MATCH (find) AGAINST ('" . $key . "')";
$q = mysql_query($s);
while ($r = mysql_fetch_assoc($q)) {
  $k = $r['kol'];
}
mysql_free_result($q);
if ($k > 0) {
  //Выводим список найденных продуктов
  $s = "SELECT * FROM product WHERE MATCH (find) AGAINST ('" . $key . "')";
  $q = mysql_query($s);
  echo'<table width="100%" class="katalog_table">
											<th align="left" valign="middle">Найдено</th>';
  while ($r = mysql_fetch_assoc($q)) {
    echo'<tr>';
    echo'<td align="left" valign="middle"">
												<a href="/product/' . $r['id'] . '/1/' . $ko . '/'.$katalog.'/' . $mo . '/">' . $r['name'] . '</a>
										     </td>';
  }
  echo'</table>';
  mysql_free_result($q);
} else {
  echo('<br/>По Вашему запросу ничего не найдено !!!<br/>');
}

echo'</div></div></div>';
?>
