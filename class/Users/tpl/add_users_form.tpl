<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/ajax.js"></script>
<script type="text/javascript">
  function add_user() {
    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;
    var name = document.getElementById('name').value;
    var role = document.getElementById('role').value;

    if(login && password && name && role) {
      var params = 'login='+login+'&password='+password+'&name='+name+'&role='+role;
      do_ajax('add_user',params,'','','post',0,0);
      alert('Пользователь добавлен!');
    }
    else {
      alert('Не все параметры заданы!');
    }
  }
</script>

<title>Добавление Пользователя</title>
</head>
<body>
  <table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
    <th height="50px" align="left" valign="middle" style="background: #1d5987;">
        <b>Добавление новой пользователя</b>
    </th>
    <tr>
      <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Имя пользователя:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="login" size="100px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Пароль:
          </td>
          <td align="left" valign="middle">
            <input type="password" id="password" size="100px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Ф.И.О.
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="100px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Роль:
          </td>
          <td align="left" valign="middle">
            <select id="role">
              <option value selected> (не выбрано) </option>
              <?
                $roleCommon = new Class_Roles_Common();
                $roleArray = array();
                $where = '1=1';
                $roleArray = $roleCommon->Find($where,'name');
                if($roleArray) {
                    foreach($roleArray as $roleId => $roleName) {
                      echo'<option value="' . $roleId . '"> ' . $roleName . ' </option>';
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
        <input type="button" value="Добавить пользователя" onclick="add_user();">
    </th>
  </table>
</body>
</html>
