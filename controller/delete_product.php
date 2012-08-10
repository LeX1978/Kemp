<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 12:03
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$prod_id = $_REQUEST['prod_id'] ;
$productCommon = new Class_Product_Common();
$productCommon->DeleteEntirely($prod_id);
unset($productCommon);