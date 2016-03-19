<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>GRIT TEST RESULT</title>
	<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../js/jquery.min.js"></script>
    <script type='text/javascript' src="../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../js/camera.min.js"></script>
	
</head>
<body>

<div class="wrap">
<div class="wrapper">
<div class="logo">
	<a href="sprofile.php"><h1>Clusters</h1></a>
</div>
<div class="header_right">
	<div class="cssmenu">
		<ul>
			<li class="active"><a>
		<?php
		$name=$_SESSION['username'];
		echo "Hello ".$name;
		?></a></li>
			
			<div class="clear"></div>
		 </ul>
	</div>
</div>
	<div class="clear"></div>
</div>
</div>	

 <div class="main_bg" style="padding:30px">
 	<p style="margin-left:10%; font-size:50px; color:rgb(164, 175, 32)">GRIT TEST RESULT</p></br></br>
 	<div style="margin-left:10%;">

<?php 
			$host="mysql.hostinger.in";
			$username="u570247755_data";
			$password="123456";
			$database ="u570247755_host";
// Create connection
$conn = new mysqli($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
   die('Can\'t use' . DB_NAME . ':' . mysql_error());
 }
 ?>
 <div>
  	<?php
		$marks=0;
			
				$id=1;
  $res = $conn->query("Select * from grit");
 	while($row=$res->fetch_assoc())
 	{
			

				if(isset($_POST["$id"]))
				{
					
				if($_POST["$id"]=="option1")
				{

					$marks += $row['option1'];
					
				}
				if($_POST["$id"]=="option2")
				{

					$marks += $row['option2'];
					
				}
				if($_POST["$id"]=="option3")
				{

					$marks += $row['option3'];
					
				}
				if($_POST["$id"]=="option4")
				{

					$marks += $row['option4'];
					
				}
				if($_POST["$id"]=="option5")
				{

					$marks += $row['option5'];
					
				}
			}
			
				$id++;
			}

			$id1=$_SESSION['id'];
				$marks= $marks/12;
				echo 'You have successfully completed the test. '.'<div id="marks">MARKS : '.$marks.'</div>';
				$conn->query("update students set grit='".$marks."' where UID='".$id1."'");
				
				$ftotal=$_SESSION['ftotal'];
				$ftotal=($ftotal+$marks)/2;
				$conn->query("update students set final_total='".$ftotal."' where UID='".$id1."'");

	?>

			<div style="padding-left:40%" >
				<button class="btn btn_s" onclick="window.location.href='sprofile.php'">FINISH</button>
			</div>
	</div>
	</div>
	</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="sprofile.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved.</p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
	
</body>
</html>