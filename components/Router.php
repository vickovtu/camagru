<?php
    class Router {
        
        
        private $routes;
        public function __construct()
        {
            //подключаем массив паттернов
            $routesPath = ROOT.'/config/routes.php';
            $this->routes = include($routesPath);
        }

        private function getURI()
        {
            //получаем строку запроса
            if (!empty($_SERVER['REQUEST_URI']))
            {
               return trim($_SERVER['REQUEST_URI'], '/');
            }
        }
        
        public function run()
        {
            $uri = $this->getURI();
            //идем по массиву паттернов из массива routes
            foreach ($this->routes as $uriPattern => $path)
            {
                //сравниваем $uriPattern c $uri (сравниваем ключ с нашим путем)
                if (preg_match("~$uriPattern~", $uri))
                {
                    // echo "<br>Где ищем ".$uri;
                    // echo "<br>Что ищем ".$uriPattern;
                    // echo "<br>Кто обрабатывает ".$path."<br>";

                    $segments = explode('/', $path);

                    if (isset(explode('/', $uri)[1]))
                        $parameters = explode('/', $uri)[1];
                    else 
                        $parameters = '';
                    $parameters = $parameters == "reg" ? explode('/', $uri)[2]:$parameters;
                    ///получаем имя контроллера удаляя его с массива
                    //ucfirst -делает первую букву заглавной
                    //array_shift удаляет первый елемент и возвращает его
                    $controllerName = ucfirst(array_shift($segments).'Controller');
                    $actionName = 'action'.ucfirst(array_shift($segments));

                    //подключаем класс-контроллера
                    $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                    //проверяем на существование и затем подключаем
                    if (file_exists($controllerFile))
                    {
                        include_once($controllerFile);
                    }

                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$actionName($parameters);
                    if ($result != null)
                    {
                        break;
                    }

                }
            }
        }
    }
?>
