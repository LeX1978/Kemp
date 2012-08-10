<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lexus
 * Date: 11.07.12
 * Time: 0:40
 * To change this template use File | Settings | File Templates.
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$cart_id = $_REQUEST['cart_id'] ;
$cartCommon = new Class_Cart_Common();
$itemCommon = new Class_CartItem_Common();
$where = 'cart_id = '.$cart_id;
$items = $itemCommon->Find($where);
foreach($items as $item_id) {
  $itemCommon->DeleteEntirely($item_id);
}
$cartCommon->DeleteEntirely($cart_id);
unset($cartCommon);
unset($itemCommon);