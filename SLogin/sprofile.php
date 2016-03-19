<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>STUDENT PROFILE</title>
	<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../js/jquery.min.js"></script>
    <script type='text/javascript' src="../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../js/camera.min.js"></script>
       	<style type="text/css">
		body {
	    	margin: 0;
		}
		</style>

</head>
<body>
<div class="wrap">
<div class="wrapper">
<div class="logo">
	<a href=""><h1>Clusters</h1></a>
</div>
<div class="header_right">
	<div class="cssmenu">
		<ul>
			<li class="active"><a href="">
		<?php
		$name=$_SESSION['username'];
		echo "Hello ".$name;
		?></a></li>
			<li class="last"><a href="../logout.php"><span>Logout</span></a></li>
			<div class="clear"></div>
		 </ul>
	</div>
</div>
	<div class="clear"></div>
</div>
</div>

<div style="padding:30px" class="main_bg">

		<p style=" font-size:50px; color:rgb(164, 175, 32); margin-left:10%">MY PROFILE</h1><br><br></p>
<div style="margin-left:10%; font-size:17px;">
<?php 
$emailid=$_SESSION['logged-in'];
		
			$host="mysql.hostinger.in";
			$username="u570247755_data";
			$password="123456";
			$database ="u570247755_host";
		
		$con = new mysqli($host , $username, $password, $database);
		// check connection
		if($con->connect_error)
		{
			trigger_error('DB connection failed: '.
			$con->connect_error, E_USER_ERROR);
		}
		$res = $con->query("select * from students where email ='$emailid'");
		while($row=$res->fetch_assoc())
		{
			?><p class="customfont2" >UID : </p><?php echo $row['UID']."<br>"."<br>";
			?><p class="customfont2">NAME : </p><?php echo $row['name']."<br>"."<br>";
			?><p class="customfont2">BRANCH : </p><?php echo $row['branch']."<br>"."<br>";
			?><p class="customfont2">CURRENT SEMESTER : </p><?php echo $row['curr_sem']."<br>"."<br>";
			?><p class="customfont2">EMAIL-ID : </p><?php echo $row['email']."<br>"."<br>";



			if($row['prev_cluster']!=NULL){

			?>			
			<p class="customfont2">CLUSTER : </p><?php echo $row['prev_cluster']."<br>"."<br>";}
					
			else{
				?> <p class="customfont2">CLUSTER : </p><?php echo "Data not available"."<br>"."<br>";
			}

					?>


			<br><br><p style="font-size:20px">FOLLOWING FIELDS ARE CALCULATED FROM 1-10</p><br>
			<p class="customfont2">SSC : </p><?php echo $row['ssc']."<br>"."<br>";
			?><p class="customfont2">HSC : </p><?php echo $row['hsc']."<br>"."<br>";
			?><p class="customfont2">CET : </p><?php echo $row['cet']."<br>"."<br>";
			?><p class="customfont2">VOCATIONAL SUBJECT : </p><?php echo $row['voc_subj']."<br>"."<br>";
			?><p class="customfont2">WEB TECHNOLOGIES : </p><?php echo $row['wt']."<br>"."<br>";
			?><p class="customfont2">C : </p><?php echo $row['c']."<br>"."<br>";
			?><p class="customfont2">C++ : </p><?php echo $row['cpp']."<br>"."<br>";
			?><p class="customfont2">JAVA : </p><?php echo $row['java']."<br>"."<br>";
			?><p class="customfont2">PYTHON : </p><?php echo $row['python']."<br>"."<br>";
			?><p class="customfont2">MYSQL : </p><?php echo $row['mysql']."<br>"."<br>";

			if($row['apptitude']==-1)
			{$_SESSION['attemptssess']=-1;
				?>

				<button type="button" class="btn btn_s" onclick="window.location.href='appt.php'">Take The Test</button>

				<?php
			}
			else	
			{
				?><p class="customfont2">APPTITUDE MARKS : </p><?php echo $row['apptitude']."<br>"."<br>";
				?><p class="customfont2">GRIT MARKS : </p><?php echo $row['grit'];
			}	

			}

?>


</div>
</div>

<div class="clear"></div>

<div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href=""><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved.</p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

</body>
</html>
