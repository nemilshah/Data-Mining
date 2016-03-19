<?php
	include ("../cluster/connection.php");
	session_start();
	$sql = mysql_query("Select * from students");
	$no_of_rows = mysql_num_rows($sql);
	$a = array(array());
	array_shift($a);
	while($row = mysql_fetch_assoc($sql))
	{
		$element = array();
	  	$element['name']=$row['name'];
		$element['ftotal']=$row['final_total'];
	  	$a[] = $element;
	}
	

	function sortByMarks($x, $y)
	{
    	return $x['ftotal'] - $y['ftotal'];
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

<title>PROFILE CLUSTERS</title>
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
			Enter No. of Clusters : <input type="text" name="cno"><br><br>
			<div style="padding-left:40%">
			<input name='loginbtn' type='submit' class="btn btn_s" value='SUBMIT'>
</div>
		</form>
	</div>


<?php
if(isset($_POST['cno'])) 
{
	$a = $_SESSION['array_to'];
	$no_of_rows = $_SESSION['rows'];
	
	$cno = $_POST['cno'];
	

	$k = array(array());
	$tempk = array(array());
	$m = array();
	$diff = array();
	$count1 = 0;
	$count2 = 0;
	$count3 = 0;

	function cal_diff($element) //This method will determine the cluster in which an element go at a particular step
	{
		global $cno, $diff, $m;
		for ($i = 0; $i < $cno; $i++) 
		{
			if ($element > $m[$i])
				$diff[$i] = $element - $m[$i];
			else
				$diff[$i] = $m[$i] - $element;
		}
		$val = 0;
		$temporary = $diff[0];
		for ($i = 0; $i < $cno; $i++) 
		{
			if ($diff[$i] < $temporary) 
			{
				$temporary = $diff[$i];
				$val = $i;
			}
		}
		return $val;
	}

	function cal_mean() // This method will determine intermediate mean values
	{
		global $cno, $k, $m, $no_of_rows;
		for ($i = 0; $i < $cno; $i++)
			$m[$i] = 0; // initializing means to 0
		$cnt = 0;
		for ($i = 0; $i < $cno; $i++) 
		{
			$cnt = 0;
			$j = 0;
			while ( $k[$i][$j] != -1)
			{
					$m[$i] += $k[$i][$j]['ftotal'];
					++$cnt;
					++$j;
			}
			$m[$i] = $m[$i] / $cnt;
		}
	}

	function check1() // This checks if previous k ie. tempk and current k are same. Used as terminating case.
	{
		global$cno, $no_of_rows, $tempk, $k;
		for ($i = 0; $i < $cno; $i++)
		{
			$j = 0;	
			while ( $k[$i][$j] != -1 &&$j<$cno)
			{
				if ($tempk[$i][$j] != $k[$i][$j]) 
				{
					return 0;
				}
				$j++;
			}
		}
		return 1;
	}

	//echo "<br>No<br>";
	
	for($i=0,$j=0;$i<$cno;$i++,$j++)
	{
		if($a[$j]['ftotal']!=$a[$j+1]['ftotal'])
			$m[$i] = $a[$j]['ftotal'];
		else
			$i--;
	}
/*
	for($i=0;$i<$cno;$i++)
		$m[$i] = $a[$i]['ftotal'];*/
	//print_r($m);
	$temp = 0;
	$flag = 0;

	for ($i = 0; $i < $cno; $i++)
			$tempk[$i] = array(-1,-1);
		//print_r($tempk);
	do
	{
		for ($i = 0; $i < $cno; $i++)
			$k[$i] = array(-1);
		for ($i = 0; $i < $no_of_rows; ++$i) 
		{
			$temp = cal_diff($a[$i]['ftotal']);
			//echo $temp;
			if ($temp == 0)
			{
				$k[$temp][$count1++] = $a[$i];
			}
			else if ($temp == 1)
			{	
				$k[$temp][$count2++] = $a[$i];
			}
			else if ($temp == 2)
			{
				$k[$temp][$count3++] =$a[$i];
			}
		}
		$k[0][$count1] = -1;
		$k[1][$count2] = -1;
		$k[2][$count3] = -1;

		//print_r($k);
		cal_mean();
		//print_r($m);
		$flag=check1();
		//echo "<br>".$flag."<br>";

		if ($flag != 1) //Take backup of k in tempk so that you can check for equivalence in next step
			for ($i = 0; $i < $cno; $i++)
			{
				$j = 0;
				while ( $k[$i][$j] != -1)
				{
					$tempk[$i][$j] = $k[$i][$j];
					$j++;
				}
			}
			$count1 = 0;
			$count2 = 0;
			$count3 = 0;
	}while ($flag == 0);



	echo ("<br>The Final Clusters By K-means are as follows : <br><br><br>");
	for ($i = 0; $i < $cno; $i++) 
	{
		echo ("Cluster ".($i + 1)."<br>");
		for ($j = 0; $j < $no_of_rows && $k[$i][$j] != -1; ++$j)
		{

			echo ("  Name : " . $k[$i][$j]['name'] . "&nbsp&nbsp&nbsp&nbsp&nbsp Skills : " . $k[$i][$j]['ftotal'] . " ");
			echo("<br>");
		}
		echo "<br>";
	}
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