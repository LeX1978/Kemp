<?php

class Class_Roles_Common extends Class_BaseCommon {
   /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'roles';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Роли пользователей';
  }
  
  //Метод отображающий форму 
  public function add_form() {
   ob_start();
   ob_get_clean();
   include($_SERVER['DOCUMENT_ROOT'].'/class/Roles/tpl/add_role_form.tpl');
  } 
}