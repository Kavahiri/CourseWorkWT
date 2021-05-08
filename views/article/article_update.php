<? include ROOT.'/views/header.php';?>
<H1>Обновление статьи:</H1>
		<script  type="text/javascript" src="/<? echo FOLDER_NAME?>ckeditor/ckeditor.js"></script>
		
		<form action="" method="post">
		
		<input type="text" class="articlename" name="name" maxlength="50" required value="<?echo $articleItem['name'];?>">
		<? echo '<textarea type="text" class="articledescript" name="description">'; 
		echo htmlspecialchars($articleItem['description']);
		echo '</textarea>';?>
		
        <? echo '<textarea id="editor" name="text">';
		 echo htmlspecialchars($articleItem['text']);
		echo '</textarea>';?>
		<button type="submit" name="update" id="button_submit">Обновить статью</button>
        <script>
	CKEDITOR.replace('editor',{
      filebrowserUploadUrl:'../../../upload_update.php',
      filebrowserUploadMethod: 'form'
    });
        </script>    
		 </form>
		 </div>
</body>
</html>
