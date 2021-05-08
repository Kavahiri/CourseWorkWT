<? include ROOT.'/views/header.php';?>
		<H1>Добро пожаловать, <? echo $user['login'];?>!</H1>
		<H2>Вы в личном кабинете.</H2>
		<H3>Дата регистрации: <? 
		$time=explode('-',$user['reg_date']);
		$time[2]=explode(' ',$time[2]);
		$data = date('d.m.Y',mktime(0,0,0,$time[1],$time[2][0],$time[0]));
		echo $data;
		?></H3>
		</div>
	</BODY>
</HTML>