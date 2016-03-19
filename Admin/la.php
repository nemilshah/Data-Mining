<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN LOGIN</title>
	<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../js/jquery.min.js"></script>
    <script type='text/javascript' src="../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../js/camera.min.js"></script>

       	<style type="text/css">
		body {
	    	margin: 0;
		}
		#left {
		    width: 10%;
		    display: inline-block;
		}
	</style>
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
			<li class="active"><a href=""><span>Admin Login</span></a></li>
			<div class="clear"></div>
		 </ul>
	</div>
</div>
	<div class="clear"></div>
</div>
</div>
<div style="padding:30px" class="main_bg">

	<p style=" font-size:50px; color:rgb(164, 175, 32); margin-left:10%"> ADMIN LOG IN</h1><br><br>
	<form action= '' method = 'post' style="margin-left:10%" >
	<p><strong id="left"> Email-ID :</strong>	
	<input type='text' name='emailid' placeholder='Email-ID' value=
	'<?php 
	if(isset($_POST['emailid'])) 
	echo htmlspecialchars($_POST['emailid']);
	?>' 
	 /></p>
	</br></br>
	<p><strong id="left"> Password :</strong>
	<input type ='password' name='password' placeholder='PASSWORD' >
	</br></br>
	</p>
	<div style="padding-left:40%">
	<input name='loginbtn' type='submit' class="btn btn_s" value='LOG IN'>
</div>
	</form>
</div>

<div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href=""><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

<?php
$error="";
if(isset($_POST['emailid']) && isset($_POST['password'])){

 
$us= $_POST['emailid'];
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
		else
			{
				echo "Database connected successfully"."</br>";
			}
		
		$res = $con->query("select * from admin where email ='$us'");
		echo $us;
		if($res->num_rows==0)
		{
			echo "Invalid Username";
		}
		$emailid=$_POST['emailid'];
		$_SESSION['logged-in']=$emailid;

		while($row=$res->fetch_assoc())
		{	
			$p = $row['password'];
            $e = $row['email'];
			if(  $p==$_POST['password'])
			{
                	$_SESSION['username']=$row['name'];
				   echo '<script>window.location.assign("admin.php");</script>';
                
		}
			else
			{	
		$error.="Invalid Password";
				echo "<script>
alert(\"$error\"); 
</script>";
			}	
		
		}
		}
?> 

</body>
</html>