        function saveData() {
            if (document.getElementById("questType").value == "questChansey") {
                var category = "Chansey";
                var questTitle = "Hatch5Eggs";
                var questReward = "ChanseyEncounter";
                document.getElementById("questTitle").innerHTML = "Hatch 5 Eggs";
                document.getElementById("rewardTitle").innerHTML = "Chansey Encounter";

            } else if (document.getElementById("questType").value == "questDratini") {
                var questReward;
                var category;

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
        } // End of save data