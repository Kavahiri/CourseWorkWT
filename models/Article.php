<?php

class Article
{
	public static function getNextId()
	{
		$id = 1;
		$db = DataBase::getConnection();
		
		$sql = 'select id from articles order by id desc limit 1';
		$result = $db->prepare($sql);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result=$result->fetch();
		if ($result !== false){
			$id = $result['id'] + 1;
		}
		return $id;
	}

	// возвращает одну статью по идентификатору $id
	public static function getArticleById($id)
	{

			$db = DataBase::getConnection();
			$result = array();
			
			$result = $db->prepare('SELECT * FROM articles WHERE id = :id');
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->execute();
			$result->setFetchMode(PDO::FETCH_ASSOC);
			
			return $result->fetch();
	}
	
	// возвращает список статей
	public static function getArticleList()
	{
		$db = DataBase::getConnection();
		
		$arcicleList = array();
		
		$result = $db->query('select * from articles');
		
		$i = 0;
		while ($row = $result->fetch()){
			$arcicleList[$i]['id'] = $row['id'];			
			$arcicleList[$i]['name'] = $row['name'];
			$arcicleList[$i]['description'] = $row['description'];
			$i++;
		}
		
		return $arcicleList;
	}
	// добавление статьи
	public static function addArticle($name,$description,$text)
	{
		$id = 0;
		$db = DataBase::getConnection();
		$id = Article::getNextId();			
		$sql = 'insert into articles ( id, name, description,text) values (:id, :name, :description, :text)';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':description', $description, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		$result->execute();

		return true;
	}
	// обновление статьи
	public static function updateArticle($id, $name,$description, $text)
	{
		$db = DataBase::getConnection();
		
		$sql = 'update articles set  name=:name, description=:description, text=:text where id=:id ';
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':description', $description, PDO::PARAM_STR);
			$result->bindParam(':text', $text, PDO::PARAM_STR);
			$result->execute();
		return true;
	}
	
	// удаление статьи
	public static function deleteArticle($id)
	{
		$db = DataBase::getConnection();
		
		$sql = 'delete from articles where id=:id';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);		
		return $result->execute();
	}
}