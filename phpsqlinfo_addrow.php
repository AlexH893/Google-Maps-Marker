<!---
 * Title: phpsqlinfo_addrow.php
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: PHP file that handles user submitted markers.
 --->

 <?php
require "phpsqlinfo_dbinfo.php";
include "connect.php";
// Gets data from URL parameters.
$name = $_GET["name"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];

$con = mysqli_connect("localhost", $username, $password);
if (!$con) {
    die("Not connected : " . mysqli_error());
}

// Sets the active MySQL database.
$db_selected = mysqli_select_db($con, $database);
if (!$db_selected) {
    die('Can\'t use db : ' . mysqli_error());
}

// Inserts new row with place data.
$query = sprintf(
    "INSERT INTO markers " .
        " (name, lat, lng) " .
        " VALUES ('%s', '%s', '%s');",
    mysqli_real_escape_string($con, $name),
    mysqli_real_escape_string($con, $lat),
    mysqli_real_escape_string($con, $lng)
);

$result = mysqli_query($con, $query);

if (!$result) {
    echo "failed";
    die("Invalid query: " . mysqli_error($con));
}

?>
=======
<?php
require("phpsqlinfo_dbinfo.php");
include("connect.php");
// Gets data from URL parameters.
$name = $_GET['name'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$category = $_GET['category'];
$date_submitted = $_GET['date_submitted'];

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
         "(name, lat, lng, category, date_submitted)" .
         " VALUES ('%s', '%s', '%s', '%s', '%s');",
         mysqli_real_escape_string($con, $name),
         mysqli_real_escape_string($con,$lat),
         mysqli_real_escape_string($con,$lng),
     mysqli_real_escape_string($con,$category),
     mysqli_real_escape_string($con, $date_submitted));

$result = mysqli_query($con,$query);

 if (!$result) {
  echo "failed";
  die('Invalid query: ' . mysqli_error($con));
} 

?>