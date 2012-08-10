<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 9:48
 */
class Class_Product_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'product';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Продукция';
  }

}