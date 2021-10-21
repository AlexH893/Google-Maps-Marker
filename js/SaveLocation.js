/*
 * Title: SaveLocation.js
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: This is more of an administrative function that allows a site admin to manually add
 * a marker permanantly to the map wherever they click.
*/

function SaveLocation() { //USED FOR ADDING MARKERS TO CANVAS 
    var latlng = marker.getPosition();
    var url = 'phpsqlinfo_addrow.php?name=' + name + '&questTitle=' + 'default' + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();

    downloadUrl(url, function(data, responseCode) {

        if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
        }
    });
}