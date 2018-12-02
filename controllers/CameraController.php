<?php

	class CameraController
	{

		//выводим стр с камерой
		public function actionIndex()
		{
			require_once(ROOT.'/views/camagru.php');
			return (true);
		}

		//записываем фото
		public function actionAdd()
		{
			$string = preg_replace('~data:image/png;base64,~', '', $_POST['image']);
			$image = base64_decode($string);
			if (file_exists(ROOT.'/image') == false)
				mkdir(ROOT.'/image', 0777);
			$i = Camera::putCount();
			$name = Camera::name();
			if ($name == false)
				echo "ввойдите в систему";
			else{
				$img = '/image/user_id'.$name.'-foto'.$i.'.jpg';
				$res = Camera::putImage($img, $name, $image);
				echo $res;
			}
			
			return (true);

		}
		
	}
?>