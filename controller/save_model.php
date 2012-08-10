<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 15:32
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$name = $_POST['name'] ? $_POST['name'] : false;
$kat_id = $_POST['kat_id'] ? $_POST['kat_id'] : false;
$img = $_POST['img'] ? $_POST['img'] : false;

$modelCommon = new Class_Model_Common();

//Добавление пользователя
if($name && $kat_id) {
  $newData = array(
    'name' => $name,
    'kat_id' => $kat_id,
    'image' => $img
  );
  $modelCommon->Create($newData);
}
unset($modelCommon);