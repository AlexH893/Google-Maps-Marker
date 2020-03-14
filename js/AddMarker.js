        /**
         * The AddMarker function adds a control to the map that allows the user to add a 
         * marker wherever the user clicks
         * @constructor
         */
        function AddMarker(controlDiv, map) 
        {
            // Set CSS for the control border.
            var controlUI2 = document.createElement('div');
            controlUI2.style.backgroundColor = '#fff';
            controlUI2.style.border = '2px solid #fff';
            controlUI2.style.borderRadius = '3px';
            controlUI2.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI2.style.cursor = 'pointer';
            controlUI2.style.marginBottom = '30px';
            controlUI2.style.textAlign = 'right';
            controlUI2.title = 'Click to toggle marker adding';
            controlDiv.appendChild(controlUI2);

            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = 'rgb(25,25,25)';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '10px';
            controlText.style.lineHeight = '30px';
            controlText.style.paddingLeft = '10px';
            controlText.style.paddingRight = '7px';
            controlText.innerHTML = 'Add Marker';
            controlUI2.appendChild(controlText);

            // Setup the click event listeners: toggling marker adding
            controlUI2.addEventListener('click', function() {
                alert("Marker adding enabled - click on map to add a marker");
addedMarker = 0;
return addedMarker;
            });
        }