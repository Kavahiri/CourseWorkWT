<?php

class Users
{
	// метод добавляет в БД запись о новом зарегистрированном пользователе
	public static function registration($login, $password)
	{
		
		$db = DataBase::getConnection();
		$sql = 'insert into users (login, password) values (:login, :password)';
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', hash('sha256', $password), PDO::PARAM_STR);
		return $result->execute();
	}
	
	// метод проверяет длину логина 
	public static function checkLogin($login)
	{
		if (strlen($login) >= 4){
			return true;
		}
		else return false;
	}
	
	// метод проверяет длину пароля
	public static function checkPassword($password)
	{
		if (strlen($password) >= 4){
			return true;
		}
		else return false;
	}
	
	// метод проверяет существнование записи с переданным логином  
	public static function checkLoginExist($login)
	{
		$db = DataBase::getConnection();
		$sql = 'select count(*) from Users where login=:login';
		
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->execute();
		
		if ($result->fetchColumn()) return true;
		else return false;
	}
	
	// проверка существования пользователя с переданным логином и паролем
	public static function checkUserData($login, $password)
	{
		$db = DataBase::getConnection();
		$sql = 'select * from Users where login=:login and password=:password';
		
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', hash('sha256',$password), PDO::PARAM_STR);
		$result->execute();
		
		$user = $result->fetch();
		if ($user)
		{
			return $user['login'];
		}
		else return false;
	}
	
	// метод добавляет пользователя к сессии
	public static function auth($userLogin)
	{
		$_SESSION['user'] = $userLogin;
	}
	
	// метод проверяет: вошел ли пользователь на сайт
	public static function checkLogged()
	{
		if (isset($_SESSION['user']))
		{
			return $_SESSION['user'];
		}
		
		header("Location: /users/login");
	}
	
	// метод проверяет: является ли пользователь гостем
	public static function isGuest()
	{
		if (isset($_SESSION['user']))
		{
			return false;
		}
		else return true;
	}
	
	// метод возвращает данные о пользователе по его логину
	public static function getUserByLogin($userLogin)
	{
		if ($userLogin)
		{
			$db = DataBase::getConnection();
		
			$sql = 'select * from Users where login=:login';
		
			$result = $db->prepare($sql);
			$result->bindParam(':login', $userLogin, PDO::PARAM_STR);
			
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();
			
			return $result->fetch();
		}
	}
}