//Текущая вкладка
var current_tab='all';
//Цвет активной вкладки
var active_tab_color='white';
//Цвет неактивных вкладок
var non_active_tab_color='#BCD7F7';
//Изначальное количество вкладок
var tab_num=1;
//Высота дива над листом контактов
var header_h=0;
//Количество дивов спейсеров)))) Между рядами вкладок
var tab_spa_num=0;

//Получаем высоту дива над листом контактов
$(document).ready(function(){
	var head_height=$("#online_list_header").height();
	header_h=head_height;
});

//Функция загрузки сообщений
function load_messes()
{
	//Получаем из поля hidden user текущего юзера с котороым общаемся
	//В этом поле каждый раз обновляются данные при нажатии на вкладку(с каким юзером общаемся)
	var user=$("#user").val();
	
	$.ajax({
			type:"POST",
			url: "pages/chat/chat/actions/load_messes.php",
			//Отправляем на сервер
			data: "user="+user,
			success:function(html)
			{
				//Переменная равна 1, если пользователь прокрутил до конца
				var mess_ok=0;
					var chat =  jQuery('#messages');
					//Получаем высоту дива с сообщениями
					var mess_height=$("#messages").height();
					//Считаем прокрутил ли он до конца
					//Если прокрученное равно всей высоте минус высота блока с сообщениями
					if(chat[0].scrollTop==chat[0].scrollHeight-mess_height)
					{
						//То переменную равняем 1
						mess_ok=1;
					}
					//Подгружаем сообщения
				$("#messages").empty();
				$("#messages").append(html);
				//Если пользователь прокрутил до конца, скроллим в самый низ
				if(mess_ok==1)
				{
					$("#messages").scrollTop(10000);
					mess_ok=0;
				}
			}
	});
}
//Функция отправки сообщения на сервер
function send()
{
		var mess=$("#mess_to_send").val();
		var user=$("#user").val();
	   // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "pages/chat/chat/actions/mess_add.php",
                data: "mess="+mess+"&to="+user,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$('#mess_form').trigger( 'reset' );
					load_messes();
                },
				error:function()
				{
					alert("Ошибка! Данные не могут быть отправлены!");
					$('#mess_form').trigger( 'reset' );
					load_messes();
				}
        });
}

//Кто онлайн
function who_online()
{
	//Делаем запрос на сервер, там уже все за нас сделает php, просто выведем данные
	$.ajax({
			type:"POST",
			url: "pages/chat/chat/actions/online.php",
			data: "request=ok",
			success:function(html)
			{
				$("#online_list").empty();
				$("#online_list").append(html);
			}
	});
}

//Функция для создания новой вкладки при нажатии на логин в листе контактов
function open_private(user)
{
	//Получаем логин пользователя
	var current_user=$("#current_user").val();
	//Если новая вкладка для текущего пользователя, не открываем
	if(user!=current_user)
	{
		//Проверяем, есть ли уже такая вкладка
		var q="'";
		var tabs=$("#tabs").html();
		var login=tabs.match("'"+user+"'");
		//Если есть, то просто переходим на нее
	if(login!=null)
	{
		//Ставим нового пользователя с которым общаемся
		$("#user").val(user);
		//Обновляем цвет вкладки
		update_color(user);
		//Загружаем сообщения
		load_messes();
	}
	else
	{
		//Запонимаем имя новой вкладки
		var tab=user;
		//Ставим цвет текущей вкладки(это предыдущая) светло синий
		$("."+current_tab).css("background",non_active_tab_color);
		//Устанавливаем текущей вкладке значение на которую мы переходим
		current_tab=tab;
		//Хтмл код для добавления вкладки
		var tab_add='<span id="private_tab" class="'+tab+'" ><a href="#" onClick="update_color('+q+tab+q+');update_type_user('+q+user+q+');load_messes();">'+user+'</a><img src="pages/chat/img/close.png" width="15" onClick=delete_tab('+q+tab+q+'); /></span>';
		//Если уже есть 4 вкладки
		if(tab_num%4==0)
		{
			//Увеличиваем на один количество спейсеров(дивы между рядами) на 1
			tab_spa_num++;
			//Добавляем спейсер
			$("#tabs").append("<div id='tab_spacer' class='"+tab_spa_num+"'></div>");
			//Увеличиваем высоту заголовка над листом контактов
			header_h+=25;
			//Устанавливаем высоту
			$("#online_list_header").css("height",header_h);
		}
		//Добавляем вкладку на панель вкладок(див tabs)
		$("#tabs").append(tab_add);
		//Обновляем цвет текущей вкладки (белый)
		update_color(current_tab);
		//Увеличиваем количество вкладок
		tab_num++;
		//Обновляем поле в котором хранится с кем мы сейчас общаемся(оттуда другие функции это получают)
		$("#user").val(user);
		//Загружаем сообщения
		load_messes();
	}
	}
}

