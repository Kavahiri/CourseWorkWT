<!DOCTYPE HTML>

<HTML>
	<HEAD>
	<meta charset = "utf-8">
		<TITLE>		
			Учебный портал
		</TITLE>
		<script src="/<? echo FOLDER_NAME?>static/js/Alert.js"></script>
		<link rel="stylesheet" href="/<? echo FOLDER_NAME?>static/css/style.css">
	</HEAD>
	<BODY>
	<header>
		<div class="menu">
		<ul id="bar">
		<? include_once ROOT.'/models/Users.php'; if (Users::isGuest()): ?>	
			<li class="log"><a href="/<? echo FOLDER_NAME?>users/login/" class="header">Вход</a></li>
			<li class="log"><a href="/<? echo FOLDER_NAME?>" class="header">Главная страница</a></li>	
			
		<? else: ?>
			<li class="log"><a href="#" onclick="confirmExit('<? echo FOLDER_NAME?>')" class="header">Выход</a></li>
			<li class="log"><a href="/<? echo FOLDER_NAME?>users/account/" class="header">Личный кабинет</a></li>
			<li class="log"><a href="/<? echo FOLDER_NAME?>article/" class="header">Статьи</a></li>
			<li class="log"><a href="/<? echo FOLDER_NAME?>" class="header">Главная страница</a></li>			
		<? endif; ?>	
		</ul>
		</div>
	</header>
			<div class="block">
		