<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 29.06.12
 * Time: 17:44
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$katalog_id = $_GET['id'] ? $_GET['id'] : false;
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
  <title>Редактирование пользователя</title>
  <script type="text/javascript">
    function update_katalog() {
      var name = document.getElementById('name').value;
      var url = document.getElementById('url').value;
      var kat_id = document.getElementById('kat_id').value;
      if(name && url && kat_id) {
        var params = 'name='+name+'&url='+url+'&kat_id='+kat_id;
        do_ajax('update_katalog',params,'','','post',0,0);
        alert('Каталог обновлен!');
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
if($katalog_id) {
  $katalogCommon = new Class_Katalog_Common();
  $katalog = $katalogCommon->Read($katalog_id);
  unset($katalogCommon);
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Редактирование Каталога</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Название каталога:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="<?=$katalog['name']?>">
            <input type="hidden" id="kat_id" value="<?=$katalog_id?>">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Ссылка:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="url" size="40px" value="<?=$katalog['url']?>">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="update_katalog();">
  </th>
</table>
</body>
</html>