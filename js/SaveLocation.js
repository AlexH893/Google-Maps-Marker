function SaveLocation() { //USED FOR ADDING MARKERS TO CANVAS 
    var latlng = marker.getPosition();
    var url = 'phpsqlinfo_addrow.php?name=' + name + '&questTitle=' + 'default' + '&lat=' + latlng.lat() + '&lng=' + latlng.lng() + '&message=' + message;

    downloadUrl(url, function(data, responseCode) {

        if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
        }
    });
}