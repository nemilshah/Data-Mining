<?php session_start(); ?>
<html>
<head>

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

<title>TEACHER REGISTRATION</title>
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
<div class="clear"></div>


<div style="padding:30px" class="main_bg">
<form action= '' method = 'post' style="margin-left:10%" >


	<p style=" font-size:50px; color:rgb(164, 175, 32)">REGISTER</h1><br><br>
   
 	<p><strong id="left"> EID :</strong>
	<input type ='number' name='eid' id='eid' placeholder='EID'>
	</p>
	</br></br>

	<p><strong id="left"> Name :</strong>
	<input type ='text' name='name' id='name' placeholder='Name'>
	</p>
	</br></br>

	<p><strong id="left"> Branch :</strong>
	<input type ='text' name='branch' id='branch' placeholder='Branch'>
	</p>
	</br></br>


	<p><strong id="left"> Email-Id :</strong>
	<input type ='email' name='email' id='email' placeholder='Email'>
	</p>
	</br></br>

	<p><strong id="left"> Password :</strong>
	<input type ='password' name='password' id='password' placeholder='Password'>
	</p>
	</br></br>


		
	<div style="padding-left:40%">
	<input name='loginbtn' type='submit' class="btn btn_s" value='NEXT'>
</div>
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

<?php
if(isset($_POST['eid'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['email'])&&(isset($_POST['branch'])))
{
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


$email=$_POST['email'];
$name=$_POST['name'];
$password=$_POST['password'];
$id=$_POST['eid'];
$branch=$_POST['branch'];


$_SESSION['username']=$id;

$error="";
$valid=1;
if(empty($_POST["eid"]))
{
		$error.="EID required \\n";
		$valid=false;
}

if(empty($_POST["password"]))
{
		$error.="Password required \\n";
		$valid=false;
}


if(!preg_match('/^[A-z ]+$/',$name))
{
	$error.="invalid Name \\n";
	$valid=false;
}

if(empty($_POST["email"]))
{
		$error.="Email-Id required \\n";
		$valid=false;
}
if(empty($_POST["branch"]))
{
		$error.="Branch required \\n";
		$valid=false;
}

if($valid == 1) {

	$sql = 	"INSERT INTO teachers (EID,name,branch,email,password) VALUES ('$id','$name','$branch','$email','$password')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$res = $conn->query("select * from teachers");
		if($res->num_rows==0)
		{
			echo "Database is empty";
		}
			echo '<script>window.location.assign("rt_success.html");</script>';
	}
		else {
	echo "<script>alert(\"$error\");</script>";
}
$conn->close();
}

/*}*/

?>
</body>
</html>