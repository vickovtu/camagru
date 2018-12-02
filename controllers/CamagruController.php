<?php
	include_once ROOT.'/models/Camagru.php';
	class CamagruController
	{

		//CAMAGRU actionIndex просмотр головной стр
		public function actionIndex()
		{

			$camagruList = array();
			$camagruList = Camagru::getCamagruList();
			require_once(ROOT.'/views/index.php');
			return (true);
		}

		//CAMAGRU actionView  посмотр одной foto
		public function actionView($id)
		{
			$foto = array();
			$foto = Camagru::getCamagruById($id);
			$name = Camera::name();
			//создаем массив коментариев
			$commentsList = array();
			$commentsList = Foto::getComment($id);
			//получаем количество лайков
			$colLike = Foto::getLikes($id);
			//узнаем лайкнул ли юзер
			$likeUser = Foto::getUserLike($id, $name);


			require_once(ROOT.'/views/foto.php');
			return (true);
		}
		
	}
?>