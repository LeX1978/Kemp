<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lexus
 * Date: 10.07.12
 * Time: 22:13
 * To change this template use File | Settings | File Templates.
 */
class Class_Client_Common extends Class_BaseCommon {
    /**
     * Конструктор класса
     */
    public function __construct() {
        parent::__construct();
        $this -> _tableName = 'profile';
        $this -> _guidField = 'id';
        $this -> _objectName = 'Клиенты';
    }

}