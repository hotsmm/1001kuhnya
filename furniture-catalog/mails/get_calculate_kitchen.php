<?php
	session_start();
	$win = "true";
	// Если существует переменная POST, то
	
	/*
	if($_POST){
		// Отправляем данные в Google
		function getCaptcha($SecretKey){
			$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdV1IcUAAAAABnQ0mXIp5Yh7tLEcAXzdqG6rx9Y&response={$SecretKey}");
			$Return = json_decode($Response);
			return $Return;
		}
		
		print_r( $Return );
		
		/* Принимаем данные обратно
		$Return = getCaptcha($_POST['g-recaptcha-response']);
		// Если вероятность робота более 0.5, то считаем отправителя человеком и выполняем отправку почты
		if( $Return->success == true && $Return->score > 1 ){ */
			
			$answer1 = $_POST['answer1'];
			$answer2 = $_POST['answer2'];
			$answer3_1 = $_POST['answer3-1'];
			$answer3_2 = $_POST['answer3-2'];
			$answer3_3 = $_POST['answer3-3'];
			$answer3_4 = $_POST['answer3-4'];
			$answer4 = $_POST['answer4'];
			$answer5 = $_POST['answer5'];
			$answer6 = $_POST['answer6'];
			$name = $_POST['name'];	
			$phone = $_POST['phone'];
			
			/* Проверям что заполнено поле с телефоном */
			if ( $_POST['phone'] AND $_POST['answer6'] ) {
				// Если поле с телефоно заполненно
				mail( "vasilyev-r@mail.ru, 1001_1@bk.ru", "Зявка на расчет стоимости кухни с сайта 1001i1kuhnya.ru", "
					Клиент: " . $name ."\n
					Телефон: " . $phone ."\n
					Тип мебели: " . $answer1 ."\n
					Планировка: " . $answer2 ."\n
					Размер 1: " . $answer3_1 ."\n
					Размер 2: " . $answer3_2 ."\n
					Размер 3: " . $answer3_3 ."\n
					Размер остравка: " . $answer3_4 ."\n
					Стиль: " . $answer4 ."\n
					Материал фасада: " . $answer5 ."\n
					Желаемый подарок: " . $answer6
					
				); 	
				$_SESSION['win'] = 1;
				$_SESSION['recaptcha'] = '<p class="text-light">Спасибо за обращение в мебельный магазин «1001 и 1 кухня». Мы ответим Вам в&#160;ближайшее время.</p>';
				header("Location: ".$_SERVER['HTTP_REFERER']);
			} else {
				// Если поле с телефоно НЕ заполненно
				$_SESSION['win'] = 1;
				$_SESSION['recaptcha'] = '<p class="text-light">Обязательное поле с номером телефона не заполненно! Пожалуйста, повторите попытку и заполенте поле с номером телефона.</p>';
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
			
		
		/*} else {
			// Иначе считаем отправителя роботом и выводим сообщение с просьбой повторить попытку
			$_SESSION['win'] = 1;
			$_SESSION['recaptcha'] = '<p class="text-light"><strong>Извините!</strong><br>Ваши действия похожи на робота. Пожалуйста повторите попытку!</p>';
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	} */
?>