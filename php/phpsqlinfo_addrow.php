<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters.
$name = $_GET['name'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];


// Opens a connection to a MySQL server.
$con=mysqli_connect ("localhost", $username, $password);
if (!$con) {
  die('Not connected : ' . mysqli_error());
}

// Sets the active MySQL database.
$db_selected = mysqli_select_db( $con, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Inserts new row with place data.
$query = sprintf("INSERT INTO markers " .
         " (name, lat, lng) " .
         " VALUES ('%s', '%s', '%s');",
         mysqli_real_escape_string($con, $name),
         mysqli_real_escape_string($con,$lat),
         mysqli_real_escape_string($con,$lng));

$result = mysqli_query($con,$query);

 if (!$result) {
	echo "failed";
  die('Invalid query: ' . mysqli_error($con));
} 

?>