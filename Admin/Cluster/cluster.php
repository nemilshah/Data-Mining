<?php
	include ("connection.php");
	session_start();
	$subject = $_SESSION['subj'];
	$sql = mysql_query("Select * from marks where Type_ID = '100004' and Subject_ID = '$subject' ");
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

	$cno = 3;

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
					$m[$i] += $k[$i][$j]['Marks'];
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
			while ( $k[$i][$j] != -1 &&$j<=$i)
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
		if($a[$j]['Marks']!=$a[$j+1]['Marks'])
			$m[$i] = $a[$j]['Marks'];
		else
			$i--;
	}
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
			$temp = cal_diff($a[$i]['Marks']);
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
?>
<!DOCTYPE html>
<html>

<head>

	<link href="../../css/camera.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type='text/javascript' src="../../js/jquery.min.js"></script>
    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
    <script type='text/javascript' src="../../js/camera.min.js"></script>

<title>CLUSTER STUDENTS</title>
</head>

	<body>

<div class="wrap">
<div class="wrapper">
<div class="logo">
	<a href="../admin.php"><h1>Clusters</h1></a>
</div>
				<div class="header_right">
					<div class="cssmenu">
						<ul>
			<li class="active"><a href="">
		<?php
		
		echo "Hello Admin";
		?></a></li>
			<li class="last"><a href="../../logout.php"><span>Logout</span></a></li>
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
			$row = mysql_fetch_assoc($result);
			
				$name = $row['name'];
				if($i==0)
				{
					$sql = mysql_query("UPDATE students SET prev_cluster='Below Average' WHERE UID='$id'");
				}
				elseif ($i==1)
				{
					$sql = mysql_query("UPDATE students SET prev_cluster='Average' WHERE UID='$id'");	
				}
				elseif ($i==2)
				{
					$sql = mysql_query("UPDATE students SET prev_cluster='Above Average' WHERE UID='$id'");
				}
				echo $row['name']."&nbsp&nbsp&nbsp&nbsp&nbsp";
			
			
			echo ("  UID : " . $k[$i][$j]['UID'] . "&nbsp&nbsp&nbsp&nbsp&nbsp Marks : " . $k[$i][$j]['Marks'] . " ");
			echo("<br>");
		}
		echo "<br>";
	}

?>
<div style="padding-left:40%">
	<input onclick="window.location.assign('../admin.php')" name='loginbtn' type='submit' class="btn btn_s" value='FINISH'>
</div>
</div>
</div>

 <div class="wrap">
<div class="wrapper">
	<div class="footer">

		<a href="../admin.php"><h2>Clusters</h2></a>
		<div class="copy">
			<p class="w3-link">© 2015 Clusters. All Rights Reserved. </p>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

</body>
</html>