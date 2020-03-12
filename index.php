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
</head>

<body>
    <?php include 'date.php';  ?>

    <br> Latest update 3/11/2020 - Backend changes, code refactoring

    <div id="map" height="460px" width="100%"></div>
    <div id="form2">
        <table>
            <!-- <tr><td>Name:</td> </tr> 	-->
            <label id="name" style="color: #0026ff"></label>

            <tr>
                <td>questindicator:</td>
                <td><select id="questType" onchange="questLogic()">
                        <option value="null">Select quest</option>
                        <option value="questChansey">Hatch 5 eggs</option>
                        <option value="questMagmar">Hatch 3 eggs</option>
                        <option value="questMagmar">Placeholder</option>
                        <option value="questMagmar">Placeholder</option>
                        <option value="questMagmar">Placeholder</option>
                        <option value="questMagmar">Placeholder</option>
                        <option value="questMagmar">Placeholder</option>
                        <option value="questMagmar">Placeholder</option>
                    </select> </td>
            </tr>
            <tr>
                <td></td>
                <td><input type='button' value='Save' onclick='saveLOCATION()' /></td>
            </tr>
        </table>
    </div>

    <div id="map-canvas"></div>

    <script>
        $(document).ready(function() {
            $("#button2").click("slow", function(event) {
                //event.stopPropagation();
                alert('test');
                // onClick=markChecked();
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

        //   var map;
        var marker;
        var infowindow;
        var messagewindow;
        var clickedMarker;
        var hasQuest = false; // Flag to identify which stops have a quest set, default=false
        var oskaloosa = {
            lat: 41.2954,
            lng: -92.6444
        };

        /**
         * The CenterControl adds a control to the map that recenters the map on
         * Chicago.
         * This constructor takes the control DIV as an argument.
         * @constructor
         */
        function CenterControl(controlDiv, map) 
        {
            // Set CSS for the control border.
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.border = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginBottom = '20px';
            controlUI.style.textAlign = 'right';
            controlUI.title = 'Click to recenter the map to Oskaloosa Square';
            controlDiv.appendChild(controlUI);

            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = 'rgb(25,25,25)';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '10px';
            controlText.style.lineHeight = '30px';
            controlText.style.paddingLeft = '8px';
            controlText.style.paddingRight = '7px';
            controlText.innerHTML = 'Center Oskaloosa';
            controlUI.appendChild(controlText);

            // Setup the click event listeners: positioning the map to Oskaloosa
            controlUI.addEventListener('click', function() {
                map.setCenter(oskaloosa);
            });
        }

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




            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');


            infowindow = new google.maps.InfoWindow({
                content: document.getElementById('form')
            });

            messagewindow = new google.maps.InfoWindow({

                content: document.getElementById('message')
            });

            //Loading in markers from DB via call.php
            downloadUrl('call.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var name = markerElem.getAttribute('name'); //name of marker		  
                    document.getElementById("name").innerHTML = name;
                    var questTitle = markerElem.getAttribute('questTitle'); //quest of marker
                    var questReward = markerElem.getAttribute('questReward'); //reward of marker			  
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));
                    var id = markerElem.getAttribute('id');
                    var category = markerElem.getAttribute('category');
                    var date_submitted = markerElem.getAttribute('date_submitted');
                    //<div id='infodiv' style='width: 200px'> 
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




                    var icon = customLabel[category] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        id: id,
                        label: icon.label
                    });

                    marker.addListener('click', function() {
                        infowindow.setContent(content);
                        infowindow.setOptions({
                            maxWidth: 600
                        })
                        infowindow.open(map, marker);
                        clickedMarker = marker;
                    });




                    //	google.maps.event.addListener(marker, 'click', function() { //works

                    //    if (marker.category == "Chansey" || category.length === 0) {
                    //		alert("hello");
                    //		} else {
                    //		marker.setVisible(false); // maps API hide call 
                    //		break;

                    //}

                    //	});


                });


                filterMarkers = function(category) {

                    for (i = 0; i < markers.length; i++) {
                        marker = markers[i];

                        markers.setVisible(null);
                        // If is same category or category not picked

                    }
                }
            }); //end of downloadurl




            //CODE TO ADD A MARKER ONTO CANVAS ON MOUSE CLICK
            //       google.maps.event.addListener(map, 'click', function(event) {
            //     marker = new google.maps.Marker({
            //       position: event.latLng,
            //       map: map
            //     });		

            //      marker.addListener('click', function() {
            //		          infowindow.setContent(form2); 
            //          infowindow.open(map, marker);

            //});			  
            //         }); 
            //END OF CODE BLOCK FOR ADDING	  




            // Try HTML5 geolocation -- this will center the user on their position upon loading of map
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    infowindow.setPosition(pos); //
                    infowindow.setContent('Your location'); // ghetto visual geolocation indicator
                    infowindow.open(map); //

                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

        } //end of initmap

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.'); //end of geolocation



        }


        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }



        //categories
        //chansey
        //other rare encounters
        //berry
        //rare candy
        //
        function saveData() {
            if (document.getElementById("questType").value == "questChansey") { //if chansey quest is selected upon submission
                var category = "Chansey";
                var questTitle = "Hatch5Eggs";
                var questReward = "ChanseyEncounter";
                document.getElementById("questTitle").innerHTML = "Hatch 5 Eggs";
                document.getElementById("rewardTitle").innerHTML = "Chansey Encounter";

            } else if (document.getElementById("questType").value == "questDratini") {
                var questReward;
                var category;


                //document.getElementById("rewardTitle").innerHTML = "Dratini Encounter";
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1500 stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1500 stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "10 ultra balls";
                    var category = "Balls";
                    document.getElementById("rewardTitle").innerHTML = "10 ultra balls";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "2 golden razzberries";
                    var category = "Balls";
                    document.getElementById("rewardTitle").innerHTML = "2 golden razzberries";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "2-3 rare candies";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "2-3 rare candies";
                } else if (rewardType.selectedIndex == 4) {
                    var questReward = "Dratini encounter";
                    var category = "Dratini";
                    document.getElementById("rewardTitle").innerHTML = "Dratini encounter";
                }
                var questTitle = "CatchADragon";
                document.getElementById("questTitle").innerHTML = "Catch 1 Dragon Type";
            } else if (document.getElementById("questType").value == "questDratini3") {
                var category = "Candy";
                var questTitle = "Catch 3 dragon type";
                var questReward = "3 rare candies";
                document.getElementById("questTitle").innerHTML = "Catch 3 dragon type";
                document.getElementById("rewardTitle").innerHTML = "3 rare candies";

            } else if (document.getElementById("questType").value == "trade1") {
                var category = "Feebas";
                var questTitle = "Trade1Pokemon";
                var questReward = "FeebasEncounter";
                document.getElementById("questTitle").innerHTML = "Trade A Pokemon";
                document.getElementById("rewardTitle").innerHTML = "Feebas Encounter";

            } else if (document.getElementById("questType").value == "questDratini2") { //**event quest**
                var category = "Dratini";
                var questTitle = "Evolve10";
                var questReward = "DratiniEncounter";
                document.getElementById("questTitle").innerHTML = "Evolve 10 Water Type Pokemon";
                document.getElementById("rewardTitle").innerHTML = "Dratini Encounter";

            } else if (document.getElementById("questType").value == "greatCurve") {
                var questTitle = "greatCurve";
                var questReward = "SpindaEncounter";
                document.getElementById("questTitle").innerHTML = "Make a Great Curveball Throw";
                document.getElementById("rewardTitle").innerHTML = "Spinda Encounter";

            } else if (document.getElementById("questType").value == "greatCurve3x") {
                var questTitle = "greatCurve3x";
                var questReward = "OnixEncounter";
                document.getElementById("questTitle").innerHTML = "Make 3 Great Curveball Throws In a Row";
                document.getElementById("rewardTitle").innerHTML = "Onix Encounter Encounter";

            } else if (document.getElementById("questType").value == "excellent3x") {
                var category = "Larvitar";
                var questTitle = "excellent3x";
                var questReward = "LarvitarEncounter";
                document.getElementById("questTitle").innerHTML = "Make 3 Excellent Throws In a Row";
                document.getElementById("rewardTitle").innerHTML = "Larvitar Encounter";

            } else if (document.getElementById("questType").value == "battle1x") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "5 Nanab Berries"; //left off here, reward works
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "10 Nanab Berries";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "1 pinap berry";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "1 pinap berry";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "Mankey encounter";
                    var category = "";
                    document.getElementById("rewardTitle").innerHTML = "Mankey encounter";
                }
                var questTitle = "gym1x";
                document.getElementById("questTitle").innerHTML = "Battle in a gym 1 time";

            } else if (document.getElementById("questType").value == "battle5x") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "10 Nanab Berries"; //left off here, reward works
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "10 Nanab Berries";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "Machop Encounter";
                    var category = "Machop";
                    document.getElementById("rewardTitle").innerHTML = "Machop Encounter";
                }
                var questTitle = "gym5x";
                document.getElementById("questTitle").innerHTML = "Battle in a gym 5 times";

            } else if (document.getElementById("questType").value == "win1") {
                var category = "Berry";
                var questTitle = "win1x";
                var questReward = "10Nanab";
                document.getElementById("questTitle").innerHTML = "Win a gym battle";
                document.getElementById("rewardTitle").innerHTML = "10 nanab berries";

            } else if (document.getElementById("questType").value == "win3") {
                var category = "Candy";
                var questTitle = "win3x";
                var questReward = "1candy";
                document.getElementById("questTitle").innerHTML = "Win 3 gym battles";
                document.getElementById("rewardTitle").innerHTML = "1 rare candy";

            } else if (document.getElementById("questType").value == "win1raid") {
                var category = "Berry";
                var questTitle = "win1raid";
                var questReward = "10nanab";
                document.getElementById("questTitle").innerHTML = "Win a raid";
                document.getElementById("rewardTitle").innerHTML = "10 nanab berries";

            } else if (document.getElementById("questType").value == "win3raid") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1500stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1500 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "3 Max Potions";
                    var category = "Potion";
                    document.getElementById("rewardTitle").innerHTML = "3 Max Potions";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "3 Max Revives";
                    var category = "Revive";
                    document.getElementById("rewardTitle").innerHTML = "3 Max Revives";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "8 Revives";
                    var category = "Revive";
                    document.getElementById("rewardTitle").innerHTML = "8 Revives";
                }
                var questTitle = "win3raid";
                document.getElementById("questTitle").innerHTML = "Win 3 raids";

            } else if (document.getElementById("questType").value == "winLvl3Raid") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1000stardust"; //left off here, reward works
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "3 Hyper Potions";
                    var category = "Potion";
                    document.getElementById("rewardTitle").innerHTML = "3 Hyper Potions";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "1-3 Max Revives";
                    var category = "Revive";
                    document.getElementById("rewardTitle").innerHTML = "1-3 Max Revives";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "1 rare candy";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "1 rare candy";
                }
                var questTitle = "winLvl3Raid";
                document.getElementById("questTitle").innerHTML = "Win a level 3 or higher raid";

            } else if (document.getElementById("questType").value == "use1super") {
                var category = "Berry";
                var questTitle = "use1super";
                var questReward = "10Nanab";
                document.getElementById("questTitle").innerHTML = "Use a supereffective Charged Attack in a Gym battle";
                document.getElementById("rewardTitle").innerHTML = "10 Nanab Berries";

            } else if (document.getElementById("questType").value == "use7super") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1000stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "1 max revive";
                    var category = "Potion";
                    document.getElementById("rewardTitle").innerHTML = "1 Max revive";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "1 rare candy";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "1 rare candy";
                }
                var questTitle = "use7super";
                document.getElementById("questTitle").innerHTML = "Use a supereffective Charged Attack in 7 Gym battles";

            } else if (document.getElementById("questType").value == "berry5") {
                var category = "Berry";
                var questTitle = "use5berry";
                var questReward = "6 razz berries";
                document.getElementById("questTitle").innerHTML = "Use 5 Berries to help catch Pokémon";
                document.getElementById("rewardTitle").innerHTML = "6 razz berries";

            } else if (document.getElementById("questType").value == "catch10") {
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "Magikarp encounter";
                    var category = "Magikarp";
                    document.getElementById("rewardTitle").innerHTML = "Magikarp Encounter";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "3 razz berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "3 razz berries";
                }
                var questTitle = "catch10pokemon";
                document.getElementById("questTitle").innerHTML = "Catch 10 Pokemon";

            } else if (document.getElementById("questType").value == "catchDitto") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1500stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "10 ultra balls";
                    var category = "Balls";
                    document.getElementById("rewardTitle").innerHTML = "10 ultra balls";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "3 rare candies";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "3 rare candies";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "2 golden razzberries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "2 golden razzberries";
                }
                var questTitle = "catchDitto";
                document.getElementById("questTitle").innerHTML = "Catch a ditto";

            } else if (document.getElementById("questType").value == "catch3medley") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "4-6 razz berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "4-6 razz berries";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "1-2 pinap berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "1-2 pinap berries";
                }
                var questTitle = "catch3medley";
                document.getElementById("questTitle").innerHTML = "Catch 3 [Oddish/Bellsprout][Swablu][Pidgey/Murkrow][Treeko/Mudkip][Meowth/Skitty]";

            } else if (document.getElementById("questType").value == "catch10weather") {
                var category = "Berry";
                var questTitle = "catch10weather";
                var questReward = "6 razz berries";
                document.getElementById("questTitle").innerHTML = "Catch 10 Pokémon with Weather Boost";
                document.getElementById("rewardTitle").innerHTML = "6 razz berries";

            } else if (document.getElementById("questType").value == "great5") {
                var category = "Berry";
                var questTitle = "fiveGreatThrows";
                var questReward = "5 razz berries";
                document.getElementById("questTitle").innerHTML = "Make 5 great throws";
                document.getElementById("rewardTitle").innerHTML = "5 razz berries";

            } else if (document.getElementById("questType").value == "great3row") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1000 Stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "5-10 ultra balls";
                    var category = "Balls";
                    document.getElementById("rewardTitle").innerHTML = "5-10 ultra balls";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "9 razz berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "9 razz berries";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "3 Pinap Berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "3 Pinap Berries";
                } else if (rewardType.selectedIndex == 4) {
                    var questReward = "1 Rare Candy";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "1 Rare Candy";
                }
                var questTitle = "great3xinarow";
                document.getElementById("questTitle").innerHTML = "3 Great Throws in a row";

            } else if (document.getElementById("questType").value == "great3curve") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1000 Stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "9 razz berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "9 razz berries";
                } else if (rewardType.selectedIndex == 2) {
                    var questReward = "5 ultra balls";
                    var category = "Balls";
                    document.getElementById("rewardTitle").innerHTML = "5 ultra balls";
                } else if (rewardType.selectedIndex == 3) {
                    var questReward = "2 gold razz berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "2 golden razz berries";
                }
                var questTitle = "great3curve";
                document.getElementById("questTitle").innerHTML = "Make 3 Great Curveball Throws";

            } else if (document.getElementById("questType").value == "great3curverow") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1500 Stardust";
                    var category = "Stardust";
                    document.getElementById("rewardTitle").innerHTML = "1000 Stardust";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "3 rare candies";
                    var category = "Candy";
                    document.getElementById("rewardTitle").innerHTML = "3 rare candies";
                }
                var questTitle = "great3CurveInARow";
                document.getElementById("questTitle").innerHTML = "Make 3 Great Curveball Throws in a row";

            } else if (document.getElementById("questType").value == "curve5x") { //quest with multiple rewards
                var questReward;
                var category;
                if (rewardType.selectedIndex == 0) {
                    var questReward = "1-2 pinap berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "1-2 pinap berries";
                } else if (rewardType.selectedIndex == 1) {
                    var questReward = "6 nanab berries";
                    var category = "Berry";
                    document.getElementById("rewardTitle").innerHTML = "6 nanab berries";
                }
                var questTitle = "fiveCurveballThrows";
                document.getElementById("questTitle").innerHTML = "Make 5 Curveball Throws in a row";

            } else if (document.getElementById("questType").value == "questHatch3") {
                var category = "Candy";
                var questTitle = "hatch3eggs";
                var questReward = "Rare Candy";
                document.getElementById("questTitle").innerHTML = "Hatch 3 eggs";
                document.getElementById("rewardTitle").innerHTML = "Rare candy";

            }
            //HALLOWEEN QUESTS
            else if (document.getElementById("questType").value == "HWpooch") {
                var category = "Halloween";
                var questTitle = "catch5poochhound";
                var questReward = "Sneasel encounter";
                document.getElementById("questTitle").innerHTML = "Catch 5 Poochyena or Houndour";
                document.getElementById("rewardTitle").innerHTML = "Sneasel encounter";

            } else if (document.getElementById("questType").value == "HWdark") {
                var category = "Halloween";
                var questTitle = "catch5dark";
                var questReward = "500 stardust";
                document.getElementById("questTitle").innerHTML = "Catch 5 dark type pokemon";
                document.getElementById("rewardTitle").innerHTML = "500 stardust";

            } else if (document.getElementById("questType").value == "HWghost") {
                var category = "Halloween";
                var questTitle = "catch10ghost";
                var questReward = "Sableye encounter";
                document.getElementById("questTitle").innerHTML = "Catch 10 ghost type pokemon";
                document.getElementById("rewardTitle").innerHTML = "Sableye encounter";

            } else if (document.getElementById("questType").value == "HWdusk") {
                var category = "Candy";
                var questTitle = "evolve3duskshuppet";
                var questReward = "Rare Candy";
                document.getElementById("questTitle").innerHTML = "Evolve 3 duskull or shuppet";
                document.getElementById("rewardTitle").innerHTML = "Rare Candy";

            } else if (document.getElementById("questType").value == "HWxfer") {
                var category = "Halloween";
                var questTitle = "HWxfer10";
                var questReward = "Misdreavus encounter";
                document.getElementById("questTitle").innerHTML = "Transfer 10 Pokemon";
                document.getElementById("rewardTitle").innerHTML = "Misdreavus encounter";

            }

            var id = clickedMarker.id;

            var url = "phpsqlinfo_updaterow.php?questTitle=" + questTitle + "&category=" + category + "&questReward=" + questReward + "&id=" + id;



            downloadUrl(url, function(data, responseCode) {

                if (responseCode == 200 && data.length <= 1) {
                    infowindow.close();
                    messagewindow.open(map, marker);
                }
            });
        } //end of save data




        function markChecked() {
            alert("test");

            var category = "Checked";




            var id = clickedMarker.id;
            var url = "phpsqlinfo_updaterow.php?questTitle=" + "" + "&category=" + "Checked" + "&questReward=" + "" + "&id=" + id;
            //var url = "phpsqlinfo_updaterow.php?category=" + category + "&id=" + id;   

            downloadUrl(url, function(data, responseCode) {

                if (responseCode == 200 && data.length <= 1) {
                    infowindow.close();
                    messagewindow.open(map, marker);
                }
            });


        }




        //  function saveLOCATION() { //USED FOR ADDING MARKERS TO CANVAS 
        //       var latlng = marker.getPosition();
        //    var url = 'phpsqlinfo_addrow.php?name=' + name + '&questTitle=' + 'default' + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();


        //    downloadUrl(url, function(data, responseCode) {

        //     if (responseCode == 200 && data.length <= 1) {
        //       infowindow.close();
        //       messagewindow.open(map, marker);
        //      }
        //    });
        // }	 	  




        function questLogic() {


            var x = document.getElementById("questType").value;
            if (document.getElementById("questType").value == "questChansey") {

                hasQuest = true;
                document.getElementById("reward").value = "Chansey Encounter";
                //  document.getElementById("category").value = "chansey";
                document.getElementById("rewardType").options.length = 0; //blanking reward field					

            } else if (document.getElementById("questType").value == "questDratini") {

                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var Dra1 = ["1500 stardust", "10 ultra balls", "2 golden razzberries", "2-3 rare candies", "Dratini encounter"];
                var select = document.getElementById("rewardType");
                for (index in Dra1) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(Dra1[index], index);

                }
            } else if (document.getElementById("questType").value == "questDratini3") {

                hasQuest = true;
                document.getElementById("reward").value = "3 rare candies";
                document.getElementById("rewardType").options.length = 0; //blanking reward field											



            } else if (document.getElementById("questType").value == "questDratini2") {
                alert("HEllo");
                hasQuest = true;
                document.getElementById("reward").value = "Dratini Encounter";
                document.getElementById("rewardType").options.length = 0; //blanking reward field											
            } else if (document.getElementById("questType").value == "greatCurve") {
                hasQuest = true;
                document.getElementById("reward").value = "Spinda Encounter";
                document.getElementById("rewardType").options.length = 0; //blanking reward field											
            } else if (document.getElementById("questType").value == "greatCurve3x") {
                hasQuest = true;
                document.getElementById("reward").value = "Onix Encounter";
                document.getElementById("rewardType").options.length = 0; //blanking reward field											
            } else if (document.getElementById("questType").value == "excellent3x") {
                hasQuest = true;
                document.getElementById("reward").value = "Larvitar Encounter";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "battle1x") {
                hasQuest = true;
                //document.getElementById("reward").value = "Larvitar Encounter";	
                document.getElementById("rewardType").options.length = 0; //blanking reward field	
                var bat1 = ["5 nanab berries", "1 pinap berry", "Mankey encounter"];
                var select = document.getElementById("rewardType");
                for (index in bat1) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(bat1[index], index);

                }
            } else if (document.getElementById("questType").value == "battle5x") {
                hasQuest = true;
                //document.getElementById("reward").value = "Larvitar Encounter";	
                document.getElementById("rewardType").options.length = 0; //blanking reward field	
                var bat5 = ["10 nanab berries", "Machop encounter"];
                var select = document.getElementById("rewardType");
                for (index in bat5) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(bat5[index], index);

                }
            } else if (document.getElementById("questType").value == "win1") {
                hasQuest = true;
                document.getElementById("reward").value = "10 Nanab berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "win3") {
                hasQuest = true;
                document.getElementById("reward").value = "1 rare candy";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "win1raid") {
                hasQuest = true;
                document.getElementById("reward").value = "10 nanab berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "win3raid") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var raid3 = ["1500 stardust", "3 max potions", "3 max revives", "8 revives"];
                var select = document.getElementById("rewardType");
                for (index in raid3) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(raid3[index], index);

                }
            } else if (document.getElementById("questType").value == "winLvl3Raid") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var raidlvl3 = ["1000 stardust", "3 hyper potions", "1-3 max revives", "1 rare candy"];
                var select = document.getElementById("rewardType");
                for (index in raidlvl3) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(raidlvl3[index], index);

                }
            } else if (document.getElementById("questType").value == "use1super") {
                hasQuest = true;
                document.getElementById("reward").value = "10 nanab berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "use7super") {
                hasQuest = true;
                //document.getElementById("reward").value = "Larvitar Encounter";	
                document.getElementById("rewardType").options.length = 0; //blanking reward field	
                var use7 = ["1000 stardust", "1 max revive", "1 rare candy"];
                var select = document.getElementById("rewardType");
                for (index in use7) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(use7[index], index);

                }
            } else if (document.getElementById("questType").value == "berry5") {
                hasQuest = true;
                document.getElementById("reward").value = "6 razz berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "catch10") {
                hasQuest = true;

                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var catchTen = ["Magikarp Encounter", "3 razz berries"];
                var select = document.getElementById("rewardType");
                for (index in catchTen) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(catchTen[index], index);

                }
            } else if (document.getElementById("questType").value == "catchDitto") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var catchD = ["1500 stardust", "10 ultra balls", "3 rare candies", "2 golden razzberries"];
                var select = document.getElementById("rewardType");
                for (index in catchD) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(catchD[index], index);

                }
            } else if (document.getElementById("questType").value == "catch3medley") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var catchM = ["4-6 razz berries", "1-2 pinap berries"];
                var select = document.getElementById("rewardType");
                for (index in catchM) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(catchM[index], index);

                }
            } else if (document.getElementById("questType").value == "catch10weather") {
                hasQuest = true;
                document.getElementById("reward").value = "6 razz berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "great5") {
                hasQuest = true;
                document.getElementById("reward").value = "5 razz berries";
                document.getElementById("rewardType").options.length = 0; //blanking reward field						
            } else if (document.getElementById("questType").value == "great3row") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var great3r = ["1000 stardust", "5-10 ultra balls", "9 razz berries", "3 pinaap berries", "1 rare candy"];
                var select = document.getElementById("rewardType");
                for (index in great3r) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(great3r[index], index);

                }
            } else if (document.getElementById("questType").value == "great3curve") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var great3c = ["1000 stardust", "9 razz berries", "5 ultra balls", "2 golden razz berries"];
                var select = document.getElementById("rewardType");
                for (index in great3c) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(great3c[index], index);

                }
            } else if (document.getElementById("questType").value == "great3curverow") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var great3cx = ["1500 stardust", "3 rare candies"];
                var select = document.getElementById("rewardType");
                for (index in great3cx) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(great3cx[index], index);

                }
            } else if (document.getElementById("questType").value == "curve5x") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                var curve5 = ["1-2 pinap berries", "6 nanab berries"];
                var select = document.getElementById("rewardType");
                for (index in curve5) { //loop to populate quest reward options
                    select.options[select.options.length] = new Option(curve5[index], index);

                }
            } else if (document.getElementById("questType").value == "questHatch3") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "Rare candy";


            }




            //HALLOWEEN QUESTS
            else if (document.getElementById("questType").value == "HWpooch") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "Sableye encounter";


            } else if (document.getElementById("questType").value == "HWdark") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "500 stardust";

            } else if (document.getElementById("questType").value == "HWghost") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "Sableeye encounter";

            } else if (document.getElementById("questType").value == "HWdusk") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "Rare candy";

            } else if (document.getElementById("questType").value == "HWxfer") {
                hasQuest = true;
                document.getElementById("rewardType").options.length = 0; //blanking reward field
                document.getElementById("reward").value = "Misdreavus encounter";

            }

        }




        function doNothing() {}




        //  function bindInfoWindow(marker, map, infoWindow, html) {
        // google.maps.event.addListener(marker, 'click', function() {
        // infoWindow.setContent(content);
        //  infoWindow.open(map, marker);


        //  });


        //  }
    </script>
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

        <script>
            function showText() {
                document.getElementById("demo").innerHTML = "<p>FAQ <br><br>" +
                    "How do I use this map?<br> <br>" +
                    "<i>When you find a task with a good reward, locate the corresponding stop on the map (indicated by a google map marker) and use the dropdown menu to make the proper selection and click submit. Stops that you have visited or that aren't worth marking you can mark checked.</i> <br><br> Why doesn't this show all of the quests and rewards?<br><br>" +
                    " <i>To speed up the process of submitting quests only rewards or quests that are worth hunting for are included in this map</i><br><br>" +

                    "       Built with <br> HTML / JavaScript / AJAX / PHP / CSS <br> " +

                    "     <b>Resources<br></b> " +
                    '    <i>Google Maps JavaScript API <br> ' +
                    'Stack Overflow <br> ' +
                    'PokemonGoHub.net <br> ' +
                    'The Silph Road <br> ' +
                    'Latlong.net' +
                    '</P></i>';
            }
        </script>





        </details>


        </div>


</body>

</html>