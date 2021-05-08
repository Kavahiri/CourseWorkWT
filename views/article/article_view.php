<? include ROOT.'/views/header.php';?>
		<H1> <? echo $articleItem['name']; ?></H1>
		<H3>Дата добавления: <? 
		$time=explode('-',$articleItem['time_add']);
		$time[2]=explode(' ',$time[2]);
		$data = date('d.m.Y',mktime(0,0,0,$time[1],$time[2][0],$time[0]));
		echo $data;
		?></H3>
	<?echo $articleItem['text'];?>

	</BODY>
</HTML>