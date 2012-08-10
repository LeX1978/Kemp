<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 03.07.12
 * Time: 10:38
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
    function edit_kategoriya(id){
      var url = '/controller/edit_kategoriya.php?id='+id;
      userWindow = window.open(url, 'edit_kategoriya', 'width:700;height:500;');
      userWindow.focus();
    }
    function delete_kategoriya(id) {
      var params = 'kat_id='+id;
      do_ajax('delete_kategoriya',params,'','','post',0,0);
      self.location.reload();
      alert('Категория Удалена!');
    }
  </script>
</head>
<body>
<?

echo'<h1 id="pagename">Список Категорий продукции</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
echo'<table width="100%" class="katalog_table">
        <th align="center" valign="middle">Название категории</th>
        <th align="center" valign="middle">Каталог</th>
        <th align="center" valign="middle">Удалить</th>';
//Выбираем данные для каталога
  $sql = "
    SELECT
      k.id,
      k.name AS kategoriya,
      kt.name AS katalog
    FROM kategoriya AS k
    INNER JOIN katalog AS kt ON kt.id = k.katalog_id
  ";
  $query = mysql_query($sql);
  while ($res = mysql_fetch_assoc($query)) {
    echo'<tr>
				  <td align="center" valign="middle""><a href="#" onclick="edit_kategoriya(' . $res['id'] . ');">' . $res['kategoriya'] . '</a></td>
				  <td align="center" valign="middle">' . $res['katalog'] . '</td>
					<td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_kategoriya(' . $res['id'] . ');"/></td>
				 </tr>';
  }
echo'</table>';
echo'</div></div></div>';
?>
</body>
</html>