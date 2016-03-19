<?php
	session_start();
	$count = $_SESSION['count1'];
?>

<html>
	<head>
		<title>UPDATE STUDENTS</title>
		<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	    <script type='text/javascript' src="../js/jquery.min.js"></script>
	    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
	    <script type='text/javascript' src="../js/camera.min.js"></script>
	</head>
	<body>
		<div class="wrap">
			<div class="wrapper">
				<div class="logo">
					<a href="admin.php"><h1>Clusters</h1></a>
				</div>
				<div class="header_right">
					<div class="cssmenu">
						<ul>
			<li class="active"><a href="">
		<?php
		
		echo "Hello Admin";
		?></a></li>
			<li class="last"><a href="../logout.php"><span>Logout</span></a></li>
			<div class="clear"></div>
		 </ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="clear"></div>

		<div style="padding:30px" class="main_bg">

			<div style="margin-left:10%">

				<p style=" font-size:50px; color:rgb(164, 175, 32)">UPDATE STUDENTS</p><br>
				<p>Records of <?php echo $count; ?> students deleted successfully.</p><br>
				<p>Enter the following details to update.</p><br></br>

				<form action= '' method = 'post'>

					<p>
						<strong style="padding-right: 15px"> OLD Current Semester :</strong>
						<input type ='number' name='c1' id='c1' min='1' max='8'>
					</p>
					</br>

					<p>
						<strong style="padding-right: 15px"> NEW Current Semester :</strong>
						<input type ='number' name='c2' id='c2' min='1' max='8'>
					</p>
					</br>

					<p>
						<strong style="padding-right: 15px"> OLD Previous Semester :</strong>
						<input type ='number' name='p1' id='p1' min='1' max='8'>
					</p>
					</br>

					<p>
						<strong style="padding-right: 15px"> NEW Previous Semester :</strong>
						<input type ='number' name='p2' id='p2' min='1' max='8'>
					</p>
					</br>

					<input class="btn btn_s" type="submit" value="FINISH"/>
				</form>
			</div>

		</div>

		<div class="wrap">
			<div class="wrapper">
				<div class="footer">
					<a href="../index.html"><h2>Clusters</h2></a>
					<div class="copy">
						<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</body>
</html>

<?php
if(isset($_POST['c2'])&&isset($_POST['p2'])&&isset($_POST['p1'])&&isset($_POST['c1']))
{
			$host="mysql.hostinger.in";
			$username="u570247755_data";
			$password="123456";
			$database ="u570247755_host";
	// Create connection
	$con = new mysqli($host, $username, $password, $database);
	// Check connection
	if ($con->connect_error) 
	{
		die('Can\'t use' . DB_NAME . ':' . mysql_error());
	}

	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$p1 = $_POST['p1'];
	$p2 = $_POST['p2'];
	$number = 0;

	$con->query("UPDATE students SET curr_sem='$c2' where curr_sem='$c1'");
	$con->query("UPDATE students SET prev_sem='$p2' where prev_sem='$p1'");

	echo '<script>window.location.assign("updated.php");</script>';
}