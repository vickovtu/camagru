		
		var $ = function(id)
		{
    		return (document.getElementById(id));
		}
			var comment = $('comment');
			var submit = $('submit');
			var foto = $('foto');
			var cont = $('cont');
			var id_foto = foto.getAttribute('name');

			var addComment = function()
			{
				var text = comment.value;
				if (text.length > 0)
				{
					var xhr = new XMLHttpRequest();          // Создание объекта для HTTP запроса.
            		xhr.open("POST", "/foto/comment/", true); // Настройка объекта для отправки синхронного GET запроса
            
            		xhr.onreadystatechange = function () {
                    	if (xhr.readyState == 4) { // если получен ответ
                        	if (xhr.status == 200) { // и если статус код ответа 200
								if ( xhr.responseText.indexOf("ввойдите в систему") == -1){// responseText - текст ответа полученного с сервера.
									var div = document.createElement('div');
									console.log(xhr.responseText);
									div.innerHTML = '<span class="name">'+xhr.responseText+'</span>: '+'<plaintext>' + text;
									cont.appendChild(div);
								}
                            else
								location.assign('/user/login');
                        	}
                    	}
                	}
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					xhr.send('comment=' + text + '&foto=' + id_foto);
					// Отправка запроса, так как запрос является синхронным, следующая строка кода выполнится только после получения ответа со стороны сервера.
				}
				
			}

			submit.addEventListener('click', addComment);