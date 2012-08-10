<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 15:59
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');


$name = $_REQUEST['name'] ;
$kat_id = $_REQUEST['kat_id'];
$guid = $_REQUEST['guid'];
$image = $_REQUEST['image'];


$modelCommon = new Class_Model_Common();

//Добавление пользователя
$newData = array(
  'name' => $name,
  'kat_id' => $kat_id,
  'image' => $image
);
$modelCommon->Update($guid,$newData);
unset($modelCommon);