<?php session_start(); ?>
<html>
<head>

	<link href="../../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../../js/jquery.min.js"></script>
    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../../js/camera.min.js"></script>

<title>ENTER MARKS</title>

	<style type="text/css">
		body {
	    	margin: 0;
		}
		#left {
		    width: 30%;
		    display: inline-block;
		}
		#middle {
		    width: 30%;
		    display: inline-block;
		}
		#right {
		    width: 30%;
		    display: inline-block;
		}
	</style>
</head>
<body>

<div class="wrap">
<div class="wrapper">
<div class="logo">
	<a href="../admin.php"><h1>Clusters</h1></a>
</div>
				<div class="header_right">
					<div class="cssmenu">
						<ul>
			<li class="active"><a href="">
		<?php
		
		echo "Hello Admin";
		?></a></li>
			<li class="last"><a href="../../logout.php"><span>Logout</span></a></li>
			<div class="clear"></div>
		 </ul>
					</div>
				</div>
	<div class="clear"></div>
</div>
</div>
<div class="clear"></div>


<div style="padding:30px" class="main_bg" >

<?php

			$host="mysql.hostinger.in";
			$username="u570247755_data";
			$password="123456";
			$database ="u570247755_host";

	// Create connection
	$conn = new mysqli($host, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) 
	{
		die('Can\'t use' . DB_NAME . ':' . mysql_error());
	}

	$res = $conn->query("SELECT * FROM students");
	$no_of_students = mysqli_num_rows($res);

	?>
	<div style="margin-left:10%">
			<p style=" font-size:50px; color:rgb(164, 175, 32)">ENTER MARKS</p><br>
			<div id="left">UID</div><div id="middle">NAME</div><div id="right">ENTER MARKS</div>
			<p><br></p>
	</div>

<?php
	$value = 0;
	while($row=$res->fetch_assoc())
	{
?>
		<form  action="" method="POST" style="margin-left:10%">

			<?php
				
			?>

				<div id="left"><?php echo $row['UID'];?></div><div id="middle"><?php echo $row['name'];?></div><input id="right" name="<?=$value?>" type="number"><br>
			
			<?php
				$value++;
			}?>
			<div style="padding-left:40%">
				<br><br><input name='loginbtn' type='submit' class="btn btn_s" value='NEXT'>
			</div>
		</form>
</div>


<div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="../admin.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

<?php
if(isset($_POST[0]))
{	

	$branch = $_SESSION['branch2'];
	$semester = $_SESSION['sem2'];
	$type = $_SESSION['type2'];
	$subject = $_SESSION['subj2'];

	$i = 0;
	$res = $conn->query("SELECT * FROM students");
	while($row=$res->fetch_assoc())
	{
		$marks = $_POST[$i];
		$id = $row['UID'];
		$sql = 	"INSERT INTO marks (UID,Type_ID,Subject_ID,Marks) VALUES ('$id','$type','$subject','$marks')";
		$i++;

		if ($conn->query($sql) === TRUE) 
		{
    		echo "New record created successfully";
		} 
		else 
		{
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
	echo '<script>window.location.assign("done.php");</script>';
}
?>
</body>
</html>