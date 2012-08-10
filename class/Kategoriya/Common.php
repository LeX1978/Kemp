<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 9:48
 */
class Class_Kategoriya_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'kategoriya';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Категория продукции';
  }

}