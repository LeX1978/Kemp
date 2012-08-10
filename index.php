<?php
  echo phpinfo();
	//Подключаем нужные библиотеки
	include_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
	session_start(); 
	//инициализирум механизм сесссий
	$session_id = session_id();
	//Сохраняем сессию в таблице
	$s1 = "select count(*) as ses from sessions where session_id ='".$session_id."'";
	$q = mysql_query($s1);
	while($r = mysql_fetch_assoc($q)) {
		$ses = $r['ses'];
	}
	if($ses <= 0) {
		$sql="INSERT INTO sessions(session_id,user_id) VALUES('".$session_id."','".$session_id."')";
		mysql_query($sql);
	}
	//Кол-во записей на странице
	$nums = 10;
	
	//Проверяем наличие товаров в корзине
	$ss = "select * from sessions where session_id = '".$session_id."'";
	$qq = mysql_query($ss);
	while($rr = mysql_fetch_assoc($qq)) {
		$user_id = $rr['user_id'];
	}
	//ищем корзину
	$qqq = mysql_query("select count(*) as kol from cart where user_id = '".$user_id."' and status = 0");
	while($rrr = mysql_fetch_assoc($qqq)) {
		$kl = $rrr['kol'];
	}
	if($kl > 0) {
		$qq = mysql_query("select * from cart where user_id = '".$user_id."' and status = 0");
		while($rr = mysql_fetch_assoc($qq)) {
			$cart_id = $rr['id'];
		}
		//считаем товары и сумму
		$qq = mysql_query("select count(*) as kkk from cart_item  where cart_id = ".$cart_id);
		while($rr = mysql_fetch_assoc($qq)) {
			$kkk = $rr['kkk'];
		}
		if($kkk > 0) {
			$qq = mysql_query("select sum(kol) as kol, sum(summa) as summ from cart_item where cart_id = ".$cart_id);
			while($rr = mysql_fetch_assoc($qq)) {
				$sum_cart = $rr['summ'];
			}
		}
		else {
			$sum_cart = 0;
		}
	}
	else {
		$sum_cart = 0;
	}
	$ko = $_GET['ko'];
	$mo = $_GET['mo'];
    $katalog = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Производство гидравлического оборудования мини-погрузчиков робототехники"/>
<meta name="keywords" content="БРС, быстроразъемные соединения, гидравлика, гидрораспределитель, МКСМ, ротатор, электромагнит, гидромотор, гидрозамок, гидронасос, погрузчик, мини-погрузчик, минипогрузчик, погрузчик, мини-погрузчик Ant, минипогрузчик Ant, погрузчик Ant, Ant, мини-погрузчик Ант, минипогрузчик  Ант, погрузчик Ант, Ант"/>
<title>Гидравлическая продукция: мини-погрузчики, робототехника, гидрораспеределители</title>
 <link rel="stylesheet" href="/css/feature-carousel.css" charset="utf-8" />
 <link rel="stylesheet" href="/css/style.css" charset="utf-8" />
    <script src="/js/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.featureCarousel.min.js" type="text/javascript" charset="utf-8"></script>
    <script language="javascript" type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var carousel = $("#carousel").featureCarousel({
        });
      });
    </script>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">     
</head>

<body>
<div class="top"></div>
<div id="menu">
	<ul>
    	<li><a href="/index.php" class="current"><span>ГЛАВНАЯ</span></a></li>
        <li><a href="/page/s/2/2/<? echo $katalog; ?>/"><span>ЗАКАЗ</span></a></li>
        <li><a href="/page/s/3/3/<? echo $katalog; ?>/"><span>ОПЛАТА</span></a></li>
        <li><a href="/page/s/4/4/<? echo $katalog; ?>/"><span>ДОСТАВКА</span></a></li>
        <li><a href="/page/s/9/5/<? echo $katalog; ?>/"><span>СЕРВИС</span></a></li>
        <li><a href="/page/s/10/6/<? echo $katalog; ?>/"><span>КОНТАКТЫ</span></a></li>
        <li><a href="/pagef/f/7/<? echo $katalog; ?>/"><span>ОФОРМИТЬ ЗАКАЗ</span></a></li>
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
                	<td width="17%" align="center" valign="middle">
                    	<a href="/cart/<? echo($katalog);?>/">
                        	<?
							if($sum_cart >0)
							{
                    			echo'<img src="/images/cr.png" style="border:none;"/>';
							}
							else
							{
                    			echo'<img src="/images/cb.png" style="border:none;"/>';
							}
							?>
                        </a>
                    </td>
                   <td width="83%" align="left" valign="middle">
                    	ЗАКАЗ НА СУММУ: <input type="text" id="sum_cart" value="<? echo($sum_cart);?>" size="20" readonly=true/>
                        <input type="hidden" id="kol_cart" value="<? echo($kol_cart);?>" size="5" readonly=true/>
           		  </td>
                </tr>
            </table>
  </div>
