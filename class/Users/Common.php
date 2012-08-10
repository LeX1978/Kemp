<?php

class Class_Users_Common extends Class_BaseCommon {
   /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'users';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Пользователи админки';
  }
  
  //Метод отображающий форму 
  public function add_form() {
   ob_start();
   ob_get_clean();
   include($_SERVER['DOCUMENT_ROOT'].'/class/Users/tpl/add_users_form.tpl');
  } 
}