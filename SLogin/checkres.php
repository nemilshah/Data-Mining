<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>APPTITUDE TEST RESULT</title>
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
	<h1 style="cursor:default">Clusters</h1>
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
 	<p style="margin-left:10%; font-size:50px; color:rgb(164, 175, 32)">APPTITUDE TEST RESULT</p></br></br>
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
			
				$id=$_SESSION['apptitude'];
  $res = $conn->query("Select * from quiz where qid>='$id'");
 	while($row=$res->fetch_assoc())
 	{

				if(isset($_POST["$id"]))
				{
					
					if($_POST[$id]==$row['answer'])
					{

						$marks++;
					
					}
				}
			
				$id++;
	}
			$attempt=$_SESSION['attemptssess'];
			$id1=$_SESSION['id'];
				
			if($marks<8 && $attempt<10)
			{
				echo "You have failed the test and MARKS : ".$marks; 
				echo "<br><br><br>";?>


				<div style="padding-left:40%" >
					<button class="btn btn_s" onclick="window.location.href='appt.php'">RETEST</button>
				</div>
				<?php
				
			}
			else
			{ 	
				$attempt=10-$attempt;
			
				

				$conn->query("update students set apptitude='".$attempt."' where UID='".$id1."'");
				
				$ftotal=$_SESSION['ftotal'];
				$ftotal=($ftotal+$attempt)/2;
				$conn->query("update students set final_total='".$ftotal."' where UID='".$id1."'");
			
			
			if($attempt==0)
			{	
			echo 'You have failed the test '.'<div id="marks">MARKS : '.$marks.'</div>';	?>
						<div style="padding-left:40%" >
					<button class="btn btn_s" onclick="window.location.href='gritqstn.php'">NEXT</button>
				</div>
			<?php
			}
			else{
				echo 'You have successfully completed the test '.'<div id="marks">MARKS : '.$marks.'</div>';?>
				

				<div style="padding-left:40%" >
					<button class="btn btn_s" onclick="window.location.href='gritqstn.php'">NEXT</button>
				</div>
				
				<?php

			}
}
	?>
	</div>
	</div>
	</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a style="cursor:default"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved.</p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
	
	</body>
	</html>