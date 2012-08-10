<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 9:58
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');


$name = $_REQUEST['name'] ;
$katalog_id = $_REQUEST['katalog_id'];
$guid = $_REQUEST['guid'];


$kategoriyaCommon = new Class_Kategoriya_Common();

//Добавление пользователя
$newData = array(
  'name' => $name,
  'katalog_id' => $katalog_id
);
$kategoriyaCommon->Update($guid,$newData);
unset($katalogCommon);