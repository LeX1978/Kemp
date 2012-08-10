<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 15:52
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
    function edit_page(id){
      var url = '/controller/edit_page.php?id='+id;
      userWindow = window.open(url, 'edit_page', 'width:700;height:500;');
      userWindow.focus();
    }
    function delete_page(id) {
      var params = 'page_id='+id;
      do_ajax('delete_page',params,'','','post',0,0);
      self.location.reload();
      alert('Страница Удалено!');
    }
  </script>
</head>
<body>
<h1 id="pagename">Список страниц сайта</h1>
<div class="tie text2">
  <div class="tie-indent">
    <div id="maincontent">
      <table width="100%" class="katalog_table">
        <th align="center" valign="middle">Страница</th>
        <th align="center" valign="middle">Удалить</th>
        <?
        //Выбираем данные
        $sql = "
                  SELECT
                        p.id,
                        p.name
                  FROM pages AS p
            ";
        $query = mysql_query($sql);
        while($row = mysql_fetch_assoc($query)) {
          echo'<tr>
                    <td align="center" valign="middle""><a href="#" onclick="edit_page(' . $row['id'] . ');">' . $row['name'] . '</a></td>
                    <td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_page(' . $row['id'] . ');"/></td>
                   </tr>';
        }
        ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>
