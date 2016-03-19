<?php
	session_start();
	$a = $_SESSION['array_to'];
	$no_of_rows = $_SESSION['rows'];
	if(isset($_POST['submit'])) 
	{
		$cno = $_POST['cno'];
	}
	$_SESSION['number'] = $cno;
?>
<!DOCTYPE html>
<html>

<head>

	<link href="../../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../../js/jquery.min.js"></script>
    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../../js/camera.min.js"></script>

<title>CUSTOM CLUSTERS</title>
</head>

	<body>

<div class="wrap">
<div class="wrapper">
<div class="logo">
	<a href="../Tprofile.php"><h1>Clusters</h1></a>
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


		<form  action="clusterFixed2.php" method="POST" style="margin-left:10%">
		<?php
			$value = 0;
			for($i = 1; $i<($cno); $i++, $value++)
			{?>
				Enter value (<=) for Cluster <?php echo $i?>  : <input type="text" name="<?=$value?>"><br>
				<?php
			}?>
				<div style="padding-left:40%">
	<br><br><input name='loginbtn' type='submit' class="btn btn_s" value='NEXT'>
</div>
		</form>

	</div>
	</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="../Tprofile.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>


	</body>

</html>