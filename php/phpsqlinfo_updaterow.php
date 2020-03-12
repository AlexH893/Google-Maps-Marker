<?php
require("phpsqlinfo_dbinfo.php");
include ("call.php");

// Gets data from URL parameters.
$id = $_GET['id'];
$questTitle = $_GET['questTitle'];
$questReward = $_GET['questReward'];
$category = $_GET['category'];
//$date_submitted = $_GET['date_submitted'];

// Sets the active MySQL database.
$db_selected = mysqli_select_db( $con, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Inserts new row with place data.
$query = (("UPDATE markers SET questTitle ='$questTitle', category='$category', questReward ='$questReward', date_submitted = CONVERT_TZ(CURTIME(), '-06:00', '+5:00')  WHERE id = '$id' "));
//$query = (("UPDATE markers SET date_submitted = now()"));
$result = mysqli_query($con,$query);

  if (!$result) {
	echo "failed";
  die('Invalid query: ' . mysqli_error($con));
}  
?>