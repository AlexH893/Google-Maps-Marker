<?php
$con = mysqli_connect("localhost", "root", "lolirl1", "test");

$query= "DELETE FROM markers
WHERE date_submitted < NOW() - INTERVAL 30 MINUTE";

$result = mysqli_query($con,$query);
    echo "Utility markers deleted successfully";
 if (!$result) {
	echo "failed";
  die('Invalid query: ' . mysqli_error($con));
} 

?>