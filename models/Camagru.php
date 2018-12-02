<?php
	class Camagru
	{
		//выводим одно фото
		public static function getCamagruById($id)
		{
			$id = intval($id);
			if ($id)
			{
				$db     = DB::getConnection();
				$result = $db->query('SELECT * FROM foto WHERE id='.$id);
				$res 	= $result->setFetchMode(PDO::FETCH_ASSOC);
				$row    = $result->fetch();

				$camagruFoto['id'] = $row['id'];
				$camagruFoto['user_id'] = $row['user_id'];
				//получаем имя юзера
				$camagruFoto['autor'] = User::getUserById($camagruFoto['user_id'])['name'];
				$camagruFoto['img'] = $row['img'];
				return ($camagruFoto);
			}


		}

		//получаем 6 фоток для главной стр
		public static function getCamagruList()
		{
			$db          = DB::getConnection();
			$camagruList = array();
			$result      = $db->query('SELECT * FROM foto ORDER BY id ASC LIMIT 6');

			$i = 0;
			while($row = $result->fetch())
			{
				$camagruList[$i]['id'] = $row['id'];
				$camagruList[$i]['user_id'] = $row['user_id'];
				//получаем имя юзера
				$camagruList[$i]['autor'] = User::getUserById($camagruList[$i]['user_id'])['name'];
				$camagruList[$i]['img'] = $row['img'];
				$i++;
			}

			return ($camagruList);
		}
	}
?>