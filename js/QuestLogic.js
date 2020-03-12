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