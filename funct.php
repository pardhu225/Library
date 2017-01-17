<?php
/******************************************************************************************************************************
 * Check if the login status is true.
 * If it isnt then redirect user to the index page
 */
function redir_if_not_login()
{
	if(!isset($_SESSION['loginstatus']) || !$_SESSION['loginstatus'])
		echo "<script>window.location.assign('index.php?q=2');</script>";
}

/**
 * Creates a session for the user.
 */
function create_session($username,$usertype,$userid)
{
	$_SESSION['loginstatus'] = true;
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
 
/**
 * Returns a string description of the user type.
 */
function user_type()
{
	switch($_SESSION['usertype'])
	{
		case 1: return "Student";
		case 2: return "Library Staff";
		case 3: return "Super User";
	}
} 

/**
 * Returns a html string containing style and required message
 * provided the status of the book
 */
function style_it($due)
{
	$status = get_status($due);
	if($status===1){
		?>
		<div style="background-color:rgb(200,100,100);">
			<img src="img/fined.jpg" style="height:25px;width:25px;float:left;"> Fined!
		</div>
	<?php
	} else if($status===2) {
		?>
		<div style="background-color:rgb(100,255,255);">
			<img src="img/warning.jpg" style="height:25px;width:25px;float:left;"> Renew now!
		</div>
	<?php
	} else if($status==3) {
		?>
		<div style="background-color:rgb(100,200,100);">
			<img src="img/okay.jpg" style="height:25px;width:25px;float:left;"> Due: <?php echo $due;?>
		</div>
		<?php
	}
}

/**
 * Given the issueDate this function will returns the 
 * status of book.
 * 1 = fined
 * 2 = renewable
 * 3 = okay
 */
function get_status($due)
{
	$issueDate = strtotime($due);
	$c= new DateTime();
	$curr = $c->getTimestamp();
	$diff = ($curr - $issueDate)/86400;
	$curr = $issueDate+(7*86400);
	if($diff>=7)
		return 1;
	else if($diff<7 && $diff>=5)
		return 2;
	else
		return 3;
}
?>