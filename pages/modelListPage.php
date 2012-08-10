<?php

if ($_REQUEST['id']) {
  $katid = $_REQUEST['id'];
}
$q = mysql_query("select * from kategoriya where id = " . $katid);
while ($r = mysql_fetch_assoc($q)) {
  $pagename = $r['name'];
}
echo'<h1 id="pagename">' . $pagename . '</h1>';
//Считаем  кол-во элементов
$query = "SELECT COUNT(*) AS counter
											FROM  model where kat_id = " . $katid;
$sql = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_assoc($sql);
$elements = $row['counter'];

$query = "SELECT *
											FROM  model where kat_id = " . $katid;
$sql = mysql_query($query) or die(mysql_error());
//Выводим данные
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
//выводим данные
$n = mysql_num_rows($sql);
$lines = ceil($elements / 2);
echo'<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">';
for ($i = 0; $i < $lines; $i++) {
  $start = $i * 2;
  $st = "SELECT *	FROM  model where kat_id = " . $katid . " LIMIT {$start}, 2";
  $qt = mysql_query($st);
  echo'<tr>';
  while ($rt = mysql_fetch_assoc($qt)) {
    echo'<td width="225" align="left" valign="top">';
    echo'<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border: solid 1px #ECEAEA;">
												 <tr>
													<td align="center" valign="middle" style="background:#00395a; " height="25px">
														<span style="font-size: 16px;"><b>' . $rt['name'] . '</b></span>
													<td>
												 </tr>
												 <tr>
													<td align="center" valign="middle" style="background:#809cad;">
													  <a href="/model/' . $rt['id'] . '/1/' . $ko . '/' . $rt['id'] . '/'.$katalog.'/">
														<img src="/files/' . $rt['image'] . '" style="border:0px;"/>
													  </a>
													</td>
												  </tr>
												  </table>';
    echo'</td>';
  }
  echo'</tr>';
}
echo'</table>';
echo'</div></div></div>';
?>
