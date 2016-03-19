<?php
require_once("dbcontroller.php");
session_start();
$db_handle = new DBController();
if(!empty($_POST["semester"] || $_POST["branch"])) {
	$semester = $_POST["semester"];
	$branch = $_POST["branch"];
	$query ="SELECT * FROM subject WHERE Semester_ID = $semester AND Branch_ID = $branch" ;
	$results = $db_handle->runQuery($query);
?>
	<option value="">Select Subject</option>
<?php
	foreach($results as $subject) {
?>
	<option name="subject" value="<?php echo $subject["Subject_ID"]; ?>"><?php echo $subject["Subject_Name"]; ?></option>
<?php
	}
}
?>