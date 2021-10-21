/*
 * Title: MarkedChecked.js
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: Adding a checked state to a marker. This is handy when a user finds a location and
 * checks it for information but finds nothing of value, they can mark it as checked so other users 
 * know that it's been looked at.
*/

function markChecked() {
    // Debugging
    alert("test");
    // Setting the marker to checked
    var category = "Checked";
    var id = clickedMarker.id;
    var url = "phpsqlinfo_updaterow.php?questTitle=" + "" + "&category=" + "Checked" + "&questReward=" + "" + "&id=" + id;
    downloadUrl(url, function(data, responseCode) {

        if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
        }
    });
}