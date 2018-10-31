<?php
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
include('connect.php');
$query = "SELECT * FROM markers WHERE 1";
$result = mysqli_query($con, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($con));
}
// Iterate through the rows, adding XML nodes for each
while ($row = mysqli_fetch_assoc($result)){
	global $dom, $node, $parnode;
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("id",$row['id']);
  $newnode->setAttribute("questTitle",$row['questTitle']);
  $newnode->setAttribute("questReward",$row['questReward']);
  $newnode->setAttribute("category",$row['category']);
  $newnode->setAttribute("date_submitted",$row['date_submitted']);
}
header("Content-type: text/xml");
echo $dom->saveXML();
?>