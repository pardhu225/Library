<?php

include("funct.php");

/**
 * Display the message corresponding to the value of q.
 */
function displayMsg()
{
	if(isset($_GET['q']))
	{
		switch($_GET['q'])
		{
			case 1:
				echo "<div class='errorMsg'>Entered username or password is incorrect</div>";
				break;
			case 2:
				echo "<div class='normalMsg'>You will have to enter the login credentials before you can continue.</div>";
				break;
			default:
				echo ":-D";
				break;
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login - Library</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<center>
			<div id="wrapper">
				<?php displayMsg(); ?>
				<h3>Enter the login credentials:</h3>
				<form action="processlogin.php" method="post">
					<div class="inputItem">Username : <input type="text" class="textInput" name="username"></div>
					<div class="inputItem">Password : <input type="password" class="textInput" name="password"></div>
					<div class="inputItem"><input type="submit" value="LOGIN" class="submitButton"></div>
				</form>
			</div>
			
		</center>
	</body>
</html>