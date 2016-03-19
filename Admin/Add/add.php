<?php
require_once("dbcontroller.php");
session_start();
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
	<title>ENTER MARKS</title>
	<link href="../../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../../js/jquery.min.js"></script>
    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../../js/camera.min.js"></script>



		<style onload="getSubject()">
		
			.frmDronpDown {margin: 2px 0px;padding:40px;}
			.demoInputBox {padding: 10px;border: #F0F0F0 1px solid;width: 50%;}
			.row{padding-bottom:15px;}
		</style>
		<script src="../file.js" type="text/javascript"></script>
		<script>

			function getSubject() 
			{
				$.ajax(
				{
					type: "POST",
					url: "select_subject.php",
					data: { branch:  $("#branch-list option:selected").val(), semester:  $("#semester-list option:selected").val()},
					success: function(data)
					{
						$("#subject-list").html(data);
					}
				});
			}

			function selectSemester(val) 
			{
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}
		</script>
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
		<div class="frmDronpDown">
			<form action="" method="POST" id="selectForm" style="margin-left:7%">
						<p style=" font-size:50px; color:rgb(164, 175, 32)">ADD MARKS</p><br>
						<p>Enter combination for Students whose marks you want to add.<br><br></p>
			<div class="row">	
				<select name="branch" id="branch-list" class="demoInputBox" onChange="getSubject()" >
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
				<select name="semester" id="semester-list" class="demoInputBox" onChange="getSubject()" >
					<option value="">Select Semester </option>
					<?php
						foreach($results1 as $semester) {
					?>
					<option value="<?php echo $semester["Semester_ID"]; ?>"><?php echo $semester["Semester_Name"]; ?></option>
					<?php
						}
					?>
				</select>
			</div> 
			<div class="row" >
				<select name="subject" id="subject-list" class="demoInputBox" onload="getSubject()">
					<option value="">Select Subject</option>
				</select>
			</div>
			<div class="row">
					<select name="type" id="type-list" class="demoInputBox" style>
					<option value="">Select Type</option>
					<?php
						foreach($results2 as $type) {
					?>
					<option name = "type" value="<?php echo $type["Type_ID"]; ?>"><?php echo $type["Type_Name"]; ?></option>
					<?php
						}
					?>
				</select>
			</div>
						<div>
							<input name='loginbtn' type='submit' class="btn btn_s" value='SUBMIT' >
						</div>		
				</form>
		</div>
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

<?php
	if(isset($_POST["branch"]) && isset($_POST["semester"]) && isset($_POST["type"]) && isset($_POST["subject"]))
	{
		$branch = $_POST["branch"];
		$sem = $_POST["semester"];
		$type = $_POST["type"];
		$subj = $_POST["subject"];
		$_SESSION['branch2'] = $branch;
		$_SESSION['sem2'] = $sem;
		$_SESSION['type2'] = $type;
		$_SESSION['subj2'] = $subj;
		echo '<script>window.location.assign("enter.php");</script>';
	}
?>