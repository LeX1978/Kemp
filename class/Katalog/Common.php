<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 02.07.12
 * Time: 14:12
 */

class Class_Katalog_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'katalog';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Каталог продукции';
  }
 
}