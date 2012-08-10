/////////////////////////////////////////////////////////////////////////////////////////////////
// Системные функции
/////////////////////////////////////////////////////////////////////////////////////////////////

// Открытие див окна
function openwin(name,title,file,w,h,l,t)
{
	var ajaxwin=dhtmlwindow.open(name, 'ajax', file, title, 'width='+w+'px,height='+h+'px,left='+l+'px,top='+t+'px,resize=0,scrolling=1', 'recal');
	ajaxwin.onclose=function(){
		                          setparam();
								  return window.confirm("Close this window?");
							  } 
								  
}
//Закрытие див окна
function closewin(view)
{
	var win = document.getElementById(view);
	win.close();
}
//открытие окна браузера
function new_window(url,name,t,l,w,h)
{
 window.open(url, name, "top="+t+", left="+l+", menubar=0, toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, width="+w+", height="+h);
}

/////////////////////////////////////////////////////////////////////////////////
// Дерево каталогов
/////////////////////////////////////////////////////////////////////////////////
function tree_toggle(event) {
	event = event || window.event
	var clickedElem = event.target || event.srcElement
	if (!hasClass(clickedElem, 'Expand')) {
		return // клик не там
	}
	// Node, на который кликнули
	var node = clickedElem.parentNode
	if (hasClass(node, 'ExpandLeaf')) {
		return // клик на листе
	}
	// определить новый класс для узла
	var newClass = hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
	// заменить текущий класс на newClass
	// регексп находит отдельно стоящий open|close и меняет на newClass
	var re =  /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
	node.className = node.className.replace(re, '$1'+newClass+'$3')
}

function hasClass(elem, className) {
	return new RegExp("(^|\\s)"+className+"(\\s|$)").test(elem.className)
}
//-------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////
// Основные функции
///////////////////////////////////////////////////////////////////////////////////////////

//открытие див окна ввода кол-ва
function add_to_cart(prod_id,cena,session_id)
{
	bWidth = document.body.clientWidth;
	bHeight = document.body.clientHeight;
	t = bHeight/2;
	l = bWidth/2 - 150;
	openwin('kol_prod','КОЛИЧЕСТВО ТОВАРА',	'pages/add_to_cart.php?prod_id='+prod_id+'&cena='+cena+'&session_id='+session_id,300,100,l,300);	
}

// добавление товара в корзину
function set_cart(prod_id,cena,session_id)
{
	var kolvo = parseFloat(document.getElementById('kol_pr').value);
	var sum_cart = document.getElementById('sum_cart');
	var tek_sum = parseFloat(sum_cart.value);
	var sum = kolvo * cena;
	sum_cart.value = tek_sum + sum;
	var kol_cart = document.getElementById('kol_cart');
	var tek_kol = parseFloat(kol_cart.value);
	kol_cart.value = tek_kol + kolvo;
	var params = 'prod_id='+prod_id+'&kol='+kolvo+'&summa='+sum+'&session_id='+session_id;
	do_ajax('in_cart',params,'','','post',0,0);
	var carttd = document.getElementById('carttd');
	carttd.innerHTML = '<img src="/images/cr.png" style="border:none;"/>';
	closewin('kol_prod');
}

//Добавляем товар в корзину по Enter
function set_cart_new(prod_id,cena,session_id)
{
  var elem = 'kolvo_'+prod_id;
  var kol_input = document.getElementById(elem);
	var kolvo = parseFloat(kol_input.value);
  if(kolvo > 0) {
    var sum_cart = document.getElementById('sum_cart');
    var tek_sum = parseFloat(sum_cart.value);
    var sum = kolvo * cena;
    sum_cart.value = tek_sum + sum;
    var kol_cart = document.getElementById('kol_cart');
    var tek_kol = parseFloat(kol_cart.value);
    kol_cart.value = tek_kol + kolvo;
    var params = 'prod_id='+prod_id+'&kol='+kolvo+'&summa='+sum+'&session_id='+session_id;
    do_ajax('in_cart',params,'','','post',0,0);
    var carttd = document.getElementById('carttd');
    carttd.innerHTML = '<img src="/images/cr.png" style="border:none;"/>';
    kol_input.readOnly = true;
    alert("В корзину добавлен товар !!!"); 
  }
}

