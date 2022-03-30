<?php 
require_once '../../core/init.php';

$show = new Show();
$book = new Book();

if (isset($_POST['sectionId'])) {

	$sectionId = $_POST['sectionId'];
	$books = $book->sectionBooks($sectionId);
	if ($books) {
		echo $books;
	}

}