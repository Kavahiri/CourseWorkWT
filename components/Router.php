<?php

class Router
{
	private $routes;
	
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	private function getURI() //возвращает строку запроса
	{
		if (!empty($_SERVER['REQUEST_URI'])) 
		{
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
public function run()
	{	
		 // 1. Getting the request string
        $uri = $this->getURI();
        $uri_arr = explode('/', $uri);
		if ($uri_arr !== false) {
            $flag = false;
			if($uri_arr[0]!=='' and $uri_arr[0]!=='article' and $uri_arr[0]!=='users'){
				foreach ($uri_arr as $key=>$item) {
					if (($item === 'article' or $item === 'users') and (!$flag) ) {
						$root = '';
						for($i = 0; $i<$key; $i++){
							$root .= $uri_arr[$i].'/';
						}
						define('FOLDER_NAME', $root);
						$flag = true;				
					}
					elseif(($key === count($uri_arr)-1) and (!$flag)){
						$root = '';
						for($i= 0; $i<$key+1; $i++){
							$root .= $uri_arr[$i].'/';						
						}
						define('FOLDER_NAME', $root);
						$flag = true;
					}
				}
			}
			if (!$flag) {
                define('FOLDER_NAME', '');
            }
		}
        // 2. Checking if the request exists in routes
        foreach ($this->routes as $req=>$act) {
            // 3. If getting match then define the controller and action
            if (preg_match('@'.$req.'@', $uri)) {
                // 4. Importing file of chosen controller
                if ($req !== '') {
                    $internal = preg_replace('@' . $req . '@', $act, $uri);
                }
                else {
                    $internal = $act;
                }
                $matches = array();
                preg_match('@(article/.*$|main/.*$|users/.*$)@', $internal, $matches);
                $internal = $matches[0];
                $full_request = explode('/', $internal);
                $controller = ucfirst($full_request[0].'Controller');
                $action = 'action'.explode('?', ucfirst($full_request[1]))[0];
                $params = array();
                for ($i = 2; $i < count($full_request); $i++) {
                    $params[$i - 2] = $full_request[$i];
                }
                $file = ROOT.'/controllers/'.$controller.'.php';
                if (file_exists($file)) {
                    include_once($file);
                }

                // 5. Creating object and doing action
                try 
				{
                    $chosenController = new $controller;
                    $is_done = call_user_func_array(array($chosenController, $action), $params);
					
                }
                catch (TypeError $e) 
				{
                    header("HTTP/1.0 404 Not Found");
                    $is_done = false;
                }

                if ($is_done) break;
			}
		}
	}
}