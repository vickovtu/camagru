var $ = function(id)
		{
    		return (document.getElementById(id));
		}


		var myAJAX = function(pathLine, img)
		{
			var res;
			var xhr = new XMLHttpRequest();		// Создание объекта для HTTP запроса.
            xhr.open("POST", pathLine, false); 		// Настройка объекта для отправки синхронного GET запроса
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) { // если получен ответ и если статус код ответа 200 i responseText - текст ответа полученного с сервера.
					if ( xhr.responseText.indexOf("true") == -1)
						res = false;
					else
						res = true;		
                }
            }
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send('foto=' + img);
			return (res);
		}
		window.onload = function(){

			var like = $('like');
			var count = $('count');
			var foto = $('foto');
			foto_id = foto.getAttribute('name');

			var addLike = function()
			{
				var path_heart = '/template/img/heart.svg';
				var path_like = '/template/img/like.svg';
				var text = like.getAttribute('src');
				var number = parseInt(count.getAttribute('data_name'));
				var path_php;

				if ( text.indexOf(path_heart) == -1)
				{
					path_php="/foto/addlike/";
					if (myAJAX(path_php, foto_id) === true)
					{
						like.setAttribute('src', path_heart);
						number++;
						count.innerHTML=number;
						count.setAttribute('data_name', number);
					}
					else
						location.assign('/user/login');
				}
				else
				{
					path_php="/foto/delike/";
					if (myAJAX(path_php, foto_id) === true)
					{
						like.setAttribute('src', path_like);
						number--;
						count.innerHTML=number;
						count.setAttribute('data_name', number);
					}
					else
						location.assign('/user/login');
				}
			}

			like.addEventListener('click', addLike);
		}