<?php
//Redir if not login
if(!isset($_GET['transid']))
{
	echo "<script>window.location.assign('index.php?q=2');</script>";
	die;
}
include("funct.php");
$conn = new mysqli("127.0.0.1","root","","library");

$sql = "SELECT bookid FROM transactions WHERE transid=".$_GET['transid']." and userid=".$_SESSION['userid'];
$res = $conn->query($sql);
if($conn->error || $res->num_rows!==1)		//If there is an error or there are multiple rows
{
	echo "Something went wrong. This book doesn't seem to belong to you.";
	die;
}
$row = $res->fetch_array(MYSQL_ASSOC);
echo get_book_attr($row['bookid'], "title", $conn);
