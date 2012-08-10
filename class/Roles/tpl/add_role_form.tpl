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
  function add_role() {
    var role_name = document.getElementById('role_name').value;
    if(role_name) {
      var params = 'role_name='+role_name;
      do_ajax('add_role',params,'','','post',0,0);
      alert('Роль добавлена');
    }
    else {
      alert('Имя роли не задано!');
    }
  }
</script>

<title>Добавление роли</title>
</head>
<body>
  <table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
    <th height="50px" align="left" valign="middle" style="background: #1d5987;">
        <b>Добавление новой роли</b>
    </th>
    <tr>
      <td height="100px" align="left" valign="top">
        <p><b>Название роли:</b> <input type="text" size="100px" id="role_name" value=""></p>
      </td>
    </tr>
    <th height="50px" align="left" valign="middle" style="background: #1d5987;">
        <input type="button" value="Добавить роль" onclick="add_role();">
    </th>
  </table>
</body>
</html>
