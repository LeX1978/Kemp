<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 9:48
 */
class Class_Model_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'model';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Модель продукции';
  }

}