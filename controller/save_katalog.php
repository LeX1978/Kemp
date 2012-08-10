<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 02.07.12
 * Time: 15:09
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$name = $_POST['name'] ? $_POST['name'] : false;
$url = $_POST['url'] ? $_POST['url'] : false;

$katalogCommon = new Class_Katalog_Common();

//Добавление пользователя
if($name && $url) {
  $newData = array(
    'name' => $name,
    'url' => $url
  );
  $katalogCommon->Create($newData);
}
unset($katalogCommon);