<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 16:14
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$name = $_POST['name'] ? $_POST['name'] : false;
$content = $_POST['content'] ? $_POST['content'] : false;

$pageCommon = new Class_Page_Common();

if($name && $content) {
  $newData = array(
    'name' => $name,
    'content' => $content,
  );
  $pageCommon->Create($newData);
}
unset($pageCommon);