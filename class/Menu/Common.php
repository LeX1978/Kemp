<?php

class Class_Menu_Common extends Class_BaseCommon {
   /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'menu';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Меню административной части';
  }

  //Метод отображающий форму
  public function add_form() {
    ob_start();
    ob_get_clean();
    include($_SERVER['DOCUMENT_ROOT'].'/class/Menu/tpl/add_menu_form.tpl');
  }

  //Метод отображения дерева меню
  public function drawMenu($parent,$role) {
    $where = "parent = " . $parent . " AND role_id IN (130," . $role. ")";
    $menuArray = $this->Find($where, array('name','parent','url','target'));
    if(count($menuArray) > 0) {
      foreach($menuArray as $id => $val) {
          if($val['url']) {
            echo '<li><a href="' . $val['url']  . '" target="' . $val['target'] . '">' . $val['name'] . '</a>';
          }
          else {
            echo '<li><a>' . $val['name'] . '</a>';
          }

            //Проверяем есть ли дети
            $where = "parent = " . $id . " AND role_id IN (130," . $role. ")";
            $childArray = $this->Find($where, array('name','parent','url','target'));
            if(count($childArray) > 0) {
              echo '<ul>';
                $this->drawMenu($id,$role);
              echo '</ul>';
            }
          echo '</li>';
      }
    }
  }
}