</div>
<div class="carousel-container">
      <div id="carousel">
        <div class="carousel-feature">
          <a href="/ant/"><img class="carousel-image" alt="Image Caption" src="/images/sample1.png"></a>
        </div>
        <div class="carousel-feature">
          <a href="/gidravlika/"><img class="carousel-image" alt="Image Caption" src="/images/sample2.png"></a>
        </div>
        <div class="carousel-feature">
          <a href="http://www.kemz.org/Robot_TM3.html"  target="_blank"><img class="carousel-image" alt="Image Caption" src="/images/sample3.png"></a>
        </div>
        <div class="carousel-feature">
          <a href="/train/"><img class="carousel-image" alt="Image Caption" src="/images/sample4.png"></a>
        </div>
      </div>
      <div id="carousel-left"><img src="/images/arrow-left.png" /></div>
      <div id="carousel-right"><img src="/images/arrow-right.png" /></div>
</div>
<div style="clear:both"></div>

<div id="about">
	<div id="title" >
    	О ПРЕДПРИЯТИИ
    </div>
    <div id="mcontent">
    	<div id="mtext" align="justify">
            ОАО «Ковровский электромеханический завод», основанный в 1898 году, в настоящее время представляет собой современное, динамично развивающееся предприятие. Основная специализация - гидроаппаратура.<br>
КЭМЗ является единственным производителем систем стабилизации и наведения вооружения всех типов танков и БМП российского производства, а также лидером в производстве электрогидравлических приводов для управления комплексами различного назначения.<br><br>
КЭМЗ с успехом разрабатывает и изготавливает комплексные электрогидравлические системы управления различной мобильной и стационарной техникой. Производит широкую номенклатуру гидроаппаратуры.<br><br>
Успех продукции КЭМЗ связан с тем, что один из главных приоритетов завода – это качество выпускаемой продукции. На качество работает высочайший научно-технический потенциал предприятия, самое современное оборудование мировых производителей на всей технологической цепочке.<br><br>
Постановлением Правительства РФ от 24 ноября 1999 года №1291 ОАО "КЭМЗ" стал лауреатом премии в области качества. Система обеспечения качества завода сертифицирована по ISO 9001-2001. На всю гидравлику устанавливается гарантийный срок службы.<br><br>

БОЛЕЕ ПОДРОБНАЯ ИНФОРМАЦИЯ НА ОФИЦИАЛЬНОМ САЙТЕ ОАО «КЭМЗ»: <a href="http://www.kemz.org" target="_blank" style="color:#FFF;">WWW.KEMZ.ORG</a>, <a href="http://КЭМЗ.РФ" style="color:#FFF;" target="_blank">КЭМЗ.РФ</a>
        </div>
    </div>
</div>

