<?php

class UserController
{

    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;

        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            

            $mail_subject = "registration";
            $mail_message = "you have registered on the site camagru <a href= 'http://localhost:8100/user/reg/".$email."'>registration</a>";
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors['name'] = 'Имя должно состоять из букв или цифр и нижнего подчеркивания не короче 4 символов';
            }
            if (!User::checkEmail($email)) {
                $errors['email']= 'Неправильный email';
            }    
            if (!User::checkPassword($password)) {
                $errors['password'] = 'пароль должнен состоять из букв или цифр и нижнего подчеркивания не короче 4 символов';
            }
            if (User::checkEmailExists($email)) {
                $errors['email1'] =  'Такой email уже используется';
            }
            if (!User::mailto($email, $mail_subject, $mail_message))
            {
                $errors['email2'] =  'Невозможно отправить письмо на вашу почту';
            }
            if ($errors == false) {
                $result = User::register($name, $email, $password);

            }
        }
        require_once(ROOT . '/views/register.php');
        return true;
    }

    
    public function actionLogin()
    {
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
                        
            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors['email']= 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
               $errors['password'] = 'пароль должнен состоять из букв или цифр и нижнего подчеркивания не короче 4 символов';
            }
            // Проверяем существует ли пользователь
            $password = hash( 'whirlpool' , $password );
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors['fal'] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);   
                // Перенаправляем пользователя в закрытую часть - кабинет 
                header("Location: /account/"); 

            }
        }
        require_once(ROOT . '/views/login.php');
        return true;
    }
    
    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        User::Logout();
        header("Location: /");
    }

    public function actionReg($id)
    {
        User::reg($id); 
        header("Location: /camagru/"); 
        return true;

    }

}
