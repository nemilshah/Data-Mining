<?php session_start(); 

require_once("SelectForm/dbcontroller.php");
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

<title>TEACHER PROFILE</title>

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
	<a style="cursor:default"><h1>Clusters</h1></a>
</div>
<div class="header_right">
	<div class="cssmenu">
		<ul>
			<li class="active"><a href="">
		<?php
		$name=$_SESSION['teachername'];
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
<div class="clear"></div>

<div style="padding:30px" class="main_bg">



			<div class="frmDronpDown" style=" margin-left:7%">
						<form action="" method="POST" id="selectForm">
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
							<input name='loginbtn' type='submit' class="btn btn_s" value='SUBMIT' >
							<input style="margin-left:290px"name='loginbtn' type='submit' class="btn btn_s" onclick="javascript: form.action='SelectForm/custom_profile.php';" value='PROFILE CLUSTER'>
							<input style="margin-left:230px"name='loginbtn' type='submit' class="btn btn_s" onclick="javascript: form.action='SelectForm/custom.php';" value='MARKS CLUSTER'>
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
		 	$sem=$sem-1;

		 	$res = $con->query("SELECT * FROM students where branch='$branch' and prev_sem='$sem'");

		 	$num_rows = mysqli_num_rows($res);

		 	if($num_rows==0)
		 	{
		 		?>
					<p style="color:black; font-size:30px; margin-left:10%">Data Not Available<br></p>
				<?php 
		 	}
		 	else{


		 	$ba=0;
		 	$a=0;
		 	$aa=0;
			while($row=$res->fetch_assoc())
			{	
				if($row['prev_cluster']=='Below Average')
					$ba++;
				elseif ($row['prev_cluster']=='Average')
					$a++;
				else
					$aa++;
			}

		


		 	echo "


    <script>
      google.load('visualization', '1', {packages:['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

		var x = $ba;
		var y = $a;
		var z = $aa;
		var s = $sem;
		
		
		var arr = [
          ['Cluster', 'No. of students'],
          ['Below Average',   x],
          ['Average',      y],
          ['Above Average',  z],
        ];



        var data = google.visualization.arrayToDataTable(arr,false);

       
		var options = {
          title: 'CLUSTERING BASED ON SEMESTER $sem MARKS'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
		 	"?>
		 
	<div id="piechart" style="width: 1010px; height: 500px; margin-left:10%" ></div>
		 	<div style="margin-left:10%">
		 	<?php
		 	$res = $con->query("SELECT * FROM students where branch='$branch' and prev_sem='$sem'");?>
			<p style="color:blue; font-size:30px"><br>Below Average:<br></p>
			<div id="left" style="text-decoration: underline;">Name</div><div id="middle" style="text-decoration: underline;">Apptitude Marks</div><div id="right" style="text-decoration: underline;">Grit Marks</div>
	<?php while($row=$res->fetch_assoc())
			{	
				if($row['prev_cluster']=='Below Average')
				{
					?>
					<div id="left"><?php echo $row['name']; ?></div>
					<div id="middle"><?php echo $row['apptitude']."/10"; ?></div>
					<div id="right"><?php echo $row['grit']."/10"; ?></div>
			<?php
				}
			}
			echo "<br>"."<br>";
			$res = $con->query("SELECT * FROM students where branch='$branch' and prev_sem='$sem'");
		?>
			<p style="color:red; font-size:30px">Average:<br></p>
			<div id="left" style="text-decoration: underline;">Name</div><div id="middle" style="text-decoration: underline;">Apptitude Marks</div><div id="right" style="text-decoration: underline;">Grit Marks</div>
	<?php 
			while($row=$res->fetch_assoc())
			{	
				if($row['prev_cluster']=='Average')
				{
					?>
					<div id="left"><?php echo $row['name']; ?></div>
					<div id="middle"><?php echo $row['apptitude']."/10"; ?></div>
					<div id="right"><?php echo $row['grit']."/10"; ?></div>
			<?php
				}
			}
			echo "<br>"."<br>";
			$res = $con->query("SELECT * FROM students where branch='$branch' and prev_sem='$sem'");
		?>
			<p style="color:orange; font-size:30px">Above Average:<br></p>
			<div id="left" style="text-decoration: underline;">Name</div><div id="middle" style="text-decoration: underline;">Apptitude Marks</div><div id="right" style="text-decoration: underline;">Grit Marks</div>
		<?php 
			while($row=$res->fetch_assoc())
			{	
				if($row['prev_cluster']=='Above Average')
				{
					?>
					<div id="left"><?php echo $row['name']; ?></div>
					<div id="middle"><?php echo $row['apptitude']."/10"; ?></div>
					<div id="right"><?php echo $row['grit']."/10"; ?></div>
			<?php
				}

			}
		}
	}
		?>

</div>
</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a style="cursor:default"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
</body>
</html>