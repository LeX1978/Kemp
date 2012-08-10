<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 29.06.12
 * Time: 17:16
 * Модуль отображения списка пользователей
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
    function edit_user(id){
      var url = '/controller/edit_user.php?id='+id;
      userWindow = window.open(url, 'edit_user', 'dialogwidth:700;dialogheight:500;dialogleft:100;dialogtop:100;');
      userWindow.focus();
    }
  </script>
</head>
<body>
<?

  echo'<h1 id="pagename">Список пользователей</h1>';
  echo'<div class="tie text2">';
  echo'<div class="tie-indent">';
  echo'<div id="maincontent">';
  echo'<table width="100%" class="katalog_table">
			    <th align="center" valign="middle">Ф.И.О.</th>
				  <th align="center" valign="middle">Имя пользователя</th>
					<th align="center" valign="middle">Роль</th>
					<th align="center" valign="middle">Удалить</th>';
  //Выбираем данные
  $sql = "
        SELECT
            u.id,
            u.name,
            u.login,
            r.name AS role_name
        FROM users AS u
        INNER JOIN roles AS r ON r.id = u.role_id
  ";
  $query = mysql_query($sql);
  while($row = mysql_fetch_assoc($query)) {
    echo'<tr>
				  <td align="center" valign="middle""><a href="#" onclick="edit_user(' . $row['id'] . ');">' . $row['name'] . '</a></td>
					<td align="center" valign="middle">' . $row['login'] . '</td>
					<td align="center" valign="middle">' . $row['role_name'] . '</td>
					<td align="center" valign="middle"><img src="/images/delete.gif" onclick="delete_user(' . $row['id'] . ');"/></td>
				 </tr>';
  }
  echo'</table>';
  echo'</div></div></div>';
?>
</body>
</html>
