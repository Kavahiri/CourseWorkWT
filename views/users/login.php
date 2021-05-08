<? include ROOT.'/views/header.php';?>
		<H1>Вход на сайт</H1>
		<br>
		<form action="" method="post">	
		<table class="logTable">
			<tr>
				<td class = "label">Логин</td>
				<td>
					<input type="text" class = "logData" name="login" placeholder = "Логин" value="<? echo $login; ?>">
				</td>
			<tr/>
			<tr>
				<td class = "label">Пароль</td>
				<td>
					<input type="password" class = "logData" name="password" placeholder = "Пароль" 
						value="<? echo $password; ?>">
				</td>
			</tr>
			<tr>
				<td colspan=2 ><a href="/<?echo FOLDER_NAME; ?>users/registration/" class="reg">Зарегистрироваться</a></td>
			</tr>
			<tr>
				<td colspan=2 ><button type="submit" class="button" name="submit">Вход</button></td>
			</tr>
		</table>	
		</form>
		<? if (isset($errors) and is_array($errors)): ?>
			<ul>
				<? foreach($errors as $errors): ?>
				<li class="errors"> - <? echo $errors; ?> </li>
				<? endforeach; ?>
			<ul>
		<? endif; ?>
	</BODY>
</HTML>