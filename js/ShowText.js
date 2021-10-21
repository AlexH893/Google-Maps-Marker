/*
 * Title: ShowText.js
 * Author: Alex Haefner
 * Date: 4 Sep 2021
 * Description: Displays a message to the user when a button is clicked.
*/

function showText() {
    document.getElementById("demo").innerHTML = "<p>FAQ <br><br>" +
        "How do I use this map?<br> <br>" +
        "<i>When you find a task with a good reward, locate the corresponding stop on the map (indicated by a google map marker) and use the dropdown menu to make the proper selection and click submit. Stops that you have visited or that aren't worth marking you can mark checked.</i> <br><br> Why doesn't this show all of the quests and rewards?<br><br>" +
        " <i>To speed up the process of submitting quests only rewards or quests that are worth hunting for are included in this map</i><br><br>" +

        "       Built with <br> HTML / JavaScript / AJAX / PHP / CSS / Coffee <br> " +

        "     <b>Resources<br></b> " +
        '    <i>Google Maps JavaScript API <br> ' +
        'Stack Overflow <br> ' +
        'PokemonGoHub.net <br> ' +
        'The Silph Road <br> ' +
        'Latlong.net <br> ' +
        'This fully crowdsourced map does not in any way utilize Pokemon Gos API or send/receive any data from Niantics game servers. <br> ' +
        'Currently only works for Oskaloosa, IA.' +
                '</i> <br>' ;
}