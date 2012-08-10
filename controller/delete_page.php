<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 16:07
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$page_id = $_REQUEST['page_id'] ;
$pageCommon = new Class_Page_Common();
$pageCommon->DeleteEntirely($page_id);
unset($pageCommon);