<?

abstract class Class_BaseCommon {

  /** @var Имя поля-идентификатора объекта */
  protected $_guidField;

  /** @var Имя таблицы объекта (без префикса) */
  protected $_tableName;

  /** @var Наименование объекта */
  protected $_objectName;

  /** @var Массив полей таблицы объекта */
  protected $_tableFields;

  /** @var Массив дополнительных атрибутов объекта */
  protected $_properties;
  
  /**
   * Конструктор класса
   */
  public function __construct() {

    $this->_guidField = 'id';
    $this->_tableName = '';
    $this->_tableFields = array();
    $this->_objectName = '';
    $this->_properties = array();
  }
  
  /**
   * Получение атрибута объекта
   * @param $field - имя атрибута
   * @return значение атрибута (null в случае ошибки)
   */
  public function __get($field) {
    switch ($field) {
      case 'guidField':
        $result = $this->_guidField;
        break;

      case 'tableName':
        $result = $this->_tableName;
        break;

      case 'tableFields':
        if (!$this->_tableFields) {
          $this->_tableFields = $this->GetTableFields();
        }
        $result = $this->_tableFields;
        break;

      default:
        $result = (isset($this->_properties[$field]) ? $this->_properties[$field] : null);
        break;
    }
   return $result;
  }

  /**
   * Изменение атрибута объекта
   * @param $field - имя атрибута
   * @param $value - новое значение атрибута
   * @return результат установки значения атрибута (true/false)
   */
  public function __set($field, $value) {

    switch ($field) {

      case 'guidField':
      case 'tableName':
      case 'tableFields':
        $result = false;
        break;

      default:
        $this->_properties[$field] = $value;
        $result = true;
        break;
    }
    return $result;
  }
  
  /**
   * Получение массива полей таблицы объекта
   * @return массив полей таблицы объекта
   */
  public function GetTableFields() {
    $result = array();

    if (!$this->tableName) {
      return $result;
    }

    $sql = "
      EXPLAIN {$this->tableName}
    ";
    $query = mysql_query($sql);
    while ($val = mysql_fetch_assoc($query)) {
      $result[] = strtolower($val['Field']);
    }
    return $result;
  }
  
  /**
   * Проверка принадлежности поля таблице объекта
   * @param $fieldName - имя поля
   * @return результат проверки (true/false)
   */
  public function IsTableField($fieldName) {
    return in_array(strtolower($fieldName), $this->tableFields);
  }
  
  /**
   * Поиск объектов по условию
   * @param $where - условие поиска
   * @param $fieldName - поле, значение которого нужно получить (или массив для нескольких полей)
   * @param $sort - порядок сортировки
   * @param $limit - порция выборки
   * @return ассоциативный массив найденных объектов ([id] => значение поля/полей) (false в случае ошибки)
   */
  public function Find($where, $fieldName = '', $sort = '', $limit = '') {

    if (!$where) {
      return false;
    }

    $fieldName = $fieldName ? $fieldName : $this->guidField;
    $sort = $sort ? 'ORDER BY '.$sort : '';
    $limit = $limit ? 'LIMIT '.$limit : '';

    $sql = "SELECT `".$this->guidField."` FROM ".$this->tableName." WHERE ".$where." ".$sort." ".$limit;
    $query = mysql_query($sql);

    if (!$query) {
      return false;
    }

    $result = array();
    while ($val = mysql_fetch_assoc($query)) {
      if (is_array($fieldName)) {
        $resultValue = array();
        $data = $this->Read($val[$this->guidField]);
        foreach ((array)$fieldName as $field) {
          if (isset($data[$field])) {
            $resultValue[$field] = $data[$field];
          }
        }
      }
      else {
        $resultValue = $this->Read($val[$this->guidField], $fieldName);
      }
      $result[$val[$this->guidField]] = $resultValue;
    }
    return $result;
  }
  
  /**
   * Получение реквизита первого объекта, удовлетворяющего условиям поиска
   * @param $where - условие поиска
   * @param $fieldName - поле, значение которого нужно получить (или массив для нескольких полей)
   * @param $sort - порядок сортировки
   * @return значение реквизита найденного объекта (или ассоциативный массив реквизитов) (false в случае ошибки)
   */
  public function FindFirst($where, $fieldName = '', $sort = '') {
    $result = $this->Find($where, $fieldName, $sort, 1);
    if (is_array($result) && count($result)) {
      $result = array_values($result);
      $result = $result[0];
    }
    else {
      $result = false;
    }
    return $result;
  }
  
