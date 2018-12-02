
		var arr = document.getElementsByName("delete");

		function delimg(img){
			var xhr = new XMLHttpRequest();		// Создание объекта для HTTP запроса.
            xhr.open("POST", "/account/delimg", true); 		// Настройка объекта для отправки синхронного GET запроса
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) { // если получен ответ и если статус код ответа 200 i responseText - текст ответа полученного с сервера.
					if ( xhr.responseText.indexOf("true") != -1)
					{
						removeImg(img);
					}

                }
            }
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send('foto=' + img);
		}

		function removeImg(img){
			var el = document.getElementById(img);
			var el1 = el.parentNode;
			var el2 = el1.parentNode;
			el2.removeChild(el1);
		}
		for(var i  in arr)
		{
			if(typeof(arr[i]) == 'object')
			{
				var img = arr[i].getAttribute('id');
				arr[i].setAttribute('onclick', "delimg("+img+")");
			}
		}