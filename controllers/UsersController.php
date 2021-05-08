<?php

include_once ROOT.'/models/Users.php';

class UsersController
{
		//регистрация
		public function actionRegistration()
		{
			$login = '';
			$password = '';
			$result = false;
		
			if (isset($_POST['submit']))
			{
				$login = $_POST['login'];
				$password = $_POST['password'];
				$errors = false;
				
				if(!Users::checkLogin($login))
				{
					$errors[] = 'Логин не короче 4-х символов!';
				}
				if(!Users::checkPassword($password))
				{
					$errors[] = 'Пароль не короче 4-х символов!';
				}
				if(Users::checkLoginExist($login))
				{
					$errors[] = 'Логин уже занят';
				}
				if ($errors == false)
				{
				$result = Users::registration($login, $password);
				header ("Location: ../login/");
				}
			}
			require_once(ROOT.'/views/registration/registration.php');
			return true;
		}
		//логин
		public function actionLogin()
		{
			$login = '';
			$password = '';
			if (isset($_POST['submit']))
			{
				$login = $_POST['login'];
				$password = $_POST['password'];
				
				$errors = false;
				
				$userLogin = Users::CheckUserData($login, $password);
			
				if ($userLogin == false)
				{
					$errors[] = 'Неправильные данные для входа на сайт!';
				}
				else
				{
					Users::auth($userLogin);
					header ("Location: ../account/");
				}
			}
			require_once(ROOT.'/views/users/login.php');
			return true;
		}
		//логаут
		public function actionLogout()
		{			
			unset($_SESSION['user']);
			header ("Location: ../login/");
			return true;
		}	
		public function actionAccount()
		{
			$userLogin = Users::checkLogged();
		
			$user = Users::getUserByLogin($userLogin);
			
			require_once(ROOT.'/views/account/account.php');
			return true;
		}
}