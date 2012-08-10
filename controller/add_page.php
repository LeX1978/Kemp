<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 16:10
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="/css/style.css" rel="stylesheet" type="text/css" />
  <link href="/css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8">
  <link href="/css/redactor/redactor.css" rel="stylesheet" />
  <script type="text/javascript" src="/js/jquery.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  <script type="text/javascript" src="/js/ajax.js"></script>
  <script type="text/javascript" src="/js/jquery-1.6.1.min.js"></script>
  <script type="text/javascript" src="/js/jquery-ui-1.8.13.custom.min.js"></script>
  <script type="text/javascript" src="/js/upload/swfobject.js"></script>
  <script type="text/javascript" src="/js/upload/jquery.uploadify.v2.1.4.min.js"></script>
  <script type="text/javascript" src="/js/redactor/redactor.js"></script>
  <script type="text/javascript">
    $(document).ready(
      function()
      {
        $('#redactor_content').redactor({
          imageUpload: '/controller/image_upload.php',
          fileUpload: '/controller/file_upload.php',
          imageGetJson: '/controller/json/data.json'
        });
      }
    );
  </script>
  <title>Добавление страницы сайта</title>
  <script type="text/javascript">
    function save_page() {
      var name = document.getElementById('name').value;
      var content = document.getElementById('redactor_content').value;
      if(name && content) {
        var params = 'name='+name+'&content='+content;
        do_ajax('save_page',params,'','','post',0,0);
        alert('Страница добавлена!');
      }
      else {
        alert('Не все параметры указаны!');
      }
    }
  </script>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Добавление страницы сайта</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="left" valign="middle" width="70px">
            Название страницы:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="">
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Контент страницы:</td>
          <td width="598">
            <textarea id="redactor_content" name="redactor_content" style="height: 460px;"></textarea>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="save_page();">
  </th>
</table>
</body>
</html>