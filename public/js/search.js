/********START GEOLOCATION********/
function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position)=>{
        console.log("latitude : " + position.coords.latitude)
        console.log("longitude : " + position.coords.longitude)
      });
    }
  }

  let test;
  fetch('https://api-adresse.data.gouv.fr/search/?q=rambouillet')
  .then((serverPromise) => {
    serverPromise.json()
      .then((j) => test = console.log(j.features[0].properties))
      .catch((e) => console.log(e))
  })
  .catch((e) => console.log(e));
  
/********END GEOLOCATION********/

/********START SEARCH********/
const location_input = document.querySelector('#location');
const locate_my_position = document.querySelector('#locate-my-position');
const latitude_input = document.querySelector('#latitude_input');
const longitude_input = document.querySelector('#longitude_input');
console.log(locate_my_position);

locate_my_position.addEventListener('click',()=>{
    if(locate_my_position.checked){
        console.log('cest check')
        location_input.disabled = true;
        location_input.value = "Autour de moi";
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position)=>{
              console.log("latitude : " + position.coords.latitude)
              latitude_input.value = position.coords.latitude;
              console.log("longitude : " + position.coords.longitude)
              longitude_input.value = position.coords.longitude;
            });
          }
        
    }else{
        console.log("pas check")
        location_input.disabled = false;
        location_input.value = "";
        location_input.placeholder = "Saisissez une ville";
        latitude_input.value = "";
        longitude_input.value = "";
    }
})

/********END SEARCH********/