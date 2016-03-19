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
		    width: 25%;
		    display: inline-block;
		}
	</style>

<title>REGISTER STUDENT</title>
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
   

   	<p><strong style="padding-left:10%; font-weight:bold"> Please fill ALL details correctly. </strong></br></br>
</br> 	<p><strong id="left"> UID :</strong>
	<input type ='number' name='uid' id='uid' placeholder='UID'>
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

	<p><strong id="left"> Current Semester (1-8) :</strong>
	<input type ='text' name='curr_sem' id='curr_sem' placeholder='Current Semester' min='1' max='8'>
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

    <p><strong id="left"> SSC :</strong>
	<input type ='number' name='ssc' id='ssc' placeholder='SSC' min='0' max='100'>
	</p>
	</br></br>

	<p><strong id="left"> HSC :</strong>
	<input type ='number' name='hsc' placeholder='HSC' min='0' max='100'>
	</strong></p>
	</br></br>

	<p><strong id="left"> CET :</strong>
	<input type ='number' name='cet' placeholder='CET'min='0' max='200'>
	</strong></p>
	</br></br>

	<p><strong id="left"> Vocational Subject in 12th :</strong>
	<select name='voc_subj' value='none' selected='selected'>
	
  <option value="CS" <?php if(isset($_POST['voc_subj'])&&$_POST['voc_subj'] == 'CS') { ?> selected <?php } ?>>CS</option>
  <option value="IT"<?php if(isset($_POST['voc_subj'])&&$_POST['voc_subj'] == 'IT') { ?> selected <?php } ?>>IT</option>
  <option value="EM"<?php if(isset($_POST['voc_subj'])&&$_POST['voc_subj'] == 'EM') { ?> selected <?php } ?>>EM</option>
  <option value="ETRX"<?php if(isset($_POST['voc_subj'])&&$_POST['voc_subj'] == 'ETRX') { ?> selected <?php } ?>>ETRX</option>
  <option value="Other"<?php if(isset($_POST['voc_subj'])&&$_POST['voc_subj'] == 'Other') { ?> selected <?php } ?>>Other</option>
	</select></strong></p>
	</br></br></br>

	<p><strong style="padding-left:10%; font-weight:bold"> Rate skill set from 1-10. </strong>
	</br></br></br>

	<p><strong id="left"> Web Technologies :</strong>
	<input type ='number' name='wt' min='0' max='10'>
	</strong></p>
	</br></br>

	<p><strong id="left"> C Language :</strong>
	<input type ='number' name='c' min='0' max='10'>
	</strong></p>
	</br></br>

	<p><strong id="left"> C++ Language :</strong>
	<input type ='number' name='cpp' min='0' max='10'>
	</strong></p>
	</br></br>

	<p><strong id="left"> JAVA :</strong>
	<input type ='number' name='java' min='0' max='10'>
	</strong></p>
	</br></br>

	<p><strong id="left"> Python language :</strong>
	<input type ='number' name='python' min='0' max='10'>
	</strong></p>
	</br></br>

	<p><strong id="left"> MySQL :</strong>
	<input type ='number' name='mysql' min='0' max='10'>
	</strong></p>
	</br></br></br>

		
	<div style="">
	<input name='loginbtn' type='submit' class="btn btn_s" value='REGISTER '>
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
if(isset($_POST['uid'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['ssc'])&&isset($_POST['hsc'])&&isset($_POST['cet'])&&isset($_POST['c'])&&isset($_POST['cpp'])&&isset($_POST['java'])&&isset($_POST['wt'])&&isset($_POST['python'])&&isset($_POST['voc_subj'])&&isset($_POST['mysql'])&&isset($_POST['curr_sem'])&&(isset($_POST['branch'])))
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
$id=$_POST['uid'];
$branch=$_POST['branch'];
$curr_sem=$_POST['curr_sem'];
$prev_sem = $curr_sem-1;

$_SESSION['username']=$id;

$ssc1=$_POST['ssc'];
$hsc1=$_POST['hsc'];
$cet1=$_POST['cet'];
$c=$_POST['c'];
$cpp=$_POST['cpp'];
$java=$_POST['java'];
$wt=$_POST['wt'];
$python=$_POST['python'];
$mysql=$_POST['mysql'];
$tp=$_POST['voc_subj'];
echo $tp;
$ssc=$ssc1/10;
$hsc=$hsc1/10;
$cet=$cet1/20;
if($tp=='CS')
{
	$voc_subj=10;
}
else if($tp=='IT')
{
	$voc_subj=9;
}
else if($tp=='EM')
{
	$voc_subj=3;
}

else if($tp=='ETRX')
{
	$voc_subj=4;
}
else if($tp=='Other')
{
	$voc_subj=0;
}

$error="";
$valid=1;
if(empty($_POST["uid"]))
{
		$error.="UID field required \\n";
		$valid=false;
}
if(!preg_match('/^[A-z ]+$/',$name))
{
	$error.="invalid Name \\n";
	$valid=false;
}
if(empty($_POST["password"]))
{
		$error.="Password required \\n";
		$valid=false;
}
if(empty($_POST["email"]))
{
		$error.="E-mail required \\n";
		$valid=false;
}
if(empty($_POST["ssc"]))
{
		$error.="SSC field required \\n";
		$valid=false;
}
if(empty($_POST["hsc"]))
{
		$error.="HSC field required \\n";
		$valid=false;
}
if(empty($_POST["cet"]))
{
		$error.="CET field required \\n";
		$valid=false;
}
if(empty($_POST["c"]))
{
		$error.="C field required \\n";
		$valid=false;
}
if(empty($_POST["cpp"]))
{
		$error.="CPP field required \\n";
		$valid=false;
}
if(empty($_POST["java"]))
{
		$error.="JAVA field required \\n";
		$valid=false;
}
if(empty($_POST["wt"]))
{
		$error.="WT field required \\n";
		$valid=false;
}
if(empty($_POST["python"]))
{
		$error.="Python field required \\n";
		$valid=false;
}
if(empty($_POST["voc_subj"]))
{
		$error.="Vocational Subject field required \\n";
		$valid=false;
}
if(empty($_POST["mysql"]))
{
		$error.="MySQL field required \\n";
		$valid=false;
}
if(empty($_POST["curr_sem"]))
{
		$error.="Current Semester required \\n";
		$valid=false;
}
if(empty($_POST["branch"]))
{
		$error.="Branch required \\n";
		$valid=false;
}


if($valid == 1) {
	$total= ($wt+$c+$cpp+$java+$python+$mysql)/6;
	$ftotal= ($ssc+$hsc+$cet+$total+$voc_subj)/5;
	$attempts=-1;
	$grit=-1;
	echo $total;
	echo $ftotal;
	echo $name;
	echo $password;
	echo $email;
	$sql = 	"INSERT INTO students (UID,name,branch,curr_sem,email,password,ssc,hsc,cet,voc_subj,wt,c,cpp,java,python,mysql,skills_total,apptitude,grit,final_total,prev_sem) VALUES ('$id','$name','$branch','$curr_sem','$email','$password','$ssc','$hsc','$cet','$voc_subj','$wt','$c','$cpp','$java','$python','$mysql','$total','$attempts','$grit','$ftotal','$prev_sem')";
	

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$res = $conn->query("select * from students");
		if($res->num_rows==0)
		{
			echo "Database is empty";
		}	
			echo '<script>window.location.assign("rs_success.php");</script>';
	}
		else {
	echo "<script>alert(\"$error\");</script>";
}
$conn->close();
}


?>
</body>
</html>