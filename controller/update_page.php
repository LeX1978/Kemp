<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 16:25
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$name = $_POST['name'] ? $_POST['name'] : false;
$content = $_POST['content'] ? $_POST['content'] : false;
$guid = $_POST['page_id'] ? $_POST['page_id'] : false;

$pageCommon = new Class_Page_Common();

$newData = array(
  'name' => $name,
  'content' => $content
);
$pageCommon->Update($guid,$newData);

unset($pageCommon);