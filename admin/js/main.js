////////////////////////////////////////////////////////////////////////////////////////////////////////
//Админская часть функции интерфейса
////////////////////////////////////////////////////////////////////////////////////////////////////////
//открытие окна див
function openwin(name,title,file,w,h,l,t)
{
	var ajaxwin=dhtmlwindow.open(name, 'ajax', file, title, 'width='+w+'px,height='+h+'px,left='+l+'px,top='+t+'px,resize=0,scrolling=1', 'recal');
	ajaxwin.onclose=function(){
		                          setparam();
								  return window.confirm("Close this window?");
							  } 
}
//закрытие окна див
function closewin(view)
{
	var win = document.getElementById(view);
	win.close();
}
//открытие окна браузера
function new_window(url,name,t,l,w,h)
{
 window.open(url, name, "top="+t+", left="+l+", menubar=no, toolbar=no, location=no, directories=no, status=0, scrollbars=yes, resizable=yes, width="+w+", height="+h);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////
// Функции работы с данными
////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////
// Работа с категориями товаров
////////////////////////////////////////////////////////////////////////////////////////////////////////

//Открытие окна добавления новой категории товара
function adm_addkat()
{
	var url = 'add_kat.php';
	var name = 'add_kat';
	new_window(url,name,100,200,500,200);
}
//Сохранение новой категории
function save_kat()
{
	var kat = document.getElementById('kat_name').value;
	var params = 'kat_name='+kat;
	do_ajax('save_kat',params,'','','post',0,0);
	alert('Категория продукции добавлена!');
}
//Вывод списка существующих категорий
function edit_kat()
{
	var inelem = document.getElementById('admin_main');
    document.getElementById('admin_main').style['display'] = 'block';
    document.getElementById('help').style['display'] = 'none';
	do_ajax('edit_kat','',inelem,'','show',0,0);
}
//Открытие окна для редактирования категории
function open_kat(id)
{
	var url = 'open_kat.php?kat_id='+id;
	var name = 'open_kat';
	new_window(url,name,100,200,500,200);
}
//Сохранение изменений в категории
function update_kat(id)
{
	var new_name = document.getElementById('new_kat').value;
	var params = 'kat_id='+id+'&new_name='+new_name;
	do_ajax('update_kat',params,'','','post',0,0);
	var inelem = opener.document.getElementById('admin_main');
	do_ajax('edit_kat','',inelem,'','show',0,0);
	window.close();
}
//Удаление категории
function del_kat(id)
{
	var params = 'kat_id='+id;
	do_ajax('del_kat',params,'','','post',0,0);
	var inelem = document.getElementById('admin_main');
	do_ajax('edit_kat','',inelem,'','show',0,0);
    alert('Категория удалена !!!');
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
// Работа с моделями товаров
////////////////////////////////////////////////////////////////////////////////////////////////////////

//Добавление новой модели
function adm_addmod()
{
	var url = 'add_mod.php';
	var name = 'add_mod';
	new_window(url,name,100,200,500,270);
}
//Сохранение новой модели
function save_model()
{
	var mod = document.getElementById('mod_name').value;
	var kat_id = document.getElementById('kat_id').value;
	var img = document.getElementById('f_img').value;
	var params = 'name='+mod+'&kat_id='+kat_id+'&img='+img;
	do_ajax('save_mod',params,'','','post',0,0);
	alert('Модель продукции добавлена!');
}
//Вывод списка моделей
function edit_mod()
{
	var inelem = document.getElementById('admin_main');
    document.getElementById('admin_main').style['display'] = 'block';
    document.getElementById('help').style['display'] = 'none';
	do_ajax('edit_model','',inelem,'','show',0,0);
}
function show_edit_mod()
{
	var kat_id = document.getElementById('kat_id').value;
	var inelem = document.getElementById('edit_model_view');
	var params = 'kat_id='+kat_id;
	do_ajax('show_edit_mod',params,inelem,'','show',0,0);
}
//Удаление модели
function del_mod(id)
{
	var params = 'mod_id='+id;
	do_ajax('del_mod',params,'','','post',0,0);
	show_edit_mod();
    alert('Модель удалена!!!');
}
//Открытие окня для редактирования модели
function open_mod(id)
{
	var url = 'open_mod.php?model_id='+id;
	var name = 'open_mod';
	new_window(url,name,100,200,500,270);
}
//Сохранение изменений в моделе
function update_mod(id)
{
	var new_mod = document.getElementById('new_mod').value;
	var new_img = document.getElementById('mod_img').value;
	var params = 'mod_id='+id+'&new_mod='+new_mod+'&new_img='+new_img;
	do_ajax('update_mod',params,'','','post',0,0);
	kat_id = opener.document.getElementById('kat_id').value;
	var inelem = opener.document.getElementById('edit_model_view');
	var params = 'kat_id='+kat_id;
	do_ajax('show_edit_mod',params,inelem,'','show',0,0);
	window.close();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
// Работа с товарами
////////////////////////////////////////////////////////////////////////////////////////////////////////

//Добавление продукции
function adm_addprod()
{
	var url = 'add_prod.php';
	var name = 'add_prod';
	new_window(url,name,100,200,800,600);
}

//Сохранение продукции
function save_prod()
{
	var name = document.getElementById('prod_name').value;
	var kat_id = document.getElementById('kat_id').value;
	var model_id = document.getElementById('model_id').value;
	var cena = document.getElementById('prod_cena').value;
	var garant = document.getElementById('garant').value;
	var status = document.getElementById('status').value;
	var text = document.getElementById('text').value;
	var f_img = document.getElementById('f_img').value;
	var full_text = document.getElementById('editor').value;
	var find_text = document.getElementById('find_text').value;
	if(kat_id > 0 && model_id > 0)
	{
        kat_id = 0;
	}
    if(kat_id == 0 && model_id == 0)
	{
      alert('Выберите категорию или модель');
    }

	var params = 'name='+name+'&model_id='+model_id+'&kat_id='+kat_id+'&cena='+cena+'&garant='+garant+'&status='+status+'&text='+text+'&full_text='+full_text+'&find_text='+find_text+'&f_img='+f_img;
	do_ajax('save_prod',params,'','','post',0,0);
	alert('Изделие добавлено!');

}

//Открытие списка для редактирования
function edit_prod()
{
	var inelem = document.getElementById('admin_main');
    document.getElementById('admin_main').style['display'] = 'block';
    document.getElementById('help').style['display'] = 'none';
	do_ajax('edit_prod','',inelem,'','show',0,0);
}
function show_edit_prod()
{
	var kat_id = document.getElementById('kat_id').value;
    var model_id = document.getElementById('model_id').value;
	var inelem = document.getElementById('edit_model_view');
    var params = '';
    if(kat_id == 0 && model_id == 0) {
        alert('Выберите модель либо категорию товара!!!');
    }
   if(kat_id > 0 && model_id == 0) {
        params = 'kat_id='+kat_id;
    }
    if(model_id > 0 && kat_id > 0) {
        params = 'model_id='+model_id;
    }
	do_ajax('show_edit_prod',params,inelem,'','show',0,0);
}

//открытие окна товара для редактирования
function open_prod(id)
{
	var url = 'open_prod.php?prod_id='+id;
	var name = 'open_prod';
	new_window(url,name,100,200,800,600);
}

//Сохранение изменений в товаре
function update_prod(id)
{
	var name = document.getElementById('name').value;
	var filename = document.getElementById('filename').value;
	var cena = document.getElementById('cena').value;
	var garant = document.getElementById('garant').value;
	var text = document.getElementById('text').value;
	var full_text = document.getElementById('editor').value;
	var find_text = document.getElementById('find_text').value;
	var status = document.getElementById('status').value;
	var params = 'prod_id='+id+'&name='+name+'&filename='+filename+'&cena='+cena+'&garant='+garant+'&text='+text+'&status='+status+'&full_text='+full_text+'&find_text='+find_text;
	do_ajax('update_prod',params,'','','post',0,0);
	var inelem = opener.document.getElementById('edit_model_view');
	var params = 'prod_id='+id;
	do_ajax('show_edit_prod',params,inelem,'','show',0,0);
	window.close();
}

//Удаление товара
function del_prod(id)
{
	var params = 'prod_id='+id;
	do_ajax('del_prod',params,'','','post',0,0);
	show_edit_prod();
    alert('Товар удален !!!');
}

//////////////////////////////////////////////////////////////////////////////////////////
// Функции для работы со страницами
//////////////////////////////////////////////////////////////////////////////////////////
function save_page()
{
	var page_name = document.getElementById('page_name').value;
	if(page_name == '')
	{
		alert('Не определено название страницы!!!');
	}
	else
	{
		var content = document.getElementById('editor').value;
		var params = 'page_name='+page_name+'&content='+content;
		do_ajax('save_page',params,'','','post',0,0);
	}
}

function help()
{
    document.getElementById('admin_main').style['display'] = 'none';
    document.getElementById('help').style['display'] = 'block';
}

//Отрисовка селекта моделей по выбранной категории
function select_model_id() {
  var kategoriya = document.getElementById('kat_id').value;
  var elem = document.getElementById('div_select_model');
  var params = 'kat_id=' + kategoriya;
  var url = '';
  do_ajax('draw_model_select',params,elem,'','show',0,0);
}