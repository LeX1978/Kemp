<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 10:24
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
    function edit_product(id){
      var url = '/controller/edit_product.php?id='+id;
      userWindow = window.open(url, 'edit_product', 'width:700;height:500;');
      userWindow.focus();
    }
    function delete_product(id) {
      var params = 'prod_id='+id;
      do_ajax('delete_product',params,'','','post',0,0);
      self.location.reload();
      alert('Изделие Удалено!');
    }
  </script>
</head>
<body>
<h1 id="pagename">Список продукции</h1>
  <div class="tie text2">
    <div class="tie-indent">
      <div id="maincontent">
        <table width="100%" class="katalog_table">
          <th align="center" valign="middle">Название продукции</th>
          <th align="center" valign="middle">Модель</th>
          <th align="center" valign="middle">Категория</th>
          <th align="center" valign="middle">Каталог</th>
          <th align="center" valign="middle">Удалить</th>
          <?
            //Выбираем данные
            $sql = "
                  SELECT
                        p.id,
                        p.name,
                        m.name AS model,
                        kat.name AS kategoriya,
                        k.name AS katalog,
                        p.status
                  FROM product AS p
                  LEFT JOIN model AS m ON m.id = p.model_id
                  LEFT JOIN kategoriya AS kat ON kat.id = p.kat_id OR kat.id = m.kat_id
                  LEFT JOIN katalog AS k ON k.id = kat.katalog_id
            ";
            $query = mysql_query($sql);
            while($row = mysql_fetch_assoc($query)) {
              echo'<tr>
                    <td align="center" valign="middle""><a href="#" onclick="edit_product(' . $row['id'] . ');">' . $row['name'] . '</a></td>
                    <td align="center" valign="middle">' . $row['model'] . '</td>
                    <td align="center" valign="middle">' . $row['kategoriya'] . '</td>
                    <td align="center" valign="middle">' . $row['katalog'] . '</td>
                    <td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_product(' . $row['id'] . ');"/></td>
                   </tr>';
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>