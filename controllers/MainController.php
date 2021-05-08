<?php

class MainController
{
	
	public function actionMain()
	{
		require_once(ROOT.'/views/main/main.php');
		return true;
	}
}