<div style="clear:both"></div>
<div id="blok" align="justify">
  <table width="1024" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="691" height="42" valign="bottom" style="font-weight:bolder;	font-size: 17px;">
        	НОВОСТИ
        </td>
        <td width="31" height="42">&nbsp;</td>
        <td width="302" height="42" valign="bottom" style="font-weight:bolder; font-size: 17px;">НАШИ ПАРТНЕРЫ</td>
      </tr>
      <tr>
        <td align="justify" valign="top" style="background:#809cad;">
        <div style="width:100%; height:90%; overflow:auto; position:relative; height: 450px; margin:10px auto;">
         <div id="mcontento">	
        	<p><b>Январь 2012 г.</b></p>
            <ul>
              <li>В 2012 году план на  серийное производство будут поставлены новые виды продукции, в том числе коммунальные машины «Ant-750» и «Ant-950», станки с ПУ.</li>
              <li>С нового года на КЭМЗ начат выпуск корпусной мебели. Материалы используются австрийской фирмы Эггер. Сейчас выпускают комплект из 5 предметов – шкаф для одежды, стеллаж  для  документов, письменный стол, компьютерный стол, выдвижная тумбочка. Но изменение номенклатуры возможно  по желанию заказчика. Пока предприятие работает на себя, на обеспечение подразделений завода новой мебелью. Но готовы принимать и сторонние заказы.</li>
            </ul>
            <p><b>Декабрь 2011 г.</b></p>
            <ul>
            	<li>Выпущена первая партия мини-погрузчиков «Ant-650». </li>
                <li>В 2011 году рост объёмов продаж продукции увеличился к 2010 году на 30%, средняя зарплата работающих выросла на 17%. </li>
                <li>Наше предприятие с успехом выставляло свою продукцию на 10 международных и российских специализированных выставках.</li>
            </ul>
            <p><b>Ноябрь 2011 г.</b></p>
            <ul>
            	<li>За достигнутые успехи в производственно-хозяйственной деятельности ОАО «КЭМЗ» занесено на областную Галерею Славы. Признано победителем областного конкурса «Лучшие предприятия Владимирской области 2011 года», объявленного губернатором, в номинации «За создание новых рабочих мест».</li>
            </ul>
            <br>
           </div> 
           </div>
        </td>
        <td width="31">&nbsp;</td>
        <td align="center" valign="top" style="background:#809cad;">
        		<a href="http://sms7.ru" target="_blank">
        		<img src="/images/p1.png" style="border:none;"/>
                </a>
            <br>
            <br>
            	<a href="http://irmash.com" target="_blank">
            	<img src="/images/p2.png" style="border:none;"/>
                </a>
            <br>
            <br>
            	<a href="http://kmz.ru" target="_blank">
            	<img src="/images/p3.png" style="border:none;"/>
                </a>
            <br>
            <br>
            	<a href="http://ks45.ru" target="_blank">
            	 <img src="/images/p4.png" style="border:none;"/>       
              </a>
            <br>
            <br>

              <!-- Yandex.Metrika informer -->
				<a href="http://metrika.yandex.ru/stat/?id=13972012&amp;from=informer"
				target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/13972012/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
				style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:13972012,type:0,lang:'ru'});return false}catch(e){}"/></a>
				<!-- /Yandex.Metrika informer -->
				
				<!-- Yandex.Metrika counter -->
				<script type="text/javascript">
				(function (d, w, c) {
					(w[c] = w[c] || []).push(function() {
						try {
							w.yaCounter13972012 = new Ya.Metrika({id:13972012, enableAll: true});
						} catch(e) {}
					});
					
					var n = d.getElementsByTagName("script")[0],
						s = d.createElement("script"),
						f = function () { n.parentNode.insertBefore(s, n); };
					s.type = "text/javascript";
					s.async = true;
					s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
				
					if (w.opera == "[object Opera]") {
						d.addEventListener("DOMContentLoaded", f);
					} else { f(); }
				})(document, window, "yandex_metrika_callbacks");
				</script>
				<noscript><div><img src="//mc.yandex.ru/watch/13972012" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			<!-- /Yandex.Metrika counter -->
			<br>
			<!--LiveInternet counter--><script type="text/javascript"><!--
			document.write("<a href='http://www.liveinternet.ru/click' "+
			"target=_blank><img src='//counter.yadro.ru/hit?t54.6;r"+
			escape(document.referrer)+((typeof(screen)=="undefined")?"":
			";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
			screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
			";"+Math.random()+
			"' alt='' title='LiveInternet: показано число просмотров и"+
			" посетителей за 24 часа' "+
			"border='0' width='88' height='31'><\/a>")
			//--></script><!--/LiveInternet-->
			<br>
			<!-- Рейтинг РОССИИ -->
				<script language="javascript">
				java="1.0";
				java1=""+"&refer="+escape(document.referrer)+"&page="+
				escape(window.location.href);
				document.cookie="astratop=1; path=/"; java1+="&c="+(document.cookie?"yes":"now");
				</script>
				<script language="javascript1.1">java="1.1";java1+="&java="+(navigator.javaEnabled()?"yes":"now")</script>
				<script language="javascript1.2">java="1.2";
				java1+="&razresh="+screen.width+'x'+screen.height+"&cvet="+
				(((navigator.appName.substring(0,3)=="Mic"))?
				screen.colorDepth:screen.pixelDepth)</script><script language="javascript1.3">java="1.3"</script>
				<script language="javascript">java1+="&jscript="+java+"&rand="+Math.random();
				document.write("<a href='http://top.rossia.su/in.php?id=32362' target='_blank'><img "+
				" src='http://top.rossia.su/img.php?id=32362&"+java1+"&' border=0  width=88 height=31 alt='Рейтинг РОССИИ'></a>")</script>
				<noscript><a href=http://top.rossia.su/in.php?id=32362 target=_blank><img src="http://top.rossia.su/img.php?id=32362" border=0 width=88 height=31 alt="Рейтинг РОССИИ"></a></noscript>
			<!-- /Рейтинг РОССИИ -->
        </td>
      </tr>
    </table>

</div>
<div style="clear:both"></div>
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