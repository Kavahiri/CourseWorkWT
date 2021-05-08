<? include ROOT.'/views/header.php';?>	
		<H1>Выберите статью или добавьте свою статью</H1>
		<div class="addd">
		<a href="/<?echo FOLDER_NAME; ?>article/add" class="add_s">Добавление статьи</a>
		</div>
		<table class="articleTable">
		<?foreach ($articleList as $articleItem): ?>
			<tr class="art_block">
				
				<td><a href="/<?echo FOLDER_NAME;?>article/<?echo $articleItem['id'];?>/" class="article"><? echo $articleItem['name'];?> </a></td>
				<td class="tdkol"><a href="/<?echo FOLDER_NAME;?>article/update/<?echo $articleItem['id'];?>/" class="article"> Обновить статью </a></td>
				<td class="tdkol"><a href="#" onclick="confirmDelete('<?echo FOLDER_NAME;?>', <?echo $articleItem['id'];?>)" class="article"> Удалить статью</a></td>
				
			</tr>
			<tr>
			<td colspan=3 class="descript" ><? echo $articleItem['description'];?></td>
			</tr>
		<?endforeach;?>
		</table>
		</div>
	</BODY>
</HTML>