<?php session_start(); 

require_once("dbcontroller.php");
$db_handle = new DBController();
$query1 ="SELECT * FROM semester";
$results1 = $db_handle->runQuery($query1);

$query2 ="SELECT * FROM type";
$results2 = $db_handle->runQuery($query2);

$query3 ="SELECT * FROM branch";
$results3 = $db_handle->runQuery($query3);


?>
<html>
<head>

<title>DELETE MARKS</title>

	<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../js/jquery.min.js"></script>
    <script type='text/javascript' src="../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../js/camera.min.js"></script>
    <script type="text/javascript" src="../js/charts.js"></script>


	<style>
		.frmDronpDown {margin: 2px 0px;padding:40px;}
		.demoInputBox {padding: 10px;border: #F0F0F0 1px solid;width: 50%;}
		.row{padding-bottom:15px;width:610px;}
	</style>


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



			<div class="frmDronpDown" style=" margin-left:7%">
						<form action="" method="POST" id="selectForm">
							<p style=" font-size:50px; color:rgb(164, 175, 32)">DELETE MARKS</p><br>
							<p>Enter Branch and Semester of Students whose marks you want to delete.<br><br></p>
						<div class="row">	
							<select name="branch" id="branch-list" class="demoInputBox"  >
								<option value="">Select Branch</option>
								<?php
									foreach($results3 as $branch) {
								?>
								<option value="<?php echo $branch["Branch_Name"]; ?>"><?php echo $branch["Branch_Name"]; ?></option>
								<?php
									}
								?>
							</select>
							</div>
							<div class = "row">
							<select name="semester" id="semester-list" class="demoInputBox"  >
								<option value="">Select Semester</option>
								<?php
									foreach($results1 as $semester) {
								?>
								<option value="<?php echo $semester["Semester_ID"]; ?>"><?php echo $semester["Semester_Name"]; ?></option>
								<?php
									}
								?>
							</select>
						</div> 
						
						<div >
							<input name='loginbtn' type='submit' class="btn btn_s" value='DELETE' >
						</div>

				
					</form>

					</div>


		<?php
		if (isset($_POST['semester'])&&isset($_POST['branch'])) 
		{
			$host="mysql.hostinger.in";
			$username="u570247755_data";
			$password="123456";
			$database ="u570247755_host";
			
			$con = new mysqli($host , $username, $password, $database);
		 
		 	$branch=$_POST['branch'];
		 	$sem=$_POST['semester'];
		 	$sem=$sem%10;
		 	$count=0;

		 	$res = $con->query("SELECT * FROM students where branch='$branch' and curr_sem='$sem'");

			while($row=$res->fetch_assoc())
			{	
				$temp = $row['UID'];
				$con->query("DELETE FROM marks WHERE UID='$temp'");
				$count++;
			}
			$_SESSION['count1'] = $count;
			echo '<script>window.location.assign("update.php");</script>';
	}
		?>
</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="admin.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
</body>
</html>