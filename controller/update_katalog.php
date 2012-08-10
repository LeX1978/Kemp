<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 02.07.12
 * Time: 15:23
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');


$name = $_REQUEST['name'] ;
$url = $_REQUEST['url'];
$kat_id = $_REQUEST['kat_id'] ;

$katalogCommon = new Class_Katalog_Common();

//Добавление пользователя
  $newData = array(
    'name' => $name,
    'url' => $url
  );
  $katalogCommon->Update($kat_id,$newData);
unset($katalogCommon);