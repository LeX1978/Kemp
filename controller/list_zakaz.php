<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 16:52
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
    function open_zakaz(cart_id) {
        var url = '/controller/show_zakaz.php?cart_id='+cart_id;
        userWindow = window.open(url, 'zakaz', 'width:700;height:500;');
        userWindow.focus();
    }
    function open_profile(user_id) {
        var url = '/controller/show_profile.php?user_id='+user_id;
        userWindow = window.open(url, 'profile', 'width:700;height:500;');
        userWindow.focus();
    }
    function delete_zakaz(cart_id) {
        var params = 'cart_id='+cart_id;
        do_ajax('delete_cart',params,'','','post',0,0);
        self.location.reload();
        alert('Заказ Удален!');
    }
  </script>
</head>
<body>
<h1 id="pagename">Список страниц сайта</h1>
<div class="tie text2">
  <div class="tie-indent">
    <div id="maincontent">
      <table width="100%" class="katalog_table">
        <th align="center" valign="middle">Данные о заказе</th>
        <th align="center" valign="middle">Клиент</th>
        <th align="center" valign="middle">Почтовый адрес</th>
        <th align="center" valign="middle">Юридический адрес</th>
        <th align="center" valign="middle">Способ оплаты</th>
        <th align="center" valign="middle">Способ доставки</th>
        <th align="center" valign="middle">Статус</th>
        <th align="center" valign="middle">Удалить</th>
        <?
          //Выбираем данные
          $sql = "
            SELECT
              c.id,
              p.id AS user_id,
              p.name,
              p.padres,
              p.uadres,
              c.sposob_opl,
              c.dostavka,
              c.status
            FROM cart AS c
            LEFT JOIN profile AS p ON p.id = c.user_id
          ";
          $query = mysql_query($sql);
          while($row = mysql_fetch_assoc($query)) {
            if($row['status'] == 0) {
              $status = 'В работе';
              $style = 'style="background: #fcefa1;"';
            }
            else {
              $status = 'Заказан';
              $style = 'style="background: #eeffee;"';
            }
            echo'<tr ' . $style . '>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;"><a href="#" onclick="open_zakaz(' . $row['id'] . ');">Заказ №' . $row['id'] . '</a></td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;"><a href="#" onclick="open_profile(' . $row['user_id'] . ');">' . $row['name'] . '</a></td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;">' . $row['padres'] . '</td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;">' . $row['uadres'] . '</td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;">' . $row['sposob_opl'] . '</td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;">' . $row['dostavka'] . '</td>
                      <td align="center" valign="middle" style="color:#000; border: solid 1px #000;">' . $status . '</td>
                      <td align="center" valign="middle" border: solid 1px #000;><img src="/images/delete.gif" onclick="delete_zakaz(' . $row['id'] . ');"/></td>
                     </tr>';
          }
        ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>