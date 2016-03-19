<?php
	include ("connection.php");
	session_start();
	$subj = $_POST['subject'];
	$type = $_POST['type'];
	$sql = mysql_query("Select * from marks where Subject_ID = $subj and Type_ID = $type");
	$no_of_rows = mysql_num_rows($sql);
	$a = array(array());
	array_shift($a);
	while($row = mysql_fetch_assoc($sql))
	{
		$element = array();
	  	$element['UID']=$row['UID'];
		$element['Marks']=$row['Marks'];
	  	
	  	$a[] = $element;
	  	$b[] = $element;
	}
	

	function sortByMarks($x, $y)
	{
    	return $x['Marks'] - $y['Marks'];
	}
	usort($a, 'sortByMarks');

	$_SESSION['array_to'] = $a;
	$_SESSION['rows'] = $no_of_rows;

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
	<div style="padding:30px" class="main_bg">
		<form action="" method="POST" style="margin-left:10%">
			Enter No. of Clusters (<=4) : <input type="text" name="cno"><br><br>
			Do you want fixed centroids :


			<input class="btn btn_s" type="submit" name="submit" value="Yes" onclick="javascript: form.action='clusterFixed.php';"/>
			<input class="btn btn_s" type="submit" name="submit" value="No" onclick="javascript: form.action='cluster.php';"/>
		</form>
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