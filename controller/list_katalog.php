<?
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
    function edit_katalog(id){
      var url = '/controller/edit_katalog.php?id='+id;
      userWindow = window.open(url, 'edit_user', 'width:700;height:500;');
      userWindow.focus();
    }
    function delete_katalog(id) {
      var params = 'kat_id='+id;
      do_ajax('delete_katalog',params,'','','post',0,0);
      self.location.reload();
      alert('Каталог Удален!');
    }
  </script>
</head>
<body>
<?

echo'<h1 id="pagename">Список каталогов продукции</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
echo'<table width="100%" class="katalog_table">
        <th align="center" valign="middle">Название каталога</th>
        <th align="center" valign="middle">Ссылка</th>
        <th align="center" valign="middle">Удалить</th>';
//Выбираем данные для каталога
$katalogCommon = new Class_Katalog_Common();
$katalogArray = $katalogCommon->Find('1=1',array('name','url'));
if($katalogArray) {
  foreach($katalogArray as $kat_id => $kat) {
      echo'<tr>
				  <td align="center" valign="middle""><a href="#" onclick="edit_katalog(' . $kat_id . ');">' . $kat['name'] . '</a></td>
				  <td align="center" valign="middle">' . $kat['url'] . '</td>
					<td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_katalog(' . $kat_id . ');"/></td>
				 </tr>';
  }
}
unset($katalogCommon);
echo'</table>';
echo'</div></div></div>';
?>
</body>
</html>