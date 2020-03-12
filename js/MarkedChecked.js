function markChecked() {
    alert("test");
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