<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 9:46
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$id = $_GET['id'] ? $_GET['id'] : false;
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
  <title>Редактирование Категории товара</title>
  <script type="text/javascript">
    function update_kategoriya() {
      var name = document.getElementById('name').value;
      var katalog_id = document.getElementById('katalog').value;
      var guid = document.getElementById('kat_id').value;
      if(name && katalog_id) {
        var params = 'name='+name+'&katalog_id='+katalog_id+'&guid='+guid;
        do_ajax('update_kategoriya',params,'','','post',0,0);
        alert('Категория обновлена!');
        opener.location.reload();
        self.close();
      }
      else {
        alert('Не все параметры указаны!');
      }
    }
  </script>
</head>
<body>
<?
if($id) {
  $kategoriyaCommon = new Class_Kategoriya_Common();
  $katalogCommon = new Class_Katalog_Common();
  $katalofArray = $katalogCommon->Find('1=1','name');
  $kategoriya = $kategoriyaCommon->Read($id);
  unset($kategoriyaCommon);
  unset($katalogCommon);
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Редактирование Катeгории</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Название каталога:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="<?=$kategoriya['name']?>">
            <input type="hidden" id="kat_id" value="<?=$id?>">
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
                    if($katalogId == $kategoriya['katalog_id']) {
                      echo'<option value="' . $katalogId . '" selected> ' . $katalogName . ' </option>';
                    }
                    else {
                      echo'<option value="' . $katalogId . '"> ' . $katalogName . ' </option>';
                    }
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
    <input type="button" value="Сохранить изменения" onclick="update_kategoriya();">
  </th>
</table>
</body>
</html>