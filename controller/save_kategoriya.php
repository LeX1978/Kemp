<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 10:09
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$name = $_POST['name'] ? $_POST['name'] : false;
$katalog = $_POST['katalog'] ? $_POST['katalog'] : false;

$kategoriyaCommon = new Class_Kategoriya_Common();

//Добавление пользователя
if($name && $katalog) {
  $newData = array(
    'name' => $name,
    'katalog_id' => $katalog
  );
  $kategoriyaCommon->Create($newData);
}
unset($kategoriyaCommon);