<?php
	include ("connection.php");
	session_start();
	$a = $_SESSION['array_to'];
	$no_of_rows = $_SESSION['rows'];
	$cno = $_SESSION['number'];

	$centroids = array();
	for($i=0;$i<($cno -1);$i++)
    {
    	array_push($centroids, $_POST[$i]);
    }

    $k = array(array());
	for ($i = 0; $i < $cno; $i++)
		$k[$i] = array(-1);
	for($i=0, $j=0, $l=0;$j<$no_of_rows;$j++)
	{
		if($i==$cno-1)
		{
			$k[$i][$l] = $a[$j];
			$l++;
		}
		else if($a[$j]['Marks']<=$centroids[$i])
		{
			$k[$i][$l] = $a[$j];
			$l++;
		}
		else if($a[$j]['Marks']>$centroids[$i])
		{
			$l=0;
			$i++;
			$j--;
		}
		//print_r($k);
		$k[$i][$l] = -1;
	}

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

<div style="margin-left:10%">
<?php


	
	echo ("<br>The Final Clusters By K-means are as follows : <br><br><br>");
	for ($i = 0; $i < $cno; $i++) 
	{
		echo ("Cluster ".($i + 1)."<br>");
		for ($j = 0; $j < $no_of_rows && $k[$i][$j] != -1; ++$j)
		{
			$id = $k[$i][$j]['UID'];
			$result = mysql_query("SELECT name FROM students WHERE UID = '$id'");
			while($row = mysql_fetch_assoc($result))
			{
				echo $row['name']."&nbsp&nbsp&nbsp&nbsp&nbsp";
			}
			
			echo ("  UID : " . $k[$i][$j]['UID'] . "&nbsp&nbsp&nbsp&nbsp&nbsp Marks : " . $k[$i][$j]['Marks'] . " ");
			echo("<br>");
		}
		echo "<br>";
	}
?>

	<div style="padding-left:40%">
	<input onclick="window.location.assign('../Tprofile.php')" name='loginbtn' type='submit' class="btn btn_s" value='FINISH'>
</div>
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