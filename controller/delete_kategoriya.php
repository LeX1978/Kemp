<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 10:11
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$kat_id = $_REQUEST['kat_id'] ;
$kategoriyaCommon = new Class_Kategoriya_Common();
$kategoriyaCommon->DeleteEntirely($kat_id);
unset($kategoriyaCommon);