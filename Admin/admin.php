<html>
	<head>
		<title>ADMIN PAGE</title>
		<link href="../css/camera.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	    <script type='text/javascript' src="../js/jquery.min.js"></script>
	    <script type='text/javascript' src="../../js/jquery.easing.1.3.js"></script> 
	    <script type='text/javascript' src="../js/camera.min.js"></script>
	</head>
	<body>
		<div class="wrap">
			<div class="wrapper">
				<div class="logo">
	<a href=""><h1>Clusters</h1></a>
</div>
				<div class="header_right">
					<div class="cssmenu">
						<ul>
			<li class="active"><a href="">
		<?php
		
		echo "Hello Admin";
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
				<form>
					<input class="btn btn_s" type="submit" value="ENTER MARKS" onclick="javascript: form.action='Add/add.php';"/>
					<input class="btn btn_s" style="margin-left:21%" type="submit" value="DELETE MARKS" onclick="javascript: form.action='delete.php';"/>
					<input class="btn btn_s" style="margin-left:20%" type="submit" value="RUN CLUSTERING" onclick="javascript: form.action='Cluster/k-means.php';"/>
				</form>
			</div>

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
	</body>
</html>