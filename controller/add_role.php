<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');

$new_role = $_POST['role_name'] ? $_POST['role_name'] : false;

$roleCommon = new Class_Roles_Common();
//���������� ����
if($new_role) {
	$newData = array('name' => $new_role);
    $roleCommon->Create($newData);
}

//���������� ����� ����������
$roleCommon->add_form();

unset($roleCommon);


