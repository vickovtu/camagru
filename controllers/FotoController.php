<?php

    class FotoController
    {
        public function actionComment(){
            $comment = $_POST['comment'];
            $comment = htmlentities($comment);
            $foto    = $_POST['foto'];
            $name = Camera::name();
            $mail_subject = "you received a new comment";
            $email = Foto::getEmail($name);


			if ($name == false)
                echo "ввойдите в систему";
            else{
                $res = Foto::putComment($name, $foto, $comment);
                User::mailto($email, $mail_subject, $comment);
                $user = User::getUserById($name)['name'];
                echo $user;
            }
            return true;
        }

        public function actionAddlike(){
            $foto    = $_POST['foto'];
            $name = Camera::name();
            if ($name == false)
                echo "false";
            else{
                $res = Foto::putLike($name, $foto);
                echo "true";
            }
            return true;
        }
        public function actionDelike(){
            $foto    = $_POST['foto'];
            $name = Camera::name();
            if ($name == false)
                echo "false";
            else{
                $res = Foto::delLike($name, $foto);
                echo "true";
            }
            return true;
        }
    }