function set_cart13(evt,prod_id,cena,session_id)
{
	evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode == 13)
	{
		var elem = document.getElementById('keyword').value;
		if(elem == '')
		{
			alert('Не задано количество товаров!!!');
		}
		else
		{
			set_cart_new(prod_id,cena,session_id);
		}
	}	
}

//Пересчет корзины при изменении кол-ва
function recount(cart_id,item_id)
{
	var kol_id = 'kolvo_'+item_id;
	var kol = document.getElementById(kol_id).value;
	var URL = '/controller/recountcart.php';
	var params = 'cart_id='+cart_id+'&item_id='+item_id+'&kol='+kol;
	$.ajax({url: URL,
			data: params, 	 
			dataType: "json", 
			success: function(rez) {
										var item_id = rez.item_id;
										var summa = rez.summa;
										var totalsumma = rez.totalsumma;
										var totalkol = rez.totalkol;
										var id = 'item_'+item_id;
										var input_item = document.getElementById(id);
										var input_total = document.getElementById('totalsum');
										var input_cart = document.getElementById('sum_cart');
										var input_kol = document.getElementById('kol_cart');
										input_item.value = summa; 
										input_total.value = totalsumma;
										input_cart.value = totalsumma;
										input_kol.value = totalkol;
									}
		  });
}

//Удаление элемента корзины
function del_item(item_id,user_id,session_id)
{
    var params = 'item_id='+item_id;
	do_ajax('del_item',params,'','','post',0,0);
	window.location.assign('http://kemp-production.com/cart/');
}

//Авторизация на сайте
function login_user()
{
	var login = document.getElementById('login-email-address').value;
	if (login =='')
	{
		alert('Вы не ввели электронный адрес!');
	}
	else
	{
		window.location.assign('http://kemp-production.com/main.php?page=log&login='+login);
	}
}

function  login_user13(evt1)
{
	
	evt1 = (evt1) ? evt1 : window.event
    var charCode = (evt1.which) ? evt1.which : evt1.keyCode;
	if (charCode == 13)
	{
		var login = document.getElementById('login-email-address').value;
		if (login =='')
		{
			alert('Вы не ввели электронный адрес!');
		}
		else
		{
			window.location.assign('http://kemp-production.com/main.php?page=log&login='+login);
		}
	}
}

//Регистрация на  сайте
function reg_user()
{
	window.location.assign('http://kemp-production.com/main.php?page=reg');
}

//Сохранение нового пользователя
function save_user()
{
	var reg = 1;
	var name = document.getElementById('name').value;
	var padres = document.getElementById('new_padres').value;
	var type = document.getElementById('type').value;
	var email = document.getElementById('new_email').value;
	var kpp = document.getElementById('new_kpp').value;
	var uadres = document.getElementById('new_uadres').value;
	var inn = document.getElementById('new_inn').value;
	var rschet = document.getElementById('new_rschet').value;
	var kschet = document.getElementById('new_kschet').value;
	var bik = document.getElementById('new_bik').value;
	var bank = document.getElementById('new_bank').value;
	var contact = document.getElementById('new_kontact').value;
	var phone = document.getElementById('new_phone').value;
	
	//Проверка на ввод
	if(type == 'Физическое лицо')
	{
		if(padres != '' && type != '' && email != '' && contact != '' && phone != ''){reg = 0}
	}
	if(type == 'Юридическое лицо')
	{
		var r = 1;
		var regvar = /^\d{20}$/;
		if(rschet.search(regvar) == -1)
		{
			alert(' Неверный формат рассчетного счета! Необходимо ввести 20 цифр!!!');
			r = 0;	
		}
		var regvar = /^\d{20}$/;
		if(kschet.search(regvar) == -1)
		{
			alert(' Неверный формат корреспондентского счета! Необходимо ввести 20 цифр!!!');	
			r = 0
		}
		var regvar = /^\d{9}$/;
		if(bik.search(regvar) == -1)
		{
			alert(' Неверный формат БИК! Необходимо ввести 9 цифр!!!');	
			r = 0
		}
		if(uadres != '' && inn != '' && rschet != '' && kschet != '' && bik != '' && bank != '' && r == 1 && name != '' && padres != '' && type != '' && email != '' && contact != '' && phone != ''){reg = 0;}
	}
	
	//параметры в функцию
	var params = 'email='+email+'&name='+name+'&type='+type+'&inn='+inn+'&kpp='+kpp+'&uadres='+uadres+'&padres='+padres+'&contact='+contact+'&phone='+phone+'&bank='+bank+'&rschet='+rschet+'&kschet='+kschet+'&bik='+bik;
	if(reg == 0)
	{
		window.location.assign('http://kemp-production.com/main.php?page=new&'+params);
	}
	else
	{
		alert('Не все данные введены');
	}
}

