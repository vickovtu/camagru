<?php

class AccountController
{

    //выводим страничку юзера
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        // получаем фотографии исера
        $fotoList = User::getUserFoto($userId);
       
		require_once(ROOT.'/views/account.php');
		return (true);
    }  
    
    // изминяем данные юзера
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
                
        $result = false;     

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors['name'] = 'Имя должно состоять из букв или цифр и нижнего подчеркивания не короче 4 символов';
            }
            
            if (!User::checkPassword($password)) {
                $errors['password'] = 'Имя должно состоять из букв или цифр и нижнего подчеркивания не короче 4 символов';
            }
            
            if ($errors == false) {
                $result = User::edit($userId, $name, $password);
            }
        }
		require_once(ROOT.'/views/edit.php');
		return (true);
    }

    //удаляем акк юзера
    public function actionDelete()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        //удаляем юзера
        $res = User::delete($userId);
        print_r($res);

        // удаляем сессию
        User::logout();

        header("Location: /");
		return (true);
    }

    public function actionDelimg()
    {
        $foto    = $_POST['foto'];
        $res = Foto::delImg($foto);
        if ($res === true)
            echo "true";
        return true;
    }

}
?>