<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 29.06.12
 * Time: 17:44
 * Редактирование пользователя
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
$user_id = $_GET['id'] ? $_GET['id'] : false;
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
</head>
<body>
<?
  if($user_id) {
    $userCommon = new Class_Users_Common();
    $user = $userCommon->Read($user_id);
    unset($userCommon);
  }
?>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Редактирование пользователя</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Имя пользователя:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="login" size="40px" value="<?=$user['login']?>">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Ф.И.О.
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="<?=$user['name']?>">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Роль:
          </td>
          <td align="left" valign="middle">
            <select id="role">
              <option value> (не выбрано) </option>
              <?
              $roleCommon = new Class_Roles_Common();
              $roleArray = array();
              $where = '1=1';
              $roleArray = $roleCommon->Find($where,'name');
              if($roleArray) {
                foreach($roleArray as $roleId => $roleName) {
                  if($roleId == $user['role_id']) {
                    echo'<option value="' . $roleId . '" selected> ' . $roleName . ' </option>';
                  }
                  else {
                    echo'<option value="' . $roleId . '"> ' . $roleName . ' </option>';
                  }
                }
              }
              unset($roleCommon);
              ?>
            </select>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="update_user();">
  </th>
</table>
</body>
</html>