<?
//Подключаем нужные библиотеки
include_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
session_start(); //инициализирум механизм сесссий
$session_id = session_id();
//Сохраняем сессию в таблице
$s1 = "select count(*) as ses from sessions where session_id ='" . $session_id . "'";
$q = mysql_query($s1);
while ($r = mysql_fetch_assoc($q)) {
  $ses = $r['ses'];
}
if ($ses <= 0) {
  $sql = "INSERT INTO sessions(session_id,user_id) VALUES('" . $session_id . "','" . $session_id . "')";
  mysql_query($sql);
}
//Кол-во записей на странице
$nums = 10;

//Проверяем наличие товаров в корзине
$ss = "select * from sessions where session_id = '" . $session_id . "'";
$qq = mysql_query($ss);
while ($rr = mysql_fetch_assoc($qq)) {
  $user_id = $rr['user_id'];
}
//ищем корзину
$qqq = mysql_query("select count(*) as kol from cart where user_id = '" . $user_id . "' and status = 0");
while ($rrr = mysql_fetch_assoc($qqq)) {
  $kl = $rrr['kol'];
}
if ($kl > 0) {
  $qq = mysql_query("select * from cart where user_id = '" . $user_id . "' and status = 0");
  while ($rr = mysql_fetch_assoc($qq)) {
    $cart_id = $rr['id'];
  }
  //считаем товары и сумму
  $qq = mysql_query("select count(*) as kkk from cart_item  where cart_id = " . $cart_id);
  while ($rr = mysql_fetch_assoc($qq)) {
    $kkk = $rr['kkk'];
  }
  if ($kkk > 0) {
    $qq = mysql_query("select sum(kol) as kol, sum(summa) as summ from cart_item where cart_id = " . $cart_id);
    while ($rr = mysql_fetch_assoc($qq)) {
      $kol_cart = $rr['kol'];
      $sum_cart = $rr['summ'];
    }
  } else {
    $kol_cart = 0;
    $sum_cart = 0;
  }
} else {
  $kol_cart = 0;
  $sum_cart = 0;
}
$ko = $_GET['ko'];
$mo = $_GET['mo'];
$m = $_GET['m'];
$katalog = $_GET['katalog'] ? $_GET['katalog'] : false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="description" content="Производство гидравлического оборудования мини-погрузчиков робототехники"/>
      <meta name="keywords" content="БРС, быстроразъемные соединения, гидравлика, гидрораспределитель, МКСМ, ротатор, электромагнит, гидромотор, гидрозамок, гидронасос, погрузчик, мини-погрузчик, минипогрузчик, погрузчик, мини-погрузчик Ant, минипогрузчик Ant, погрузчик Ant, Ant, мини-погрузчик Ант, минипогрузчик  Ант, погрузчик Ант, Ант"/>
    <title>Гидравлическая продукция: мини-погрузчики, робототехника, гидрораспеределители</title>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/tree/katalog.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/ajax.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/katalog.js"></script>
    <style type="text/css">
      a:link {
        color: #FFF;
      }
      a:visited {
        color: #FFF;
      }
      a:active {
        color: #FFF;
      }
    </style>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
   </head>

   <body>
    <div class="top"></div>
    <div id="menu">
      <ul>
         <li><a href="/index.php"><span>ГЛАВНАЯ</span></a></li>
            <?
            if ($m == 2) {
              echo'<li><a href="/page/s/2/2/'.$katalog.'/" class="current"><span>ЗАКАЗ</span></a></li>';
            } else {
              echo'<li><a href="/page/s/2/2/'.$katalog.'/"><span>ЗАКАЗ</span></a></li>';
            }
            if ($m == 3) {
              echo'<li><a href="/page/s/3/3/'.$katalog.'/" class="current"><span>ОПЛАТА</span></a></li>';
            } else {
              echo'<li><a href="/page/s/3/3/'.$katalog.'/"><span>ОПЛАТА</span></a></li>';
            }
            if ($m == 4) {
              echo'<li><a href="/page/s/4/4/'.$katalog.'/" class="current"><span>ДОСТАВКА</span></a></li>';
            } else {
              echo'<li><a href="/page/s/4/4/'.$katalog.'/"><span>ДОСТАВКА</span></a></li>';
            }
            if ($m == 5) {
              echo'<li><a href="/page/s/9/5/'.$katalog.'/" class="current"><span>СЕРВИС</span></a></li>	';
            } else {
              echo'<li><a href="/page/s/9/5/'.$katalog.'/"><span>СЕРВИС</span></a></li>	';
            }
            if ($m == 6) {
              echo'<li><a href="/page/s/10/6/'.$katalog.'/" class="current"><span>КОНТАКТЫ</span></a></li>';
            } else {
              echo'<li><a href="/page/s/10/6/'.$katalog.'/"><span>КОНТАКТЫ</span></a></li>';
            }
            if ($m == 7) {
              echo'<li><a href="/pagef/f/7/'.$katalog.'/" class="current"><span>ОФОРМИТЬ ЗАКАЗ</span></a></li>';
            } else {
              echo'<li><a href="/pagef/f/7/'.$katalog.'/"><span>ОФОРМИТЬ ЗАКАЗ</span></a></li>';
            }
            ?>
       </ul>
     </div>
     <div id="top_menu">
        <div class="search">
           <table>
              <tbody>
                  <tr>
                    <td class="header_search_hd">ПОИСК</td>
                    <td><input type="text" value="Наименование" id="keyword" class="inp" onkeypress="javascript: return find_all13(event);" size="60"></td>
                    <td class="subm"><input type="image" src="/images/sb.png" onclick="javascript: find_all();" alt="Найти"></td>
                  </tr>
              </tbody>
           </table>
        </div>
        <div class="cart">
           <table width="90%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
               <tr>
                  <td width="20%" align="center" valign="middle">
                    <a href="/cart/<?=$katalog?>/">
                      <span id="carttd">
                      <?
                      if ($sum_cart > 0) {
                        echo'<img src="/images/cr.png" style="border:none;"/>';
                      } else {
                        echo'<img src="/images/cb.png" style="border:none;"/>';
                      }
                      ?>
                      </span>
                    </a>
                  </td>
                  <td width="80%" align="left" valign="middle">
                    ЗАКАЗ НА СУММУ: <input type="text" id="sum_cart" value="<? echo($sum_cart); ?>" size="20" readonly=true/>
                    <input type="hidden" id="kol_cart" value="<? echo($kol_cart); ?>" size="5" readonly=true/>
                  </td>
               </tr>
            </table>
        </div>
        </div>
          <div style="clear:both"></div>
          <!-- Основная часть страницы  -->       
          <div id="content">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="contentMain">
              <tbody>
                <tr>
                  <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                  <td align="left" valign="top" class="cboxPhoto" id="column_left" style="width:230px;">
                    <div id="shopmenu">
                      <div class="name"><b>КАТАЛОГ ТОВАРОВ</b></div>
                        <script language="JavaScript">

                            $(document).ready(function() {
                                $(".topnav").accordion({
                                    accordion:false,
                                    speed: 500
                                });
                            });

                        </script>

                        <ul class="topnav">
                            <?
                            //Составляем дерево каталога по базе
                            include $_SERVER['DOCUMENT_ROOT']."/pages/tree.php";
                            ?>
                        </ul>
                    </div>
                    <!-- End Tree-->
                  </td>
                  <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                  <!-- Правая часть - основная рабочая зона -->                
                  <td valign="top" align="left">
                      <?
                      if ($_REQUEST['page']) {
                        $page = $_REQUEST['page'];
                      } else {
                        $page = 's';
                      }
                      ?>
                      <div id="main">
                      <?
                      ///////////////////////////////////////////////////////////////////////////////////					
                      // Показываем страницы сайта
                      //////////////////////////////////////////////////////////////////////////////////
                      if ($page == 's') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/sitePage.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////							
                      // Показываем корзину
                      ///////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'cart') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/cartPage.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////////////////////////////							
                      // Показываем страницу оформления заказа - запрос пароля
                      ///////////////////////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'f') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/getPassword.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////////////////////////////							
                      // Регистрация нового пользователя
                      ///////////////////////////////////////////////////////////////////////////////////////////////////////////							
                      if ($page == 'reg') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/newUserPage.php";
                      }
                      //////////////////////////////////////////////////////////////////////////////////////////////////////
                      //////////////////////////////////////////////////////////////////////////////////////////////////////
                      // Выводим страницы - список моделей
                      //////////////////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'm') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/modelListPage.php";
                      }
                      /////////////////////////////////////////////////////////////////////////////////////////////////////////							
                      // Вывордим страницы - список продуктов
                      /////////////////////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'k') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/goodListPage.php";
                      }
                      /////////////////////////////////////////////////////////////////////////////////////////////////////////							
                      // Вывордим страницы - список продуктов 2
                      /////////////////////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'kp') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/goodListPage2.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////////////							
                      // Выводим информацию о продукте
                      ///////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'p') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/goodsPage.php";
                      }
                      //////////////////////////////////////////////////////////////////////////////////////							
                      // Авторизация
                      //////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'log') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/authPage.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////////////							
                      // Регистрация нового пользователя
                      ///////////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'new') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/createUserPage.php";
                      }
                      //////////////////////////////////////////////////////////////////////////////////////
                      // Отправяка заказа на почту 
                      //////////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'end') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/sendPage.php";
                      }
                      ///////////////////////////////////////////////////////////////////////////////////					
                      // Показываем результаты поиска
                      //////////////////////////////////////////////////////////////////////////////////
                      if ($page == 'find') {
                        include $_SERVER['DOCUMENT_ROOT']."/pages/findPage.php";
                      }
                      ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Конец основной части --> 

          <div class="clear"></div>
          <!-- Конец основной части -->  
          <!-- Футер -->    
          <div id="footer">
            <div class="fright">
              Copyright © 2011 ОАО КЭМЗ
            </div>
            <div class="menu">
              <a href="/index.php">ГЛАВНАЯ |</a>
              <a href="/page/s/2/2/<?=$katalog?>/">ЗАКАЗ |</a>
              <a href="/page/s/3/3/<?=$katalog?>/">ОПЛАТА |</a>
              <a href="/page/s/4/4/<?=$katalog?>/">ДОСТАВКА |</a>
              <a href="/page/s/9/5/<?=$katalog?>/">СЕРВИС |</a>
              <a href="/page/s/10/6/<?=$katalog?>/">КОНТАКТЫ |</a>
              <a href="/pagef/f/7/<?=$katalog?>/">ОФОРМИТЬ ЗАКАЗ</a>
            </div>
          </div>
          <!-- Конец футера --> 
        </body>
        </html>
