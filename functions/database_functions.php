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


function getBookByIsbn($conn, $isbn)
{
	$query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	return $result;
}


function getOrderId($conn, $customerid)
{
	$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "retrieve data failed!" . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	return $row['orderid'];
}
function insertIntoOrder($conn, $customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country)
{
	$query = "INSERT INTO orders VALUES 
		('', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_zip_code . "', '" . $ship_country . "')";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Insert orders failed " . mysqli_error($conn);
		exit;
	}
}
