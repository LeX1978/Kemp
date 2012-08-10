<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 15:40
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="/css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/js/jquery.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  <script type="text/javascript" src="/js/ajax.js"></script>
  <script type="text/javascript">
    function edit_model(id){
      var url = '/controller/edit_model.php?id='+id;
      userWindow = window.open(url, 'edit_model', 'width:700;height:500;');
      userWindow.focus();
    }
    function delete_model(id) {
      var params = 'mod_id='+id;
      do_ajax('delete_model',params,'','','post',0,0);
      self.location.reload();
      alert('Модель Удалена!');
    }
  </script>
</head>
<body>
<?

echo'<h1 id="pagename">Список Моделей продукции</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
echo'<table width="100%" class="katalog_table">
        <th align="center" valign="middle">Название модели</th>
        <th align="center" valign="middle">Каталог</th>
        <th align="center" valign="middle">Категория</th>
        <th align="center" valign="middle">Удалить</th>';
//Выбираем данные для каталога
$sql = "
    SELECT
      m.id,
      m.name AS model_name,
      kt.name AS kat_name,
      kat.name AS katalog
    FROM model AS m
    INNER JOIN kategoriya AS kt ON kt.id = m.kat_id
    INNER JOIN katalog AS kat ON kat.id = kt.katalog_id
  ";
$query = mysql_query($sql);
while ($res = mysql_fetch_assoc($query)) {
  echo'<tr>
				  <td align="center" valign="middle""><a href="#" onclick="edit_model(' . $res['id'] . ');">' . $res['model_name'] . '</a></td>
				  <td align="center" valign="middle">' . $res['katalog'] . '</td>
				  <td align="center" valign="middle">' . $res['kat_name'] . '</td>
					<td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_model(' . $res['id'] . ');"/></td>
				 </tr>';
}
echo'</table>';
echo'</div></div></div>';
?>
</body>
</html>