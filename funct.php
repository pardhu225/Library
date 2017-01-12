<?php
/**
 * Check if the login status is true.
 * If it isnt then redirect user to the index page
 */
function redir_if_not_login()
{
	if(!isset($_SESSION['loginStatus']) || !$_SESSION['loginStatus'])
		echo "<script>window.location.assign('index.php');</script>";
}

/**
 * Creates a session for the user.
 */
function create_session($username,$usertype,$userid)
{
	$_SESSION['username'] = $username;
	$_SESSION['usertype'] = $usertype;
	$_SESSION['userid'] = $userid;
}

/**
 * Ends a user session.
 */
 function kill_session()
 {
 	session_unset();
	session_destroy();
 }
?>