<?php
class Camera{
	
	//узнаем идентификатор пользователя
	public static function name()
    {
        if (isset($_SESSION['user'])) {
        	return $_SESSION['user'];
        }
        else
        	return false;
    }

	public static function putCount()
	{

		$db 	= DB::getConnection();
		$result	= $db->query('SELECT id FROM foto');
		$i = 1;
		while($row = $result->fetch())
			$i++;
		return ($i);
	}


	//записывает фотку в бд
	public static function putImage($img, $name, $image)
	{
		$name = intval($name);
		$db 	= DB::getConnection();
		$sql 	= 'INSERT INTO foto (user_id, img) VALUES (:user_id, :img)';
		$result = $db->prepare($sql);
        $result->bindParam(':user_id', $name, PDO::PARAM_INT);
        $result->bindParam(':img', $img, PDO::PARAM_STR);
        $result->execute();
        if (file_put_contents(ROOT.$img, $image))
        	return ("сохранилось");
		else 
			return("не сохранилось");
	}
}
?>