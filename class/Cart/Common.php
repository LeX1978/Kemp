<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 9:49
 */
class Class_Cart_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'cart';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Корзина';
  }

}