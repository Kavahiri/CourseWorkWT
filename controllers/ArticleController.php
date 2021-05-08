<?php

include_once ROOT.'/models/Article.php';
include_once ROOT.'/models/Users.php';

class ArticleController
{
	
public function RemoveDir($path) 
{
 // если путь существует и это папка
 if ( file_exists( $path ) AND is_dir( $path ) ) 
	{
	   // открываем папку
	   $dir = opendir($path);
		while ( false !== ( $element = readdir( $dir ) ) ) 
		{
		  // удаляем только содержимое папки
		  if ( $element != '.' AND $element != '..' )  
		  {
			$tmp = $path . '/' . $element;
			chmod( $tmp, 0777 );
       // если элемент является папкой, то удаляем его используя нашу функцию RemoveDir
		  if ( is_dir( $tmp ) ) 
		  {
			 RemoveDir( $tmp );
		   // если элемент является файлом, то удаляем файл
		  } 
			else 
			{
			  unlink( $tmp );
			}
		}
		}
   // закрываем папку
    closedir($dir);
    // удаляем саму папку
   if ( file_exists( $path ) ) 
   {
     rmdir( $path );
   }
	}
}

	//метод actionIndex для получения списка статей
	public function actionIndex()
	{
		Users::checkLogged();
		$articleList = array();
		$articleList = Article::getArticleList();		
		require_once(ROOT.'/views/article/all_articles.php');
		return true;
	}
	
	// метод actionView для просмотра конкретной статьи
	public function actionView($id)
	{
		if ($id){
			$articleItem = Article::getArticleById($id);			
			if ($articleItem !== false){
				require_once(ROOT.'/views/article/article_view.php');	
			}
			else header("HTTP/1.0 404 Not Found");
		}
		
		return true;
	}
	// метод actionAdd для добавления статьи	
	public function actionAdd()
	{
		$flag = false;
		$result = false;
	if (!file_exists(ROOT.'/images/'.Article::getNextId()))
	{
		mkdir(ROOT.'/images/'.Article::getNextId(), 0700);
	}
		if (isset($_POST['submit'])){
			$name = $_POST['name'];
			$descript = $_POST['description'];
			$text = $_POST['text'];
			$result = Article::addArticle($name, $descript, $text);
			if ($result === true) header ("Location: ../article");
		}
		require_once(ROOT.'/views/article/article_add.php');
		return true;
	}
	// метод actionUpdate для обновления статьи	
	public function actionUpdate($id)
	{

		if (isset($_POST['update'])){
			$name = $_POST['name'];
			$descript = $_POST['description'];
			$text = $_POST['text'];
			$result = Article::updateArticle($id,$name, $descript, $text);
			if ($result === true) header ("Location: ../../".$id);
		}
		if ($id){
			$articleItem = Article::getArticleById($id);	
			require_once(ROOT.'/views/article/article_update.php');
		}
		return true;
	}
	// метод actionDelete для удаления статьи
	public function actionDelete($id)
	{
		$result = Article::deleteArticle($id);

		ArticleController::RemoveDir(ROOT.'/images/'.$id);
		
		if ($result === true) header ("Location: ../..");
	}

}