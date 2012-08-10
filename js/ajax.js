function do_ajax(controller,
                 params,
				 element,
				 page,
				 type,
				 width,
				 height)
{
	var URL = '/controller/'+controller+'.php';
	var PAGE = '/views/'+page+'.php';
	var dest = element;
	switch(type)
	{
		case 'show':  var html = $.ajax({url: URL, data: params, async: false}).responseText;
 					  dest.innerHTML = html;					
					  break;	
		case 'post':  $.ajax({type: "POST", url: URL, data: params, async: false });
					  break;
		case 'form': $.ajax({url: URL,
							  data: params,
					  		  dataType: "json", 
							  success: function(rez) {
						  								var pr = rez.result;
														PAGE = PAGE+'?'+pr;
														showModalDialog(PAGE, '', 'dialogWidth='+width+'px; dialogHeight='+height+'px;'); 
													  }
			                });
					  break;
		case 'alert': $.ajax({url: URL,
							  data: params, 	 
					  		  dataType: "json", 
							  success: function(rez) {
						  								var pr = rez.result;
														alert(pr);
													  }
			                });	
					  break;
	}
}