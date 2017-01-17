<?php
if(!isset($_POST['username']))
{
	echo "<script>window.location.assign('index.php?q=2');</script>";
	die;
}

include('funct.php');
$conn = new mysqli("127.0.0.1","root","","library");
if(!$conn)
{
	echo "there was an error connecting to the core database.";
	die();
}

$sql = 'SELECT * FROM users WHERE username="'.$_POST['username'].'" AND password="'.$_POST['password'].'"';
$res = $conn->query($sql);
if($res->num_rows===0)
{
	echo "<script>window.location.assign('index.php?q=1');</script>";
	die;
}
$row = $res->fetch_array(MYSQL_ASSOC);
create_session($_POST["username"], $row['usertype'], $row['userid']);
echo "<script>window.location.assign('dashboard.php');</script>";
?>
