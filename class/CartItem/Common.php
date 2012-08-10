<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 9:53
 */
class Class_CartItem_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'cart_item';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Товар в корзине';
  }

}