<?
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$login = $_POST['login'] ? $_POST['login'] : false;
$password = $_POST['password'] ? md5($_POST['password']) : false;
$name = $_POST['name'] ? $_POST['name'] : false;
$role = $_POST['role'] ? $_POST['role'] : false;

$userCommon = new Class_Users_Common();

//Добавление пользователя
if($login && $password && $name && $role) {
	$newData = array(
						'login' => $login,
						'password' => $password,
						'name' => $name,
						'role_id' => $role
					);
    $userCommon->Create($newData);
}

//Отображаем форму добавления пользователя
$userCommon->add_form();

unset($userCommon);