<!---
 * Title: DeleteCommand.php
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: Deletes all markers from database and then re-adds them. This is done to clear 
 * data if issues arise or a clean wipe is needed.
 --->

 <?php
$con = mysqli_connect("localhost", "root", "lolirl1", "test");

// sql to delete a record
$query = "DELETE FROM markers";
// use exec() because no results are returned
//    $con->exec($query);

$result = mysqli_query($con, $query);
echo "Marker deleted successfully";
if (!$result) {
    echo "failed";
    die("Invalid query: " . mysqli_error($con));
}
<?php 
$con = mysqli_connect("localhost", "root", "lolirl1", "test");

    // sql to delete a record
    $query = "DELETE FROM markers";
	    // use exec() because no results are returned
//    $con->exec($query);

$result = mysqli_query($con,$query);
    echo "Marker deleted successfully";
 if (!$result) {
	echo "failed";
  die('Invalid query: ' . mysqli_error($con));
} 

$query2 = "INSERT INTO `markers` (`name`, `lat`, `lng`, `id`, `questTitle`, `questReward`, `category`, `date_submitted`) VALUES
('Mahaska County Veteran Memorial', 41.2952, -92.644, 1, NULL, NULL, NULL, NULL),
('Mahaska County Courthouse', 41.2951, -92.6437, 2, NULL, NULL, NULL, NULL),
('Centennial Block', 41.2954, -92.6444, 3, NULL, NULL, NULL, NULL),
('Iowa Bank Building', 41.2954, -92.6452, 4, NULL, NULL, NULL, NULL),
('Frankel Block', 41.295, -92.6452, 5, NULL, NULL, NULL, NULL),
('Oskaloosa Public Library', 41.2934, -92.6453, 6, NULL, NULL, NULL, NULL),
('Wall Painting', 41.2942, -92.6454, 7, NULL, NULL, NULL, NULL),
('Oskaloosa Fire Department', 41.2936, -92.6444, 12, NULL, NULL, NULL, NULL),
('Elk\'s Lodge 340', 41.2934, -92.6437, 11, NULL, NULL, NULL, NULL),
('Oskaloosa Municipal Band Mural', 41.2943, -92.644, 13, NULL, NULL, NULL, NULL),
('Oskaloosa\'s Original Jail', 41.2952, -92.6428, 14, NULL, NULL, NULL, NULL),
('Saint Mary\'s Church', 41.2945, -92.6417, 15, NULL, NULL, NULL, NULL),
('First Presbyterian Church', 41.2955, -92.641, 16, NULL, NULL, NULL, NULL),
('United Church of Christ', 41.2955, -92.6401, 17, NULL, NULL, NULL, NULL),
('First Baptist Church', 41.2937, -92.6416, 18, NULL, NULL, NULL, NULL),
('First Pentecostal Church', 41.2934, -92.6406, 19, NULL, NULL, NULL, NULL),
('Central Reformed Church', 41.2938, -92.636, 20, NULL, NULL, NULL, NULL),
('Omega Church', 41.2945, -92.6297, 21, NULL, NULL, NULL, NULL),
('Wall Of Oskaloosa History', 41.2949, -92.6481, 33, NULL, NULL, NULL, NULL),
('Central United Methodist', 41.2964, -92.6453, 34, NULL, NULL, NULL, NULL),
('First Christian Church', 41.2964, -92.644, 35, NULL, NULL, NULL, NULL),
('Oskaloosa Community Stadium', 41.3008, -92.6437, 36, NULL, NULL, NULL, NULL),
('Mahaska County YMCA', 41.2988, -92.6412, 37, NULL, NULL, NULL, NULL),
('Oskaloosa Water Tower', 41.3012, -92.6497, 38, NULL, NULL, NULL, NULL),
('College Avenue Friends Church', 41.3034, -92.6485, 39, NULL, NULL, NULL, NULL),
('McGrew Fine Arts Center', 41.3082, -92.6449, 40, NULL, NULL, NULL, NULL),
('McGrew Fine Arts Statue', 41.3089, -92.6453, 41, NULL, NULL, NULL, NULL),
('William Penn University Gateway', 41.3079, -92.6458, 42, NULL, NULL, NULL, NULL),
('Wilcox Library Motto', 41.3076, -92.6472, 43, NULL, NULL, NULL, NULL),
('Sundial Penn Hall', 41.3086, -92.6474, 44, NULL, NULL, NULL, NULL),
('Lewis Hall', 41.3088, -92.6462, 45, NULL, NULL, NULL, NULL),
('H.L. Spencer Quote', 41.3084, -92.6463, 46, NULL, NULL, NULL, NULL),
('William Penn Statemen Baseball Field', 41.3079, -92.6487, 47, NULL, NULL, NULL, NULL),
('George Daily', 41.3091, -92.6393, 48, NULL, NULL, NULL, NULL),
('Ferrel Vault', 41.3036, -92.6358, 49, NULL, NULL, NULL, NULL),
('Veteran\'s Memorial Of Mahaska County', 41.3051, -92.6326, 50, NULL, NULL, NULL, NULL),
('Beacon Post Office', 41.2762, -92.6816, 51, NULL, NULL, NULL, NULL),
('Beacon City Hall', 41.2777, -92.6816, 52, NULL, NULL, NULL, NULL),
('Gateway Church Of The Nazarene', 41.2952, -92.6684, 53, NULL, NULL, NULL, NULL),
('The Frosty Udder', 41.2976, -92.6659, 54, NULL, NULL, NULL, NULL),
('Bethel Baptist Church', 41.2965, -92.6615, 55, NULL, NULL, NULL, NULL),
('Mahaska Community Recreation', 41.3111, -92.6684, 56, NULL, NULL, NULL, NULL),
('Lacey Recreation Complex', 41.3098, -92.6681, 57, NULL, NULL, NULL, NULL),
('Judy Phillips Memorial Bench', 41.3012, -92.6596, 62, NULL, NULL, NULL, NULL),
('Robert N.E. Davis Shelter', 41.3033, -92.6663, 61, NULL, NULL, NULL, NULL),
('Church of Jesus Christ LDS', 41.3024, -92.6648, 60, NULL, NULL, NULL, NULL),
('Richard Sammons Memorial Bench', 41.3011, -92.6598, 63, NULL, NULL, NULL, NULL),
('Fellowship Bible Church', 41.296, -92.6561, 64, NULL, NULL, NULL, NULL),
('Edmundson Park Entrance', 41.2852, -92.6598, 65, NULL, NULL, NULL, NULL),
('Fort Oskaloosa', 41.2842, -92.6596, 66, NULL, NULL, NULL, NULL),
('Edmundson', 41.2841, -92.6597, 67, NULL, NULL, NULL, NULL),
('WPA Shelter Structure', 41.2829, -92.6577, 68, NULL, NULL, NULL, NULL),
('Osky Pool', 41.2823, -92.6541, 69, NULL, NULL, NULL, NULL),
('The Morgan Cabin', 41.2847, -92.6527, 70, NULL, NULL, NULL, NULL),
('Kingdom Hall', 41.2801, -92.6442, 71, NULL, NULL, NULL, NULL),
('The Evangelical Church', 41.2819, -92.646, 72, NULL, NULL, NULL, NULL),
('Oskaloosa Golf Course', 41.2751, -92.6316, 73, NULL, NULL, NULL, NULL),
('Good News Chapel', 41.2905, -92.6547, 74, NULL, NULL, NULL, NULL),
('Jubilee Family Church', 41.2925, -92.6499, 75, NULL, NULL, NULL, NULL),
('Oskaloosa Post Office', 41.2904, -92.6443, 76, NULL, NULL, NULL, NULL),
('Peanut Pub', 41.2893, -92.6433, 77, NULL, NULL, NULL, NULL),
('Old Rock Island Railroad Caboose', 41.2893, -92.6431, 78, NULL, NULL, NULL, NULL),
('Free Methodist Church', 41.2881, -92.6352, 79, NULL, NULL, NULL, NULL),
('Cavalry Bible Church', 41.2829, -92.632, 80, NULL, NULL, NULL, NULL),
('Grace Evangelical Lutheran Church', 41.2864, -92.6244, 81, NULL, NULL, NULL, NULL),
('Park Church Of Christ', 41.285, -92.6232, 82, NULL, NULL, NULL, NULL),
('Oskaloosa Baptist Chapel', 41.2868, -92.6224, 83, NULL, NULL, NULL, NULL),
('University Park Post Office', 41.2865, -92.6186, 84, NULL, NULL, NULL, NULL),
('Spinnin\' Wheels Skating Rink', 41.2946, -92.6253, 85, NULL, NULL, NULL, NULL),
('St. John Lutheran Church', 41.3159, -92.6374, 86, NULL, NULL, NULL, NULL),
('Community of Christ', 41.2983, -92.6377, 87, NULL, NULL, NULL, NULL),
('Kirkville Post Office', 41.1453, -92.5038, 88, '', NULL, NULL, NULL),
('Cedar United Methodist Church', 41.2122, -92.5256, 89, NULL, NULL, NULL, NULL),
('Cedar Post Office', 41.2128, -92.5246, 90, NULL, NULL, NULL, NULL)";

$result2 = mysqli_query($con, $query2);
echo "DB populated successfully";
if (!$result2) {
    echo "failed";
    die("Invalid query: " . mysqli_error($con));
}
?>
=======
 
$result2 = mysqli_query($con,$query2);
   echo "DB populated successfully";
 if (!$result2) {
	echo "failed";
  die('Invalid query: ' . mysqli_error($con));
} 
?>
