<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>GRIT TEST</title>

	<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../js/jquery.min.js"></script>
    <script type='text/javascript' src="../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../js/camera.min.js"></script>

		<style>
			body{
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
}
		</style>

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
 	<p style="margin-left:10%; font-size:50px; color:rgb(164, 175, 32)">GRIT TEST</p><br>


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
 
 <div >
	<form action='checkgrit.php' method='post' style="margin-left:10%"> 
	
  	<?php
	$id=1;	
	$res = $conn->query("Select * from grit");
 	while($row=$res->fetch_assoc())
		{
			
			echo //the names according to the column name in the database
				'<fieldset  id="field"><p>'.$id.') '.nl2br(htmlspecialchars($row['question'])).'</p> 
				
				<label><input style="margin-top:12px" type="radio" name="' .$id. '" value="option1">Very Much like me</label><br>
				<label><input type="radio" name="' .$id. '" value="option2">Mostly like me</label><br>
				<label><input type="radio" name="' .$id. '" value="option3">Somewhat like me</label> <br>
				<label><input type="radio" name="' .$id. '" value="option4">Not much like me</label><br>
				<label><input type="radio" name="' .$id. '" value="option5">Not like me at all</label><br><br><br></fieldset>';
		 $id++;		
						
		}
	
	?>

		<div style="padding-left:40%">
	<input name='loginbtn' type='submit' class="btn btn_s" value='SUBMIT'>
</div>
	</form>
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