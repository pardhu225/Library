<?php
if(!isset($_SESSION['loginstatus']) || !$_SESSION['loginstatus'])
{
	echo "<script>window.location.assign('index.php?q=2');</script>";
	die;
}
include 'funct.php';
kill_session();
echo "<script>window.location.assign('index.php');</script>";
?>
