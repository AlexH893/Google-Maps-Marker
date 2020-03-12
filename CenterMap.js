        /**
         * The CenterControl adds a control to the map that recenters the map on
         * Oskaloosa Square.
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