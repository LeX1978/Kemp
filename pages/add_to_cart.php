<?
	//Подключаем нужные библиотеки
	include("../class/connect.php");
	$prod_id = $_REQUEST['prod_id'];
	$cena = $_REQUEST['cena'];
	$session_id = $_REQUEST['session_id'];
?>
<form action="" name="kol_prod">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%" height="30">
    	<input type="text" id="kol_pr" value="0" tabindex="1" autofocus>
        <script>
			if (!("autofocus" in document.createElement("input"))) {
			document.getElementById("kol_pr").focus();
			}
		</script>
    </td>
    <td width="91%" height="30">&nbsp;
      шт.</td>
  </tr>
  <tr>
    <td height="30" align="center" valign="middle"><input type="button" value="Добавить" onClick="javascript: set_cart(<? echo($prod_id);?>,<? echo($cena);?>,'<? echo($session_id);?>');"></td>
    <td height="30" align="left" valign="middle"><input type="button" value="Отмена" onClick="javascript: closewin('kol_prod');"></td>
  </tr>
</table>

</form>

