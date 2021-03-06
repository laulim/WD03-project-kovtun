<?php 

if (!isAdmin()) {
	header('Location: ' . HOST);
	die();
}

$title = "Редактировать - Обо мне";

$job = R::load('jobs', $_GET['id']);

if (isset($_POST['jobUpdate'])) {
	if (trim($_POST['period']) == '') {
		$errors[] = ['title' => 'Введите период работы'];
	}

	if (trim($_POST['title']) == '') {
		$errors[] = ['title' => 'Введите должность'];
	}

	if (empty($errors)) {
		$job->period = htmlentities($_POST['period']);
		$job->title = htmlentities($_POST['title']);
		$job->description = htmlentities($_POST['description']);

		R::store($job);
		header('Location: ' . HOST . 'about/edit-jobs?result=jobUpdated');
		exit();
	}
}



// Готовим контент для центральной части
ob_start();
include ROOT ."templates/_parts/_header.tpl";
include ROOT ."templates/about/job-item-edit.tpl";
$content = ob_get_contents();
ob_end_clean();

// Выводим шаблоны
include ROOT ."templates/_parts/_head.tpl";
include ROOT ."templates/template.tpl";
include ROOT ."templates/_parts/_footer.tpl";
include ROOT ."templates/_parts/_foot.tpl";

?>
