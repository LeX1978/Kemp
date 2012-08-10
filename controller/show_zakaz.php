<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lexus
 * Date: 10.07.12
 * Time: 21:31
 * To change this template use File | Settings | File Templates.
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$cart_id = $_GET['cart_id'] ? $_GET['cart_id'] : false;
$cartCommon = new Class_Cart_Common();
$itemCommon = new Class_CartItem_Common();
$productCommon = new Class_Product_Common();

//Читаем данные из корзины
$cart = $cartCommon->Read($cart_id);
$sposob_opl = $cart['sposob_opl'];
$dostavka = $cart['dostavka'];
$adr_dost = $cart['adr_dost'];
$station = $cart['Station'];


//Читаем данные о составляющих корзины
$where = 'cart_id = '.$cart_id;
$items = $itemCommon->Find($where,array('prod_id','kol','summa'));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/ajax.js"></script>
</head>
<body>
<h1 id="pagename">Заказ №<? echo($cart_id); ?></h1>
<div class="tie text2">
    <div class="tie-indent">
        <div id="maincontent">
            <table width="100%">
                <tr>
                    <td>
                        Способ облаты:
                    </td>
                    <td>
                        <? echo($sposob_opl);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Способ доставки:
                    </td>
                    <td>
                        <? echo($dostavka);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Адрес доставки:
                    </td>
                    <td>
                        <? echo($adr_dost);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Станция:
                    </td>
                    <td>
                        <? echo($station);?>
                    </td>
                </tr>
                <tr style="background: #809cad;">
                   <td colspan="2" align="center" valign="middle">СОСТАВ ЗАКАЗА</td>
                </tr>
                <tr>
                    <td colspan="2" align="center" valign="middle">&nbsp;</td>
                </tr>
                <?
                    foreach($items as $item_id => $values) {
                        $product = $productCommon->Read($values['prod_id']);
                        echo '<tr>';
                        echo '<td>Изделие:</td>';
                        echo '<td>'.$product['name'].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Цена:</td>';
                        echo '<td>'.$product['cena'].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Кол-во:</td>';
                        echo '<td>'.$values['kol'].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Сумма:</td>';
                        echo '<td>'.$values['summa'].'</td>';
                        echo '</tr>';
                        echo '<tr><td colspan="2" align="center" valign="middle">&nbsp;</td></tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<?
unset($productCommon);
unset($itemCommon);
unset($cartCommon);
?>