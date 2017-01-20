<?php
include('funct.php');
redir_if_not_login();

$conn = new mysqli("127.0.0.1","root","","library");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard - Library</title>
		<style>
			body {
				font-family:"Comic Sans MS";
			}
			#detailBox {
				position: absolute;
				z-index: 1;
				width: 38%;
				padding:1%;
				height: 200px;
				border: solid 2px gray;
				visibility: hidden;
				margin-left:30%;
				background-color:#fff;
				box-shadow: gray 0px 10px 30px;
				border-radius: 10px;
			}
		</style>
	</head>
	<body>
		<div style="height: 25px;">This is a clearing area for the navigation bar.</div>
		<div id="welcomeBanner">
			Currently Logged in: <?php echo $_SESSION['username']; ?><br>
			Logged in as: <?php echo user_type();?>
		</div>
		<div id="main">
			<?php
			if($_SESSION['usertype']==1) :			//TODO Start the student GUI
			?>
			<div class="displayContainer">
				<div id="detailBox"></div>
				<table>
					<tr>
						<th>Book Title</th>
						<th>Date of issue</th>
					</tr>
					<?php
					
					$sql = 'SELECT * FROM transactions WHERE userid="'.
									$_SESSION['userid'].'"';
					$res = $conn->query($sql);
					echo $conn->error;
					if($res->num_rows===0)
						echo "<tr><td colspan='2'>You havent taken any books yet</td></tr>";
					else
					{
						for($i=0;$i<$res->num_rows;$i++)
						{
							$row = $res->fetch_array(MYSQL_ASSOC);
							style_it($row,$conn);
						}
					}
						
					?>
				</table>
			</div>
			<?php endif;    // TODO end the student GUI?>
		</div>
		<script>
			function showToast(id)
			{
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if(this.status===200 && this.readyState===4)
					{
						document.getElementById("detailBox").innerHTML=this.responseText;
						document.getElementById("detailBox").style.visibility="inherit";
						setTimeout(function(){document.getElementById("detailBox").style.visibility="hidden";},3000);
					}
				};
				xmlhttp.open("GET","info.php?transid="+id,true);
				xmlhttp.send();
			}
		</script>
	</body>
</html>