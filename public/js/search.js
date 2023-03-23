/********START SEARCH********/
const location_input = document.querySelector('#city_search_input');
const locate_my_position = document.querySelector('#locate-my-position');
const latitude_input = document.querySelector('#form_city_GPS_lat');
const longitude_input = document.querySelector('#form_city_GPS_long');

locate_my_position.addEventListener('click',()=>{
    if(locate_my_position.checked){
        location_input.disabled = true;
        location_input.value = "Autour de moi";
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position)=>{
              latitude_input.value = position.coords.latitude;
              longitude_input.value = position.coords.longitude;
            });
          }
        
    }else{
        location_input.disabled = false;
        location_input.value = "";
        location_input.placeholder = "Saisissez une ville";
        latitude_input.value = "";
        longitude_input.value = "";
    }
})
/********END SEARCH********/