<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 16:01
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$mod_id = $_REQUEST['mod_id'] ;
$modelCommon = new Class_Model_Common();
$modelCommon->DeleteEntirely($mod_id);
unset($modelCommon);