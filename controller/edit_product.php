<?
/**
 * Created by JetBrains PhpStorm.
 * User: OrlovAV
 * Date: 10.07.12
 * Time: 15:14
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
  <script src="/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="/js/upload/swfobject.js"></script>
  <script type="text/javascript" src="/js/upload/jquery.uploadify.v2.1.4.min.js"></script>
  <script type="text/javascript" src="/js/redactor/redactor.js"></script>
  <link href="/css/redactor/redactor.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">
  <title>Редактирование Модели товара</title>
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
  <title>Добавление продукции</title>
  <script type="text/javascript">
    function update_product() {
      var name = document.getElementById('name').value;
      var model_id = document.getElementById('model_id').value;
      var kat_id = document.getElementById('kat_id').value;
      var f_img = document.getElementById('f_img').value;
      var prod_cena = document.getElementById('prod_cena').value;
      var garant = document.getElementById('garant').value;
      var status = document.getElementById('status').value;
      var text = document.getElementById('text').value;
      var redactor_content = document.getElementById('redactor_content').value;
      var find_text = document.getElementById('find_text').value;
      var guid = document.getElementById('product_id').value;
      if(name && kat_id && model_id && prod_cena && garant && status && text && redactor_content && find_text) {
        var params = 'name='+name+'&kat_id='+kat_id+'&file='+f_img+'&model_id='+model_id+'&cena='+prod_cena+'&garant='+garant+'&status='+status+'&text='+text+'&full_text='+redactor_content+'&find='+find_text+'&guid='+guid;
        do_ajax('update_product',params,'','','post',0,0);
        alert('Продукт Обновлен!');
        opener.location.reload();
        self.close();
      }
      else {
        alert('Не все параметры указаны!');
      }
    }
    function select_model_id() {
      var kategoriya = document.getElementById('kat_id').value;
      var elem = document.getElementById('div_select_model');
      var params = 'kat_id=' + kategoriya;
      var url = '';
      do_ajax('draw_model_select',params,elem,'','show',0,0);
    }
  </script>
</head>
<body>
<?
if($id) {
  $productCommon = new Class_Product_Common();
  $kategoriyaCommon = new Class_Kategoriya_Common();
  $katArray = $kategoriyaCommon->Find('1=1','name');
  $modelCommon = new Class_Model_Common();
  $modelArray = $modelCommon->Find('1=1','name');
  $product = $productCommon->Read($id);
  unset($modelCommon);
  unset($kategoriyaCommon);
  unset($productCommon);
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="left" class="cart_table" style="border: 1px solid #1d5987;">
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <b>Редактирование Продукции</b>
  </th>
  <tr>
    <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td align="left" valign="middle" width="70px">
            Наименование изделия:
          </td>
          <td align="left" valign="middle">
            <input type="text" id="name" size="40px" value="<?=$product['name']?>">
            <input type="hidden" id="product_id" value="<?=$id?>">
          </td>
        </tr>
        <tr>
          <td align="left" valign="middle" width="40px">
            Категория продукции:
          </td>
          <td align="left" valign="middle">
            <select id="kat_id" onchange="select_model_id();" style="width: 270px;">
              <option value> (не выбрано) </option>
              <?
              if($katArray) {
                foreach($katArray as $kat_Id => $kat_Name) {
                  if($kat_Id == $product['kat_id']) {
                    echo'<option value="' . $kat_Id . '" selected> ' . $kat_Name . ' </option>';
                  }
                  else {
                    echo'<option value="' . $kat_Id . '"> ' . $kat_Name . ' </option>';
                  }
                }
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Модель продукции:</td>
          <td width="598">
            <select id="model_id" style="width: 270px;">
              <option value> (не выбрано) </option>
              <?
              if($modelArray) {
                foreach($modelArray as $model_Id => $model_Name) {
                  if($model_Id == $product['model_id']) {
                    echo'<option value="' . $model_Id . '" selected> ' . $model_Name . ' </option>';
                  }
                  else {
                    echo'<option value="' . $model_Id . '"> ' . $model_Name . ' </option>';
                  }
                }
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Цена изделия:</td>
          <td width="598">
            <input type="text" id="prod_cena" size="40" value="<?=$product['cena']?>">
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Гарантия:</td>
          <td width="598">
            <input type="text" id="garant" size="40" value="<?=$product['garant']?>">
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Статус:</td>
          <td width="598">
            <select id="status">
              <option>В наличии</option>
              <option>На заказ</option>
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
        <tr>
          <td width="200" height="30">Краткие характеристики:</td>
          <td width="598">
            <textarea id="text" cols="40" rows="4"><? echo($product['text']);?></textarea>
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Полное описание:</td>
          <td width="598">
            <textarea id="redactor_content" name="content" style="height: 460px;"><? echo($product['full_text']);?></textarea>
          </td>
        </tr>
        <tr>
          <td width="200" height="30">Ключевые слова:</td>
          <td width="598">
            <textarea id="find_text" cols="40" rows="4"><? echo($product['find']);?></textarea>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <th height="50px" align="left" valign="middle" style="background: #1d5987;">
    <input type="button" value="Сохранить изменения" onclick="update_product();">
  </th>
</table>
</body>
</html>