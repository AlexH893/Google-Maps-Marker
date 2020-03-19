        /**
         * The DisplayLegend control adds a button, when clicked will display map legend
         * @constructor
         */
        function DisplayLegend(controlDiv, map) 
        {
        	var controlUI3 = document.createElement('div');
            controlUI3.style.backgroundColor = '#fff';
            controlUI3.style.border = '2px solid #fff';
            controlUI3.style.borderRadius = '3px';
            controlUI3.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI3.style.cursor = 'pointer';
            controlUI3.style.marginBottom = '30px';
            controlUI3.style.marginLeft = '-70px';


            controlUI3.style.textAlign = 'right';
            controlUI3.title = 'Display Map Legend';
            controlDiv.appendChild(controlUI3);

            // Set CSS for the control interior.
            var legendText = document.createElement('div');
            legendText.style.color = 'rgb(25,25,25)';
            legendText.style.fontFamily = 'Roboto,Arial,sans-serif';
            legendText.style.fontSize = '10px';
            legendText.style.lineHeight = '30px';
            legendText.style.paddingLeft = '10px';
            legendText.style.paddingRight = '7px';
            legendText.innerHTML = 'Display Map Legend';
            controlUI3.appendChild(legendText);

            // Setup the click event listeners: toggling legend showing
            controlUI3.addEventListener('click', function() {
            	LegendWindow = new google.maps.InfoWindow({
                content: document.getElementById('form2')
            });   
				toggle_visibility('form3');
            });

           function toggle_visibility(form3) {
           var e = document.getElementById(form3);
           if(e.style.display == 'block')
              e.style.display = 'none';
           else
              e.style.display = 'block';
        }
    }            