<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 10:02
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="/css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/js/jquery.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  <script type="text/javascript" src="/js/ajax.js"></script>
  <title>Добавление Категории товара</title>
  <script type="text/javascript">
    function save_kategoriya() {
      var name = document.getElementById('name').value;
      var katalog = document.getElementById('katalog').value;
      if(name && katalog) {
        var params = 'name='+name+'&katalog='+katalog;
        do_ajax('save_kategoriya',params,'','','post',0,0);
        alert('Категория добавлен!');
      }
      else {
        alert('Не все параметры указаны!');
      }
    }
  </script>
</head>
<body>
<?
  $katalogCommon = new Class_Katalog_Common();
  $katalofArray = $katalogCommon->Find('1=1','name');
  unset($katalogCommon);
?>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Добавление Катeгории</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Название каталога:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Каталог продукции:
          </td>
          <td align="left" valign="middle">
            <select id="katalog">
              <option value> (не выбрано) </option>
              <?
              if($katalofArray) {
                foreach($katalofArray as $katalogId => $katalogName) {
                    echo'<option value="' . $katalogId . '"> ' . $katalogName . ' </option>';
                }
              }
              ?>
            </select>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="save_kategoriya();">
  </th>
</table>
</body>
</html>