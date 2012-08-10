<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 29.06.12
 * Time: 10:50
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$name = $_POST['name'] ? $_POST['name'] : false;
$url = $_POST['url'] ? $_POST['url'] : false;
$parent = $_POST['parent'] ? $_POST['parent'] : 0;
$role = $_POST['role'] ? $_POST['role'] : false;
$is_main = $_POST['main'] ? $_POST['main'] : 0;

$menuCommon = new Class_Menu_Common();

//Добавление пункта меню
if($url && $name && $role) {
  $newData = array(
    'url' => $url,
    'parent' => $parent,
    'name' => $name,
    'role_id' => $role,
    'main' => $is_main
  );
  $menuCommon->Create($newData);
}

//Отображаем форму добавления пользователя
$menuCommon->add_form();

unset($menuCommon);