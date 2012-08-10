<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lexus
 * Date: 11.07.12
 * Time: 0:22
 * To change this template use File | Settings | File Templates.
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$user_id = $_GET['user_id'] ? $_GET['user_id'] : false;

$clientCommon = new Class_Client_Common();
if($user_id) {
    $profile = $clientCommon->Read($user_id);
    if($profile) {
        //Читаем данные о профиле
        $email = $profile['email'];
        $name = $profile['name'];
        $type = $profile['type'];
        $kpp = $profile['kpp'];
        $uadres = $profile['uadres'];
        $padres = $profile['padres'];
        $inn = $profile['inn'];
        $contact = $profile['contact'];
        $phone = $profile['phone'];
        $bank = $profile['bank'];
        $rschet = $profile['rschet'];
        $kschet = $profile['kschet'];
        $bik = $profile['bik'];
    }
}
unset($clientCommon);
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
<h1 id="pagename">Информация о заказчике</h1>
<div class="tie text2">
    <div class="tie-indent">
        <div id="maincontent">
            <table width="100%">
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <? echo($email);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Наименование:
                    </td>
                    <td>
                        <? echo($name);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Тип:
                    </td>
                    <td>
                        <? echo($type);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Контакт:
                    </td>
                    <td>
                        <? echo($contact);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Телефон:
                    </td>
                    <td>
                        <? echo($phone);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Юридический адрес:
                    </td>
                    <td>
                        <? echo($uadres);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Почтовый адрес:
                    </td>
                    <td>
                        <? echo($padres);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        КПП:
                    </td>
                    <td>
                        <? echo($kpp);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Рассчетный счет:
                    </td>
                    <td>
                        <? echo($rschet);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Корреспондентский счет:
                    </td>
                    <td>
                        <? echo($kschet);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Банк:
                    </td>
                    <td>
                        <? echo($bank);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        ИНН:
                    </td>
                    <td>
                        <? echo($inn);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        БИК:
                    </td>
                    <td>
                        <? echo($bik);?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
