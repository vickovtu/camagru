<?php

    class Foto
    {

        //записываем комментарий в бд
        public static function putComment($name, $foto, $comment)
        {
            $user_id = intval($name);
            $foto_id = intval($foto);
            $comment = strval($comment);

            $db     = DB::getConnection();
		    $sql 	= 'INSERT INTO comment (user_id, foto_id, comment) VALUES (:user_id, :foto_id, :comment)';
		    $result = $db->prepare($sql);
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->bindParam(':comment', $comment, PDO::PARAM_STR);
            $result->execute();
        }

        //получаем массив комментарие для фотки с бд 
        public static function getComment($foto_id)
        {
            $foto_id = intval($foto_id);
            $db     = DB::getConnection();
            $sql    = 'SELECT * FROM comment WHERE  foto_id = :foto_id';
            $result = $db->prepare($sql);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $com_arr  = array();
            $i = 0;
            while($row = $result->fetch())
            {
                $com_arr[$i]['id'] = $row['id'];
                $com_arr[$i]['user_id'] = $row['user_id'];
                $com_arr[$i]['name'] = User::getUserById($com_arr[$i]['user_id'])['name'];
                $com_arr[$i]['foto_id'] = $row['foto_id'];
                $com_arr[$i]['comment'] = '<code>'.$row['comment'].'</code>';
                $i++;
            }
            return ($com_arr);
        }
         //записываем лайк в бд
        public static function putLike($name, $foto)
        {
            $foto_id = intval($foto);
            $user_id = intval($name);

            $db     = DB::getConnection();
            $sql 	= 'INSERT INTO likes (user_id, foto_id) VALUES (:user_id, :foto_id)';
		    $result = $db->prepare($sql);
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->execute();
        }

        //удаляем лайк с бд
        public static function delLike($name, $foto)
        {
            $foto_id = intval($foto);
            $user_id = intval($name);

            $db     = DB::getConnection();
            $sql 	= 'DELETE FROM likes WHERE user_id = :user_id AND foto_id = :foto_id';
		    $result = $db->prepare($sql);
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->execute();
        }

        //подсчитывает количество лайков к фото
        public static function getLikes($id)
        {
            $foto_id = intval($id);
            $db     = DB::getConnection();
            $sql 	= 'SELECT  COUNT(*) FROM likes WHERE foto_id = :foto_id';
		    $result = $db->prepare($sql);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();
            $res = $row[0];
            return $res;
        }

        //проверяет лайк юзера
        public static function getUserLike($id, $name)
        {
            $foto_id = intval($id);
            $user_id = intval($name);
            $db     = DB::getConnection();
            $sql 	= 'SELECT  * FROM likes WHERE user_id = :user_id AND foto_id = :foto_id';
            $result = $db->prepare($sql);
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->bindParam(':foto_id', $foto_id, PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();

            return $row;
        }

        //удаляем фото
        public static function delImg($foto)
        {
            $id = intval($foto);
            $db      = DB::getConnection();
            $sql     = "DELETE FROM foto WHERE id = :id";
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            return $result->execute();;
        }

        //получаем email
        public static function getEmail($name)
        {
            $name = intval($name);
            $db      = DB::getConnection();
            $sql 	= 'SELECT email FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $name, PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();
            return ($row[0]);
        }
    }