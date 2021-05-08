<?php

//FRONT CONTROLLER

// 1. Общие настройки
	session_start();

// 2. Подключение файлов системы
	define('ROOT', dirname(__FILE__));
	require_once(ROOT.'/components/Router.php');
	require_once(ROOT.'/components/DataBase.php');


// 3. Вызов Router
	$router = new Router();
	$router->run();
