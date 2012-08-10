<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 06.07.12
 * Time: 15:03
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
  <script src="/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="/js/upload/swfobject.js"></script>
  <script type="text/javascript" src="/js/upload/jquery.uploadify.v2.1.4.min.js"></script>
  <link rel="stylesheet" href="/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">
  <title>Добавление Модели товара</title>
  <script type="text/javascript">
    function save_model() {
      var name = document.getElementById('name').value;
      var kat_id = document.getElementById('kat_id').value;
      var f_img = document.getElementById('f_img').value;
      if(name && kat_id) {
        var params = 'name='+name+'&kat_id='+kat_id+'&img='+f_img;
        do_ajax('save_model',params,'','','post',0,0);
        alert('Модель добавлена!');
      }
      else {
        alert('Не все параметры указаны!');
      }
    }
  </script>
</head>
<body>
<?
$katCommon = new Class_Kategoriya_Common();
$katArray = $katCommon->Find('1=1','name');
unset($katCommon);
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
            Название модели:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="">
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" width="70px">
            Категория продукции:
          </td>
          <td align="left" valign="middle">
            <select id="kat_id">
              <option value> (не выбрано) </option>
              <?
              if($katArray) {
                foreach($katArray as $kat_Id => $kat_Name) {
                  echo'<option value="' . $kat_Id . '"> ' . $kat_Name . ' </option>';
                }
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle">
            <br/>
            Файл изображения для модели:
            <input type="text" id="f_img" value="" size="40"/><br/>
            <style type="text/css">
              #basic-demo .uploadifyQueueItem {
                background-color: #F5F5F5;
                border: 2px solid #E5E5E5;
                font: 11px Verdana, Geneva, sans-serif;
                margin-top: 5px;
                padding: 10px;
                width: 350px;
              }
              #basic-demo .uploadifyError {
                background-color: #FDE5DD !important;
                border: 2px solid #FBCBBC !important;
              }
              #basic-demo .uploadifyQueueItem .cancel {
                float: right;
              }
              #basic-demo .uploadifyQueue .completed {
                background-color: #E5E5E5;
              }
              #basic-demo .basic-demo .uploadifyProgress {
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                margin-top: 12px;
                width: 100%;
              }
              #basic-demo .demo-box .uploadifyProgressBar {
                background-color: #004eff;
                height: 3px;
                width: 1px;
              }
            </style>
            <div id="basic-demo" class="demo">
              <script type="text/javascript">
                $(function()
                {
                  $('#file_upload').uploadify
                    ({
                      'uploader'  : '/js/upload/uploadify.swf',
                      'script'    : '/js/upload/uploadify.php',
                      'cancelImg' : '/js/upload/cancel.png',
                      'folder'    : '/files',
                      'auto'      : false,
                      'onComplete'  : function(event, ID, fileObj, response, data)
                      {
                        var model_file = document.getElementById('f_img');
                        model_file.value = fileObj.name;
                        alert('Файл '+fileObj.name+' загружен на сервер!');
                      }
                    });
                });
              </script>
              <div class="demo-box">
                <input id="file_upload" type="file" name="Filedata" style="display: none; " width="120" height="30"/>
                <p><a href="javascript:$('#file_upload').uploadifyUpload()">Загрузить файл</a></p>
              </div>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="save_model();">
  </th>
</table>
</body>
</html>