function send_zak(cart_id,user_id)
{
    alert('TYT');
	var prix = document.getElementById('prix').value;
	if(prix == 1)
	{
		var dost = document.getElementById('dostavka').value;
		var opl = document.getElementById('oplata').value;
		var adr_dost = document.getElementById('adres_dost').value;
		var adr_zd = document.getElementById('adres_st').value;
		if(adr_zd =='' && dost =='ЖД багаж')
		{
		  alert("Уточните адрес ЖД станции!!");
		}
		else
		{
			if(adr_dost =='' && dost =='Почтовая посылка')
			{
			  alert("Уточните адрес почтового отделения!");
			}	
			else
			{
			  var params = 'cart_id='+cart_id+'&user_id='+user_id+'&dost='+dost+'&opl='+opl+'&adr_dost='+adr_dost+'&adr_zd='+adr_zd;
			  window.location.assign('http://kemp-production.com/main.php?page=end&'+params);
			}
		}
	}
	else
	{
		alert('Вы не ознакомлены с формами доставки и оплаты!!');
	}
}

function find_all13(evt)
{
	evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode == 13)
	{
		var elem = document.getElementById('keyword').value;
		if(elem == '')
		{
			alert('Не заданы параметры поиска!');
		}
		else
		{
			window.location.href = "http://kemp-production.com/main.php?page=find&key="+elem;
		}
	}	
}

function find_all()
{
	var elem = document.getElementById('keyword').value;
	if(elem == '')
	{
		alert('Не заданы параметры поиска!');
	}
	else
	{
		window.location.href = "http://kemp-production.com/main.php?page=find&key="+elem;
	}
}

function chek1()
{
	var sentence = document.getElementById("new_kschet").value;
	var reg = /^\d{20}$/;
	if(sentence.search(reg) == -1)
	{alert('Необходимо ввести 20 цифр!!!');}	
}

function chek2()
{
	var sentence = document.getElementById("new_rschet").value;;
	var reg = /^\d{20}$/;
	if(sentence.search(reg) == -1)
	{alert('Необходимо ввести 20 цифр!!!');}	
}


function chek9()
{
	var sentence = document.getElementById("new_bik").value;;
	var reg = /^\d{9}$/;
	if(sentence.search(reg) == -1)
	{alert('Необходимо ввести 9 цифр!!!');}	
}

function showHide(cb, cat)
{
	cb = document.getElementById(cb);
    cat = document.getElementById(cat);
    if (cb.checked)
	{
		 cat.style.display = "block";
		 var prix = document.getElementById('prix');
		 prix.value = 1;
	}
    else cat.style.display = "none";

}

function dost()
{
	t = document.getElementById('dostavka').value;
	elem1 = document.getElementById('zd');
	elem2 = document.getElementById('dost');
	if(t == 'ЖД багаж')
	{
		elem1.style.display = "block";
	}
	else
	{
		elem1.style.display = "none";
	}
	if(t == 'Почтовая посылка')
	{
		elem2.style.display = "block";
	}
	else
	{
		elem2.style.display = "none";
	}
}

