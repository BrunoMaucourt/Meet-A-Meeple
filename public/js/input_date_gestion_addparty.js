const date_first_input = document.getElementById("date_time_party");
const date_last_input = document.getElementById("last_date_party");
const date_current = Date();
console.log(date_current);
date_first_input.addEventListener("onchange", function() {console.log("Ferdi0")});
if(date_first_input === date_first_input) {
document.querySelector("#date_time_party").onchange = function () {
    console.log("Ferdi2");
    let input = document.getElementById("last_date_party");
    input.setAttribute("max", this.value);
    input.setAttribute("min", date_current);
}};






