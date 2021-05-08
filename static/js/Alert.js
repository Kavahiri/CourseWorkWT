function confirmDelete(FOLDER_NAME, id)
{
	let agreement = confirm("Вы уверены, что хотите удалить статью?");
	if (agreement)
	{
		window.location.href = "/"+FOLDER_NAME+"article/delete/"+id+"/";
	}
}

function confirmExit(FOLDER_NAME)
{
	let agreement = confirm("Вы уверены, что хотите выйти из учетной записи?");
	if (agreement)
	{
		window.location.href = "/"+FOLDER_NAME+"users/logout/";
	}
}