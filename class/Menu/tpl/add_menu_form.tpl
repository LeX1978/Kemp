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
  function add_menu() {
    var name = document.getElementById('name').value;
    var url = document.getElementById('url').value;
    var role = document.getElementById('role').value;
    var parent = document.getElementById('parent').value;
    var is_main = 0;
    if(document.main_frm.mainmenu.checked == true) {
      is_main = 1;
    }

    if(name && url && role) {
      var params = 'name='+name+'&url='+url+'&role='+role+'&parent='+parent+'&main='+is_main;
      do_ajax('add_menu',params,'','','post',0,0);
      alert('Раздел меню добавлен!');
    }
    else {
      alert('Не все параметры заданы!');
    }
  }
</script>

<title>Добавление Пользователя</title>
</head>
<body>
<form name="main_frm" action="" method="POST">
  <table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
    <th height="50px" align="left" valign="middle" style="background: #1d5987;">
        <b>Добавление нового раздела меню</b>
    </th>
    <tr>
      <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="right" valign="middle" width="70px">
            Название раздела:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="100px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            URL:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="url" size="100px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Доступен для роли:
          </td>
          <td align="left" valign="middle">
            <select id="role">
              <option value='130' selected> (доступен всем) </option>
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
        <tr>
          <td align="right" valign="middle" width="70px">
            Основной пункт меню:
          </td>
          <td align="left" valign="middle">
            <input type="checkbox" name="mainmenu" value="1">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Родительский пункт меню:
          </td>
          <td align="left" valign="middle">
            <select id="parent">
              <option value selected> (не выбрано) </option>
              <?
                $menuCommon = new Class_Menu_Common();
                $menuArray = array();
                $where = '1=1';
                $menuArray = $menuCommon->Find($where,'name');
                if($menuArray) {
                  foreach($menuArray as $menuId => $menuName) {
                    echo'<option value="' . $menuId . '"> ' . $menuName . ' </option>';
                  }
                }
                unset($menuCommon);
              ?>
            </select>
          </td>
        </tr>
      </table>
      </td>
    </tr>
    <th height="50px" align="left" valign="middle" style="background: #1d5987;">
        <input type="button" value="Добавить пункт меню" onclick="add_menu();">
    </th>
  </table>
</form>
</body>
</html>
