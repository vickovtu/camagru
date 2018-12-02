<?php

class User
{
    //регистрирует пользователя
    public static function register($name, $email, $password) {
        $password = hash ( 'whirlpool' , $password );
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
    }


    //Редактирование данных пользователя
    //string $name
    //string $password
    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();
        $password = hash ( 'whirlpool' , $password );
        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";
        
        $result = $db->prepare($sql);                                  
        $result->bindParam(':id', $id, PDO::PARAM_INT);       
        $result->bindParam(':name', $name, PDO::PARAM_STR);    
        $result->bindParam(':password', $password, PDO::PARAM_STR); 
        return $result->execute();
    }


    //Проверяем существует ли пользователь с заданными $email и $password
    // string $email
    //string $password
    //возврат mixed : ingeger user id or false
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password AND reg = 1';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email);
        $result->bindParam(':password', $password);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    //Запоминаем пользователя
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    
   //Проверяет имя: не меньше, чем 2 символа
    public static function checkName($name) {
        if( preg_match("/^[-_a-zA-Z0-9]{4,50}$/", $name))
            return true;
        return false;
    }
    
    //Проверяет pass: не меньше, чем 6 символов
    public static function checkPassword($password) {
        if (preg_match("/^([-_a-zA-Z0-9]){6,50}$/",$password) ) {
            return true;
        }
        return false;
    }
    
    //Проверяет email
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    //проверяем на валидность емеил
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    //возвращаем данные про юзера
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return ($result->fetch());
        }
        else
            return (false);
    }

    //получаем фото юзера
    public static function getUserFoto($user)
    {
        if ($user)
        {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM foto WHERE user_id = :user_id';

            $result = $db->prepare($sql);
            $result->bindParam(':user_id', $user, PDO::PARAM_STR);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $i = 0;
            $userFoto = array();
            while($row = $result->fetch())
            {
                $userFoto[$i]['id'] = $row['id'];
                $userFoto[$i]['user_id'] = $row['user_id'];
                $userFoto[$i]['img'] = $row['img'];
                $i++;
            }
            return($userFoto);
        }
    }

    //выходим из сессии
    public static function logout()
    {
        unset($_SESSION["user"]);
    }

    //удаляем пользователя
    public static function delete($id)
    {
        $id = intval($id);
        echo " id = $id";
        $db = Db::getConnection();
        $sql = 'DELETE FROM user WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        var_dump( $result);
        return ($result->fetch());
    }


    public static function mailto($mail_to, $mail_subject, $mail_message) {
        $from_name = "camagru";
        $from_mail = "vickovtu@student.unit.ua";


        $encoding = "utf-8";

        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
    
        // Set mail header
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
    
        // Send mail
        $res = mail($mail_to, $mail_subject, $mail_message, $header);
        return($res);
	}
 
    public static function reg($email)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE user SET reg= 1 WHERE email =  :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();
    }
}