//Функция замены цвета текущей вкладки
function update_color(tab)
{
	//Придаем текущей вкладке цвет светло синий
	$("."+current_tab).css("background",non_active_tab_color);
	//Устанавливаем текущую вкладку на ту, которую перешли
	current_tab=tab;
	//Ставим текущей вкладке цвет активной вкладки(белый)
	$("."+current_tab).css("background",active_tab_color);
	
	//Заменяем картинку во вкладке на пробел
	replace_new(current_tab);
	//Обновляем поле в котором хранится логин юзера с которым общаемся на новый(вкладка на которую перешли)
	update_type_user(current_tab);
}

//Функция замены картинки нового сообщения на пробел
function replace_new(current_tab)
{
	//Получаем хтмл код панели вкладок
	var html_in=$("."+current_tab).html();
	//Заменяем код картинки на пробел
	var new_html = html_in.replace(/\<img src\=\"pages\/chat\/img\/new_mess.gif\"\>\&nbsp\;/g, '');
	//Убираем код из вкладки
	$("."+current_tab).empty();
	//Ставим уже замененный код(без картинки)
	$("."+current_tab).append(new_html);
}

//Функция замены юзера в поле с которым общаемся
function update_type_user(user)
{
	//ставим нового юзера
	$("#user").val(user);
	//Загружаем сообщения
	load_messes();
}

//Функция удаления вкладки
function delete_tab(tab)
{
	//При удалении вкладки, будет ли нужно удалить спейсер (чтобы не было отступа), если это последняя вкладка в ряду
	if((tab_num-1)%4==0)
	{
		//Удаляем последний спейсер который мы добавляли
		$("."+tab_spa_num).remove();
		//Уменьшаем количество спейсеров
		tab_spa_num--;
		//Уменьшаем высоту заголовка на листом контактов
		header_h-=25;
		//Обновляем высоту
		$("#online_list_header").css("height",header_h);
	}
	//Удаляем вкладку
	$("."+tab).remove();
	//Обновляем поле юзера с которым общаемся на общий чат
	$("#user").val('all');
	//Обновляем цвет и ставим активный на общий чат
	update_color('all');
	//Загружаем сообщения
	load_messes();
	//Уменьшаем количество вкладок
	tab_num--;
}

function to_all_chat_span()
{
	//при нажатии на вкладку "Общий чат" обновляем цвет и загружаем сообщения
	update_color('all');
	update_type_user('all');
	load_messes();
}

//Функция добавления вкладки, если есть новые сообщения
function have_new_message(from)
{
	var q="'";
	//Код для добавления если вкладка уже существует, но не активна(пользователь в другой вкладке)
	var tab_size0_add='<a href="#" onClick="update_color('+q+from+q+');update_type_user('+q+from+q+');load_messes();"><img src="pages/chat/img/new_mess.gif">&nbsp;'+from+'</a><img src="pages/chat/img/close.png" width="15" onClick=delete_tab('+q+from+q+'); />';
	//Код для добавления если вкладки не существует
	var tab_size1_add='<span id="private_tab_new" class="'+from+'" ><a href="#" onClick="update_color('+q+from+q+');update_type_user('+q+from+q+');load_messes();"><img src="pages/chat/img/new_mess.gif">&nbsp;'+from+'</a><img src="pages/chat/img/close.png" width="15" onClick=delete_tab('+q+from+q+'); /></span>';
	//Если вкладка существует
	if($("."+from).size()!=0)
	{
		//обновляем код вкладки на панель вкладок и добавляем туда картинку
		$("."+from).empty();
		$("."+from).append(tab_size0_add);
	}
	else
	{
		//Если вкладок уже больше чем 4 в ряду
		if(tab_num%4==0)
		{
			//Добавляем количество спейсеров
			tab_spa_num++;
			//Добавляем спейсер
			$("#tabs").append("<div id='tab_spacer' class='"+tab_spa_num+"'></div>");
			//Увеличиваем высоту заголовка над листом контактов 
			header_h+=25;
			//Обновляем высоту
			$("#online_list_header").css("height",header_h);
		}
		//Добавляем вкладку на панель вкладок
		$("#tabs").append(tab_size1_add);
		//Увеличиваем количество вкладок
		tab_num++;
	}
}



