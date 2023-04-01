const date_first_input = document.getElementById("date_time_party");
const date_last_input = document.getElementById("last_date_party");
const date_current = Date();

if(date_first_input === date_first_input) {
document.querySelector("#date_time_party").onchange = function () {
    let input = document.getElementById("last_date_party");
    input.setAttribute("max", this.value);
}};

/**
 * Pre-fill field number needed when number total is changed
 */
const player_number_needed = document.getElementById("player_number_needed");
const player_number_total = document.getElementById("player_number_total");

player_number_total.addEventListener("change", function(){
    player_number_needed.value = player_number_total.value -1;
    player_number_needed.setAttribute("max", player_number_total.value);
})
