<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 9:46
 */
class Class_Page_Common extends Class_BaseCommon {
  /**
   * Конструктор класса
   */
  public function __construct() {
    parent::__construct();
    $this -> _tableName = 'pages';
    $this -> _guidField = 'id';
    $this -> _objectName = 'Страница сайта';
  }

}