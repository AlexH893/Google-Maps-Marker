<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Osky PokeStop Map</title>
    <style>
        /* Set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/CenterMap.js"></script>
    <script type="text/javascript" src="js/SaveData.js"></script>
    <script type="text/javascript" src="js/MarkedChecked.js"></script>
    <script type="text/javascript" src="js/QuestLogic.js"></script>
    <script type="text/javascript" src="js/ShowText.js"></script>
    <script type="text/javascript" src="js/AddMarker.js"></script>
    <script type="text/javascript" src="js/SaveLocation.js"></script>
     <script type="text/javascript" src="js/DownloadUrl.js"></script>
  

</head>

<body>
    <?php include 'date.php';  ?>
    <br> Latest update 3/13/2020 - Backend changes, code refactoring/modularizing, re-added utility marker function

    <div id="map" height="460px" width="100%"></div>
    <div id="form2">
        <table>
            <!-- Form for adding a message in a custom marker -->
            <label id="name" style="color: #0026ff"></label>
            <tr>
                <input type = "text" id= "messageInput" placeholder="Enter marker message"><input type='button' value='Save' onclick='SaveLocation()'/>         
            </tr>
        </table>
    <p>Use the utility marker feature to temporarily and accurately <br> pinpoint Pokemon spawn, a point of interest, or other location.</p>
    </div>


    <div id="map-canvas"></div>
    <script>
        addedMarker = 0;

        $(document).ready(function() {
            $("#button2").click("slow", function(event) {
            });
        });

        /** Custom labels that appear on the marker
        *   Used to indicate the reward quickly at a glance
        */
        document.getElementById("name").style.display = 'none';
        var customLabel = {
            Chansey: {
                label: 'C'
            },
            Machop: {
                label: 'M'
            },
            Dratini: {
                label: 'D'
            },
            Berry: {
                label: 'B'
            },
            Feebas: {
                label: 'F'
            },
            Larvitar: {
                label: 'L'
            },
            Candy: {
                label: 'RC'
            },
            Potion: {
                label: 'P'
            },
            Revive: {
                label: 'R'
            },
            Stardust: {
                label: 'SD'
            },
            Balls: {
                label: 'UB'
            },
            Checked: {
                label: '✔'
            },
            Halloween: {
                label: 'HW'
            }
        };
        var marker;
        var infowindow;
        var infowindow2;
        var clickedMarker;
        var hasQuest = false; // Flag to identify which stops have a quest set, default=false
        var oskaloosa = {
            lat: 41.2954,
            lng: -92.6444
        };

        function initMap() 
        {

            var styledMapType = new google.maps.StyledMapType(
                [{
                        "featureType": "poi",
                        "elementType": "labels.text",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "poi.business",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "transit",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }
                ], {
                    name: 'Styled Map'
                });

            var myCenter = new google.maps.LatLng(41.294798, -92.644675);
            // Create a map object, and include the MapTypeId to add
            // to the map type control

            var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 41.294798,
                        lng: -92.644675
                    },
                    zoom: 18,
                    streetViewControl: false,
                    mapTypeControlOptions: {
                        gestureHandling: 'greedy', // Set to cooperative by default once menus are built	  
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                        mapTypeIds: ['roadmap', 'terrain']
                    }
                }
            );

            // Create the DIV to hold the control and call the CenterControl()
            // constructor passing in this DIV.
            var centerControlDiv = document.createElement('div');
            var centerControl = new CenterControl(centerControlDiv, map);

            centerControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

            // Control for button to toggle marker adding
            var AddMarkerControlDiv = document.createElement('div');
            var addControl = new AddMarker(AddMarkerControlDiv, map);

            AddMarkerControlDiv.index = 2;
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(AddMarkerControlDiv);



            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

            infowindow = new google.maps.InfoWindow({
                content: document.getElementById('form')
            });

            messagewindow = new google.maps.InfoWindow({
                content: document.getElementById('message')
            });


            // Loading in markers from DB via call.php
            downloadUrl('call.php', function(data) {

                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var name = markerElem.getAttribute('name'); // Name of marker		  
                    document.getElementById("name").innerHTML = name;
                    var questTitle = markerElem.getAttribute('questTitle'); // Quest of marker
                    var questReward = markerElem.getAttribute('questReward'); // Reward of marker			  
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));
                    var id = markerElem.getAttribute('id');
                    var category = markerElem.getAttribute('category');
                    var date_updated = markerElem.getAttribute('date_updated'); //this is for pokestop markers

                    var date_submitted = markerElem.getAttribute('date_submitted');
                   

                    var content = '<b>' + name + '</b><br>' + "Time submitted: " + date_submitted + " " + '<br>' + "Current quest:" + " " + '<label id="questTitle">' + questTitle + '</label>' + '<br>' + "Current Reward: " + '<label id="rewardTitle">' + '<b>' + questReward + '</b>' + '<br>' + '<select id="questType" onchange="questLogic()" style="width:100%;max-width:90%;">' +
                        '<option value="null">Select quest</option>' + '<br>' +
                        '<option value="HWpooch">Halloween: Catch 5 Poochyena or Houndour</option>' +
                        '<option value="HWdark">Halloween: Catch 5 Dark-type Pokémon</option>' +
                        '<option value="HWghost">Halloween: Catch 10 Ghost-type Pokémon</option>' +
                        '<option value="HWdusk">Halloween: Evolve 3 Duskull or Shuppet</option>' +
                        '<option value="HWxfer">Halloween: Transfer 10 Pokémon	</option>' +
                        '<option value="battle1x">Battle in a gym 1 time</option>' +
                        '<option value="battle5x">Battle in a gym 5 times</option>' +
                        '<option value="questDratini">Catch a Dragon</option>' +
                        '<option value="questDratini3">Catch 3 Dragon type</option>' +
                        '<option value="catch10">Catch 10 Pokémon</option>' +
                        '<option value="catchDitto">Catch a Ditto</option>' +
                        '<option value="catch3medley">Catch 3 [Oddish/Bellsprout][Swablu][Pidgey/Murkrow]</option>' +
                        '<option value="catch10weather">Catch 10 Pokemon with weather boost</option>' +
                        '<option value="questDratini2">Evolve 10 Water</option>' +
                        '<option value="questHatch3">Hatch 3 eggs</option>' +
                        '<option value="questChansey">Hatch 5 eggs</option>' +
                        '<option value="greatCurve">Make a Great Curveball Throw</option>' +
                        '<option value="greatCurve3x">Make 3 Great Curveball Throws in a row</option>' +
                        '<option value="excellent3x">Make 3 Excellent Throws in a row</option>' +
                        '<option value="great5">Make 5 Great Throws</option>' +
                        '<option value="great3row">Make 3 Great Throws in a row</option>' +
                        '<option value="great3curve">Make 3 Great Curveball Throws</option>' +
                        '<option value="great3curverow">Make 3 Great Curveball Throws in a row</option>' +
                        '<option value="curve5x">Make 5 Curveball Throws in a row</option>' +
                        '<option value="trade1">Trade 1 Pokemon</option>' +
                        '<option value="use1super">Use a supereffective Charged Attack in a Gym battle</option>' +
                        '<option value="use7super">Use a supereffective Charged Attack in 7 Gym battles</option>' +
                        '<option value="berry5">Use 5 Berries to help catch Pokémon</option>' +
                        '<option value="win1">Win a gym battle</option>' +
                        '<option value="win3">Win 3 gym battles</option>' +
                        '<option value="win1raid">Win a raid</option>' +
                        '<option value="win3raid">Win 3 raids</option>' +
                        '<option value="winLvl3Raid">Win a level 3 or higher raid</option>' +

                        '<input type="button" value="Set Quest" onClick="saveData();"></button>' + '<br>' + '<select id="rewardType">' + '<br>' + '<input type="text" id="reward" value="Reward" readonly>' + '<br>' + '<input type="button" id="button2" value="Mark checked" onClick="markChecked();">';

                      //user-submitted marker
                      var content2 = '<b>' + "Utility Marker" + '</b><br>' + name + '<br>' + date_submitted + '<br>' + "<i>This is a user-added marker";

                    var icon = customLabel[category] || {};

                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        id: id,
                        label: icon.label
                    });

                    // This is going to decide if a pokestop or user-added marker is being clicked
                    // The infow window will display different content depending on which type of marker is clicked
                    marker.addListener('click', function() {
                        if(category == "Utility") {
                            alert("Utility marker");
                       infowindow.setContent(content2);
                       infowindow.open(map, marker);
                        clickedMarker = marker;
                        } else {
                        infowindow.setContent(content);
                        infowindow.setOptions({
                            maxWidth: 600
                        })
                        infowindow.open(map, marker);
                        clickedMarker = marker;
                        }
                    });

                });

                // Add marker to canvas on mouse click - needs to be toggled with button click
                google.maps.event.addListener(map, 'click', function(event) {
                if (addedMarker == 0){
                                        addedMarker = 1;
                        marker = new google.maps.Marker({
                            position: event.latLng,
                            map: map
                        });

                        marker.addListener('click', function() {
                            infowindow.setContent(form2);
                            infowindow.open(map, marker);
                        }); 
                    }
                });// End of function

            }); // End of downloadurl

            // Try HTML5 geolocation -- this will center the user on their position upon loading of map
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    infowindow.setPosition(pos);
                    infowindow.setContent('Your location'); // Visual geolocation indicator
                    infowindow.open(map);

                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

        } // End of initmap

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.'); 
        } // End of geolocation


        function doNothing() {}

    </script>

    <!-- Google Map API Key -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD14XVl19iIKIMlJqVGR74fFHXhVm5A4Rc&callback=initMap">
    </script>

    <P>Map Legend: Letters on the markers indicate quest rewards<br>
        C = Chansey encounter<br>
        M = Machop encounter<br>
        D = Dratini encounter<br>
        F = Feebas encounter<br>
        L = Larvitar encounter<br>
        B = Berry reward<br>
        RC = Rare candy reward<br>
        P = Potion reward (hyper, max)<br>
        R = Revive reward<br>
        SD = Stardust reward<br>
        UB = Ultra balls reward<br>


        <br>Use this map to locate and identify which PokeStops have desirable quest rewards. <br> This fully crowdsourced map does not in any way utilize Pokemon Go's API or send/receive any data from Niantic's game servers. <br> Currently only works for Oskaloosa, IA. <br>


        <button id="yah" onclick="showText()">More Information</button>
        <p id="demo"></p>

        </details>
        </div>
</body>
</html>