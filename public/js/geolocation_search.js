/**
 * Script to load city name from API adresse 
 */

//
const city_input = document.getElementById("city_search_input");
const city_list = document.getElementById("city_list");

// 
let input_lat = document.getElementById("registration_form_city_GPS_lat");
let input_long = document.getElementById("registration_form_city_GPS_long");

async function geolocation(city_name) {
    try {
        const reponseJSON = await fetch('https://api-adresse.data.gouv.fr/search/?q=' + city_name + '&limit=5&type=municipality');
        const reponseJS = await reponseJSON.json();

        if (reponseJS.features.length == 0) {
            input_lat.value = 0;
            input_long.value = 0;
        } else {
            // Display city name list
            for (i = 0; i < reponseJS.features.length; i++) {
                // Recover data from response
                let city_name = reponseJS.features[i].properties.label;
                let city_long = reponseJS.features[i].geometry.coordinates[0];
                let city_lat = reponseJS.features[i].geometry.coordinates[1]

                // Add box with city name
                let box = document.createElement('div');
                box.classList.add("border", "left-0", "h-fit", "w-full", "bg-white", "hover:bg-main-orange", "hover:text-white");
                box.innerHTML = city_name;
                box.setAttribute('onClick', 'replace_city_name(this)');
                box.setAttribute('lat', city_lat);
                box.setAttribute('long', city_long);
                city_list.appendChild(box);
            }
            //
            city_list.classList.remove("hidden");
            city_list.classList.add("flex");
        }
    }
    catch (error) {
        console.log(error, "La gélocalisation n'a pas fonctionné");
    }
}

function replace_city_name(element) {
    while (city_list.firstChild) {
        city_list.removeChild(city_list.lastChild);
    }
    city_input.value = element.innerHTML;

    // Edit GPS position
    input_lat.value = element.getAttribute('lat');
    input_long.value = element.getAttribute('long');

    city_list.classList.add("hidden");
    city_list.classList.remove("flex");
}

city_input.addEventListener('input', function () {
    let minimum_length_before_search = 3;
    let city_name = city_input.value;
    let city_name_length = city_name.length;
    if (city_name_length > minimum_length_before_search) {
        // Remove previous child of city_list
        while (city_list.firstChild) {
            city_list.removeChild(city_list.lastChild);
        }
        geolocation(city_name);
    }
});