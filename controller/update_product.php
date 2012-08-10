<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 12:24
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$name = $_POST['name'] ? $_POST['name'] : false;
$kat_id = $_POST['kat_id'] ? $_POST['kat_id'] : false;
$file = $_POST['file'] ? $_POST['file'] : false;
$model_id = $_POST['model_id'] ? $_POST['model_id'] : false;
$cena = $_POST['cena'] ? $_POST['cena'] : false;
$garant = $_POST['garant'] ? $_POST['garant'] : false;
$status = $_POST['status'] ? $_POST['status'] : false;
$text = $_POST['text'] ? $_POST['text'] : false;
$full_text = $_POST['full_text'] ? $_POST['full_text'] : false;
$find = $_POST['find'] ? $_POST['find'] : false;
$guid = $_POST['guid'] ? $_POST['guid'] : false;

$productCommon = new Class_Product_Common();

  $newData = array(
    'name' => $name,
    'kat_id' => $kat_id,
    'model_id' => $model_id,
    'file' => $file,
    'cena' => $cena,
    'garant' => $garant,
    'text' => $text,
    'status' => $status,
    'find' => $find,
    'full_text' => $full_text
  );
  $productCommon->Update($guid,$newData);

unset($productCommon);