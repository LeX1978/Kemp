<?php
if ($_REQUEST['id']) {
  $prodid = $_REQUEST['id'];
}
$q = mysql_query("select * from product where id = " . $prodid);
while ($r = mysql_fetch_assoc($q)) {

  $pagename = $r['name'];
}
echo'<h1 id="pagename">' . $pagename . '</h1>';
//Выводим данные
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
$sql = "select * from product where id=" . $prodid;
$query = mysql_query($sql);
while ($rez = mysql_fetch_assoc($query)) {
  $name = $rez['name'];
  $picture = $rez['file'];
  $cena = $rez['cena'];
  $garant = $rez['garant'];
  $text = $rez['full_text'];
  $status = $rez['status'];
  $pdf = $rez['pdf'];
}
?>
<br/>
<a href="/files/<? echo($picture); ?>" rel="example1">
  <img src="/files/<? echo($picture); ?>"/>
</a>
<p>
  <b>Гарантия:</b> - <? echo($garant . ' мес.'); ?>
</p>
<p>
  <b>Цена с НДС, руб.</b> - <? echo($cena); ?>
</p>
<p>
  <b>Статус:</b> - <? echo($status); ?>
</p>
<br>
<p>
<h1>Технические характеристики</h1><br>
<? echo($text); ?>
</p>
<?
if ($pdf != '') {
  echo'<p>
          <img src="/images/PDF.jpg"/>
          <br/>
					<a href="/files/' . $pdf . '" rel="example1">
							Скачать технические характеристики
					</a>
       </p>';
}
?>
<br>
<table align="left" border="0" cellpadding="0" cellspacing="0" width="400px">
  <tr>
    <td width="300px" align="center" valign="middle">
      Количество: <input type="text" id="kolvo_<? echo($prodid); ?>" size="5" onkeypress="javascript: return set_cart13(event,<? echo($prodid); ?>,<? echo($cena); ?>,'<? echo($session_id); ?>');"/>  
    </td>
    <td width="100px" align="center" valign="middle">
      <img src="/images/to_cart.jpg" width="100" height="23" onClick="javascript:set_cart_new(<? echo($prodid); ?>,<? echo($cena); ?>,'<? echo($session_id); ?>');"/>
    </td>
  </tr>  
</table>
<br>
<br>
<br>
<?
echo'</div></div></div>';
?>
