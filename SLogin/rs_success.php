<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>REGISTRATION SUCCESSFUL</title>
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
	<a href="../index.html"><h1>Clusters</h1></a>
</div>
<div class="header_right">
	<div class="cssmenu">
		<ul>
		  	<li ><a href="../index.html"><span>Home</span></a></li>
			<li class="last"><a href="../Admin/la.php"><span>Admin Login</span></a></li>
			<div class="clear"></div>
		 </ul>
	</div>
</div>
	<div class="clear"></div>
</div>
</div>


<div style="padding:30px" class="main_bg">
	<p style=" font-size:50px; color:rgb(164, 175, 32); margin-left:10%">Registration Successful.</h1><br><br>
<form action="loginst.php">
<div style="padding-left:40%">
	<input name='loginbtn' type='submit' class="btn btn_s" value='LOG IN'>
</div>
</form>
</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="../index.html"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

</body>
</html>