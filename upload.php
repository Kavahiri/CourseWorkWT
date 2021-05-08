<?

define('ROOT', dirname(__FILE__));
include_once ROOT.'/models/Article.php';
include_once ROOT.'/components/DataBase.php';

function getex($filename) {
return end(explode(".", $filename));
}
function getURI() //возвращает строку запроса
	{
		if (!empty($_SERVER['HTTP_REFERER'])) 
		{
			return trim($_SERVER['HTTP_REFERER'], '/');
		}
	}
function URI()
{
	$uri=getURI();
	$uri_arr = explode('/', $uri);
	$root='/';
	for($i = 3; $i<count($uri_arr); $i++)
	{
		if ($uri_arr[$i]!=='article')
		{	
		$root .= $uri_arr[$i].'/';
		}
		else break;
	}
	return $root;
	
}
if($_FILES['upload'])
{
	if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
	{
		$message = "Вы не выбрали файл";
	}
else 
	if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 2050000)
	{
		$message = "Размер файла не соответствует нормам";
	}
else
	if (($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
	{
		$message = "Допускается загрузка только  JPG и PNG.";
	}
else 
	if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
	{
		$message = "Что-то пошло не так. Попытайтесь загрузить файл ещё раз.";
	}
else{
		$name = Article::getNextId().'-'.md5($_FILES['upload']['name']).'.'.getex($_FILES['upload']['name']);
		move_uploaded_file($_FILES['upload']['tmp_name'], ROOT.'/images/'.Article::getNextId().'/'.$name);
		$full_path =URI().'images/'.Article::getNextId().'/'.$name;
		$message = "Файл ".$_FILES['upload']['name']." загружен";
		$size=getimagesize(ROOT.'images/'.Article::getNextId().'/'.$name);
	}
$callback = $_REQUEST['CKEditorFuncNum'];
echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'", "'.$message.'" );</script>';
}
?>

