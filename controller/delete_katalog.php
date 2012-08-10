<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 02.07.12
 * Time: 17:07
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$kat_id = $_REQUEST['kat_id'] ;
$katalogCommon = new Class_Katalog_Common();
$katalogCommon->DeleteEntirely($kat_id);
unset($katalogCommon);