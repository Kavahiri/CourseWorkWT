<? include ROOT.'/views/header.php';?>
<H1>Добавление статьи</H1>
	<form action="" method="post">
		<input type="text" class="articlename" name="name" placeholder = "Название статьи" maxlength="50" required>
		<br><textarea type="text" class="articledescript" name="description" placeholder = "Краткое описание"></textarea></br>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
		<textarea id="editor1" name="text" cols="80" rows="10">
        </textarea>
		<button type="submit" name="submit" id="button_submit">Добавление статьи</button>
        <script>
    CKEDITOR.replace('editor1',{
      filebrowserUploadUrl:'../upload.php',
      filebrowserUploadMethod: 'form'
    });
        </script>    
		 </form>
		 </div>
</body>
</html>
