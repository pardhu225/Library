<?php
include('funct.php');
redir_if_not_login();

$conn = new mysqli("127.0.0.1","root","","library");
if(!$conn)
{
	die("Couldn't connect to the core database.");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard - Library</title>
	</head>
	<body>
		<div style="height: 25px;">This is a clearing area for the navigation bar.</div>
		<div id="welcomeBanner">
			Currently Logged in: <?php echo $_SESSION['username']; ?><br>
			Logged in as: <?php echo user_type();?>
		</div>
		<div id="main">
			<?php
			if($_SESSION['usertype']==1) :			//All the elements for a student
			?>
			<div class="displayContainer">
				<div class="tableLabel"></div>
				<table>
					<tr>
						<th>Book Title</th>
						<th>Date of issue</th>
					</tr>
					<?php
					$sql = 'SELECT bookTitle AS title, issueDate , transid FROM transactions WHERE userid="'.
									$_SESSION['userid'].'"';
					$res = $conn->query($sql);
					if($res->num_rows===0)
						echo "<tr colspan='2'>You havent taken any books yet</tr>";
					else
					{
						echo '<tr>';
						for($i=0;$i<$res->num_rows;$i++)
						{
							$row = $res->fetch_array(MYSQL_ASSOC);
							echo '<td onclick="showToast(this, this.id)">'.$row['title'].'</td>';
							echo '<td>'.style_it($row['duedate']).'</td>';
						}
					}
					?>
				</table>
			</div>
			<?php endif;?>
		</div>
	</body>
</html>