<!---
 * Title: deleteMarker.php
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: Deletes a user-submitted marker after 30 minutes. This is because points of interest in
 * the game (such as Pokemon spawns) only last for 30 minutes.
 --->

 <?php
$con = mysqli_connect("localhost", "root", "lolirl1", "test");

// Deleting the marker where the date submitted at 30 minutes
$query = "DELETE FROM markers
WHERE date_submitted < NOW() - INTERVAL 30 MINUTE";

$result = mysqli_query($con, $query);
echo "Utility markers deleted successfully";
if (!$result) {
    echo "failed";
    die("Invalid query: " . mysqli_error($con));
}
?>