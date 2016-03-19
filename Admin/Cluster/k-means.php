<?php 
	session_start(); 

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

<title>CLUSTER STUDENTS</title>

	<link href="../../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../../js/jquery.min.js"></script>
    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../../js/camera.min.js"></script>
    <script type="text/javascript" src="../../js/charts.js"></script>


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

<div style="padding:30px" class="main_bg">



			<div class="frmDronpDown" style=" margin-left:7%">
						<form action="" method="POST" id="selectForm">
							<p>Enter Branch and Semester of Students whom you want to cluster.<br><br></p>
						<div class="row">	
							<select name="branch" id="branch-list" class="demoInputBox"  >
								<option value="">Select Branch</option>
								<?php
									foreach($results3 as $branch) {
								?>
								<option value="<?php echo $branch["Branch_ID"]; ?>"><?php echo $branch["Branch_Name"]; ?></option>
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
							<input name='loginbtn' type='submit' class="btn btn_s" value='SUBMIT' >
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

		 	$res = $con->query("SELECT Subject_ID FROM subject where Branch_ID='$branch' and Semester_ID='$sem' and Subject_Name='ALL'");
		 	$row=$res->fetch_assoc();
		 	$_SESSION['subj']=$row['Subject_ID'];

		 	echo '<script>window.location.assign("cluster.php");</script>';
	}
		?>
</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="../admin.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
</body>
</html>