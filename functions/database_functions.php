<?php
function db_connect()
{
	$conn = mysqli_connect("localhost", "root", "", "www_project");
	if (!$conn) {
		echo "Can't connect database " . mysqli_connect_error($conn);
		exit;
	}
	return $conn;
}

function select4LatestBook($conn)
{
	$row = array();
	$query = "SELECT book_isbn, book_image FROM books ORDER BY book_isbn DESC";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	for ($i = 0; $i < 4; $i++) {
		array_push($row, mysqli_fetch_assoc($result));
	}
	return $row;
}
