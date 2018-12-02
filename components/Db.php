<?php

	class Db
	{

		public static function getConnection()
		{
			$paramsPath = ROOT. '/config/db_params.php';
			$params = include($paramsPath);


			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
			$db  = new PDO($dsn, $params['user'], $params['password']);
			return ($db);
		} 

		public static function show_bd()
		{
			$paramsPath = ROOT. '/config/db_params.php';
			$params = include($paramsPath);


			$dsn = "mysql:host={$params['host']}";
			$db  = new PDO($dsn, $params['user'], $params['password']);
			$sql = "show databases";
			$result = $db->query($sql);
			while($row    = $result->fetch())
			{
				if ($row['Database'] == "camagru")
					return false;
			}
			return true;
		}

		public static function createBD(){
			$paramsPath = ROOT. '/config/db_params.php';
			$params = include($paramsPath);


			$dsn = "mysql:host={$params['host']}";
			$db  = new PDO($dsn, $params['user'], $params['password']);
			$sql = "CREATE DATABASE camagru";
    		 // use exec() because no results are returned
			$result = $db->exec($sql);
			$db = 0;

		}
		public static function createData(){


			self::createBD();
			$db = self::getConnection();
			  $result = $db->query('CREATE TABLE `comment` (
				`id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`foto_id` int(11) NOT NULL,
				`comment` text NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
			  $row    = $result->fetch();
			  $result = $db->query('CREATE TABLE `foto` (
				`id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`img` varchar(75) NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
			  $row    = $result->fetch();
			  $result = $db->query('CREATE TABLE `likes` (
				`id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`foto_id` int(11) NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
			  $row    = $result->fetch();
			  $result = $db->query('CREATE TABLE `user` (
				`id` int(11) NOT NULL,
				`name` varchar(15) NOT NULL,
				`password` varchar(255) NOT NULL,
				`email` varchar(30) NOT NULL,
				`reg` int(1)
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `comment`
			  ADD PRIMARY KEY (`id`),
			  ADD KEY `comment_ibfk_1` (`foto_id`),
			  ADD KEY `comment_ibfk_2` (`user_id`)');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `foto`
			  ADD PRIMARY KEY (`id`),
			  ADD KEY `foto_ibfk_1` (`user_id`)');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `likes`
			  ADD PRIMARY KEY (`id`),
			  ADD KEY `likes_ibfk_1` (`foto_id`),
			  ADD KEY `likes_ibfk_2` (`user_id`)');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `user`
			  ADD PRIMARY KEY (`id`)');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `comment`
			  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16');
			  $row    = $result->fetch();

			  $result = $db->query('ALTER TABLE `foto`
			  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `likes`
			  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `user`
			  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `comment`
			  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `foto`
			  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
			  $row    = $result->fetch();
			  $result = $db->query('ALTER TABLE `likes`
			  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
			  $row    = $result->fetch();
			   return ($row);
		  }

	}