function seltype()
{
	var type = document.getElementById('type').value;
	var sel = document.getElementById('type');
	var new_kpp = document.getElementById('new_kpp');
	var new_inn = document.getElementById('new_inn');
	var new_kschet = document.getElementById('new_kschet');
	var new_uadres = document.getElementById('new_uadres');
	var new_bik = document.getElementById('new_bik');
	var name = document.getElementById('name');
	var new_bank = document.getElementById('new_bank');
	var new_rschet = document.getElementById('new_rschet');
	
	if(type == 'Физическое лицо')
	{
		new_rschet.style.display = "none";
		new_bank.style.display = "none";
		new_kpp.style.display = "none";
		name.style.display = "none";
		new_inn.style.display = "none";
		new_kschet.style.display = "none";
		new_uadres.style.display = "none";
		new_bik.style.display = "none";
	}
	else
	{
		new_rschet.style.display = "block";
		new_bank.style.display = "block";
		name.style.display = "block";
		new_kpp.style.display = "block";
		new_inn.style.display = "block";
		new_kschet.style.display = "block";
		new_uadres.style.display = "block";
		new_bik.style.display = "block";
	}
}

function editprof(type)
{
	if(type == 'Физическое лицо')
	{
		var econtact = document.getElementById('econtact');
		econtact.style['display'] = 'block';
		var enew_user = document.getElementById('enew_user');
		enew_user.style['display'] = 'block';
		var ephone = document.getElementById('ephone');
		ephone.style['display'] = 'block';
		var epadres = document.getElementById('epadres');
		epadres.style['display'] = 'block';
	}
	if(type == 'Юридическое лицо')
	{
		var econtact = document.getElementById('econtactu');
		econtact.style['display'] = 'block';
		var enew_user = document.getElementById('enew_useru');
		enew_user.style['display'] = 'block';
		var ephone = document.getElementById('ephoneu');
		ephone.style['display'] = 'block';
		var epadres = document.getElementById('epadresu');
		epadres.style['display'] = 'block';
		var ebiku = document.getElementById('ebiku');
		ebiku.style['display'] = 'block';
		var euadresu = document.getElementById('euadresu');
		euadresu.style['display'] = 'block';
		var einnu = document.getElementById('einnu');
		einnu.style['display'] = 'block';
		var ekppu = document.getElementById('ekppu');
		ekppu.style['display'] = 'block';
		var erschetu = document.getElementById('erschetu');
		erschetu.style['display'] = 'block';
		var ekschetu = document.getElementById('ekschetu');
		ekschetu.style['display'] = 'block';
		var ebanku = document.getElementById('ebanku');
		ebanku.style['display'] = 'block';
	}
}

function updateprof(l,t)
{
		if(t == 'Физическое лицо')
	{
		var econtact = document.getElementById('econtact').value;
		var enew_user = document.getElementById('enew_user').value;
		var ephone = document.getElementById('ephone').value;
		var epadres = document.getElementById('epadres').value;
	}
	if(t == 'Юридическое лицо')
	{
		var econtact = document.getElementById('econtactu').value;
		var enew_user = document.getElementById('enew_useru').value;
		var ephone = document.getElementById('ephoneu').value;
		var epadres = document.getElementById('epadresu').value;
		var ebiku = document.getElementById('ebiku').value;
		var euadresu = document.getElementById('euadresu').value;
		var einnu = document.getElementById('einnu').value;
		var ekppu = document.getElementById('ekppu').value;
		var erschetu = document.getElementById('erschetu').value;
		var ekschetu = document.getElementById('ekschetu').value;
		var ebanku = document.getElementById('ebanku').value;
	}
	var params = 'contact='+econtact+'&new_user='+enew_user+'&phone='+ephone+'&padres='+epadres+'&bik='+ebiku+'&uadres='+euadresu+'&inn='+einnu+'&kpp='+ekppu+'&rschet='+erschetu+'&kschet='+ekschetu+'&bank='+ebanku+'&login='+l;
	do_ajax('update_user',params,'','','post',0,0);
	window.location.href = "http://kemp-production.com/main.php?page=log&login="+l;
}