<?
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:1="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ОАО Ковровский Электро Механический завод</title>
<!-- Стили основного меню //////////////////////////////////////////// -->
<link href="../css/style.css" media="screen" rel="stylesheet" type="text/css"/>
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->
<!-- / END /////////////////////////////////////////////////////////// -->

<script language="javascript" type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="js/main.js"></script>
<script src="js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/upload/swfobject.js"></script>
<script type="text/javascript" src="js/upload/jquery.uploadify.v2.1.4.min.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">

</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" height="50px">
      <div id="container" >
        <!-- BEGIN Menu -->
        <ul id="nav">
          <?
            $menuCommon = new Class_Menu_Common();
            $menuCommon->drawMenu(0,$user_role);
            unset($menuCommon);
          ?>
        </ul>
        <!-- END Menu -->
      </div>
    </td>
    <td align="right" width="100px;" height="50px" style="color: #fff;">
      <?
        echo $user_name;
      ?>
    </td>
  </tr>
</table>
  <!-- Load the Mootools Framework -->
  <script src="http://www.google.com/jsapi"></script><script>google.load("mootools", "1.2.1");</script>
  <!-- Load the MenuMatic Class -->
  <script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
  <!-- Create a MenuMatic Instance -->
  <script type="text/javascript" >
    window.addEvent('domready', function() {
      var myMenu = new MenuMatic();
    });
  </script>
<iframe name="mainFraim"  style="height: 100%; width: 100%; position: absolute; top: 51px; left: 0px; border: #7f9bac solid 1px; background:#00395a;"></iframe>
</body>
</html>
