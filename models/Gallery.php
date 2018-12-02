<?php
	class Gallery
	{
		const SHOW_BY_DEFAULT = 6;
		
		//получаем одну фотку
		public static function getGalleryById($id)
		{
			$id = intval($id);
			if ($id)
			{
				$db     = DB::getConnection();
				$result = $db->query('SELECT * FROM foto WHERE id='.$id);
				$res = $result->setFetchMode(PDO::FETCH_ASSOC);
				$row    = $result->fetch();
				$camagruList['id'] = $row['id'];
				$camagruList['autor'] = $row['autor'];
				$camagruList['img'] = $row['img'];
				return ($camagruList);
			}


		}

		//получаем фотки конкретной стр
		public static function getGalleryList($page=1)
		{
			$page =intval($page);
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
			$db          = DB::getConnection();
			$galleryList = array();
			$result      = $db->query('SELECT * FROM foto '
				."ORDER BY id ASC "
				."LIMIT ".self::SHOW_BY_DEFAULT
				.' OFFSET '.$offset);

			$i = 0;
			while($row = $result->fetch())
			{
				$galleryList[$i]['id'] = $row['id'];
				$galleryList[$i]['user_id'] = $row['user_id'];
				//получаем имя юзера
				$galleryList[$i]['autor'] = User::getUserById($galleryList[$i]['user_id'])['name'];
				$galleryList[$i]['img'] = $row['img'];
				$i++;
			}
			return ($galleryList);
		}



		public static function getTotalFoto()
		{
			$db = DB::getConnection();

			$result = $db->query('SELECT COUNT(id) AS count FROM foto');
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$row = $result->fetch();
			return ($row['count']);
		}
	}
?>