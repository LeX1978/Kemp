<?
if (!isset($_POST['ok'])) {
  echo"
	<html>
	<head>
	<title>Административная часть</title>
	</head>
	<body>
	<table width='100%' height='100%'>
	<form method='POST' action='index.php'>
	<tr><td align=center>
	<table>
	<tr><td>
	<table>
	<tr><td>Имя пользователя:</td><td><input type='text'
        name='login' size='15'></td></tr>
	<tr><td>Пароль:</td><td><input
        type='password' name='pass' size='15'></td></tr>
	</table>
	</td></tr>
	<tr><td align=center><input type='submit' name='ok'
        value='Вход'></td></tr>
	</table>
	</td></tr>
	</form>
	</table>
	</body>
	</html>
	";
} 
else {
  require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
  $login = $_POST['login'];
  $password = md5($_POST['pass']);
  $sql = "SELECT count(*) AS kol FROM users WHERE login = '" . $login . "' AND password = '" . $password . "'";
  $query = mysql_query($sql);
  while($res = mysql_fetch_assoc($query)) {
	$kol = $res['kol'];
  }
  if ($kol > 0) {
    $sql = "SELECT * FROM users WHERE login = '" . $login . "' AND password = '" . $password . "'";
    $query = mysql_query($sql);
    while($user = mysql_fetch_assoc($query)) {
      $user_id = $user['id'];
      $user_name = $user['name'];
      $user_role = $user['role_id'];
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/admin/main.php');
  } 
  else {
    echo "Не верное имя пользователя или пароль";
  }
}
?>

