<?php
session_start();
require_once "./functions/admin.php";
$title = "Add new book";
require "./template/header.php";
require "./functions/database_functions.php";
$conn = db_connect();

if (isset($_POST['add'])) {
	$isbn = trim($_POST['isbn']);
	$isbn = mysqli_real_escape_string($conn, $isbn);

	$title = trim($_POST['title']);
	$title = mysqli_real_escape_string($conn, $title);

	$author = trim($_POST['author']);
	$author = mysqli_real_escape_string($conn, $author);

	$descr = trim($_POST['descr']);
	$descr = mysqli_real_escape_string($conn, $descr);

	$price = floatval(trim($_POST['price']));
	$price = mysqli_real_escape_string($conn, $price);

	$publisher = trim($_POST['publisher']);
	$publisher = mysqli_real_escape_string($conn, $publisher);
		// add image
		if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}



	if (isset($conn)) {
		mysqli_close($conn);
	}

	require_once "./template/footer.php";
?>