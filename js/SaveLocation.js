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
function SaveLocation() {
    var today = new Date();

    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var date_submitted = date + ' ' + time;
    var latlng = marker.getPosition();
    messageInput = document.getElementById('messageInput').value; //taking value from input box
    alert(messageInput);
    var category = "Utility";
    var infoWindow;
    var url = 'phpsqlinfo_addrow.php?name=' + messageInput + '&questTitle=' + 'default' + "&category=" + "Utility" + '&lat=' + latlng.lat() + '&lng=' + latlng.lng() + '&date_submitted=' + date_submitted;


    downloadUrl(url, function(data, responseCode) {

        if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
        }
    });
}