  /**
   * Создание нового объекта
   * @param $newData - ассоциативный массив данных
   * @return string GUID нового объекта (false в случае ошибки)
   */
  public function Create($newData) {
    if (!is_array($newData) || !count($newData)) {
      return false;
    }

    if (!$this->BeforeChange('', array(), $newData)) {
      return false;
    }

    $result = false;

    $fieldsString = '';
    foreach ($newData as $field => $value) {
      if ($this->IsTableField($field)) {
        $value = mysql_real_escape_string(stripslashes(trim($value)));
        $fieldsString .= "`{$field}` = '{$value}', ";
      }
    }
    if ($fieldsString) {
      $fieldsString = substr($fieldsString, 0, -2);
      $sql = "INSERT INTO ".$this->tableName." SET ".$fieldsString;
      $result = mysql_query($sql);
      if ($result) {
        $result = (strtolower($this->guidField) == 'id' ? $newData[$this->guidField] : mysql_insert_id());
        $this->AfterChange($result, array(), $this->Read($result));
      }
    }
    return $result;
  }
  
  /**
   * Получение всех реквизитов объекта
   * @param $guid - ID объекта
   * @param $fieldName - имя поля, которое необходимо получить (если не указано, то выбираются все поля)
   * @return значение указанного поля или ассоциативный массив полей объекта (false в случае ошибки)
   */
  public function Read($guid, $fieldName = '') {

    if ($fieldName && !$this->IsTableField($fieldName)) {
      return false;
    }

    $result = false;

    $sql = "
      SELECT
        ".($fieldName ? '`'.$fieldName.'`' : '*')."
      FROM {$this->tableName}
      WHERE
        `{$this->guidField}` = '{$guid}'
      LIMIT 1
    ";
    $query = mysql_query($sql);
    if ($query && $row = mysql_fetch_assoc($query)) {
      $result = ($fieldName ? $row[$fieldName] : $row);
    }
    return $result;
  }
  
    /**
   * Обновление существующего объекта
   * @param $guid - ID обновляемого объекта
   * @param $newData - ассоциативный массив данных для обновления
   * @return результат операции (true/false)
   */
  public function Update($guid, $newData) {
    if (!is_array($newData)) {
      return false;
    }
    $oldData = $this->Read($guid);

    if (!$oldData || !is_array($oldData)) {
      return false;
    }

    // Избавим массив от неизменившихся данных
    foreach ($newData as $field => $value) {
      if ($oldData[$field] == $value) {
        unset($newData[$field]);
      }
    }

    $result = false;

    $fieldsString = '';
    foreach ($newData as $field => $value) {
      if ($this->IsTableField($field) && $newData[$field] != $oldData[$field]) {
        $value = mysql_real_escape_string(stripslashes(trim($value)));
        $fieldsString .= "`{$field}` = '{$value}', ";
      }
    }
    if ($fieldsString) {
      $fieldsString = substr($fieldsString, 0, -2);
      $sql = "UPDATE {$this->tableName} SET ".$fieldsString." WHERE `".$this->guidField."` = '".$guid."' LIMIT 1";
      $result = mysql_query($sql);
    }
    return $result;
  }
  
   /**
   * Удаление существующего объекта
   * @param $guid - GUID удаляемого объекта
   * @return результат операции (true/false)
   */
  public function Delete($guid) {
    if ($this->IsTableField('attb')) {
      return $this->Update($guid, array('attb' => 128));
    }
    else {
      $oldData = $this->Read($guid);
      $oldData['attb'] = 0;
      $newData = array('attb' => 128);
      $this->BeforeChange($guid, $oldData, $newData);
      $newData = $this->Read($guid);
      $newData['attb'] = 128;
      $this->AfterChange($guid, $oldData, $newData);
      return true;
    }
  }
  /**
   * Полное удаление существующего объекта
   * @param $guid - GUID удаляемого объекта
   * @return результат операции (true/false)
   */
  public function DeleteEntirely($guid) {
      $sql = "
        DELETE FROM {$this->tableName}
        WHERE
          `{$this->guidField}` = '{$guid}'
        LIMIT 1
      ";
      $result = mysql_query($sql);
    return $result;
  }
  
   /**
   * Проверка допустимости изменений
   * @param $guid - GUID объекта
   * @param $newData - ассоциативный массив измененных данных
   * @param $oldData - ассоциативный массив старых данных
   * @return результат проверки (true/false)
   */
  public function BeforeChange($guid, $oldData, &$newData) {
    return true;
  }

  /**
   * Действия после изменения данных
   * @param $guid - GUID объекта
   * @param $oldData - ассоциативный массив данных до изменений
   * @param $newData - ассоциативный массив измененных данных
   * @return void
   */
  public function AfterChange($guid, $oldData, $newData) {
    return true;
  }
}