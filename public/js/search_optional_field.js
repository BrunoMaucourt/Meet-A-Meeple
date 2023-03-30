/**
 * Hide and show optional field in user/party form
 */

const search_type_0 = document.getElementById("form_search_type_0");
console.log(search_type_0);

const search_type_1 = document.getElementById("form_search_type_1");
console.log(search_type_1);

const optional_field_party = document.getElementById("optional_field_party");
console.log(optional_field_party);

const optional_field_user = document.getElementById("optional_field_user");
console.log(optional_field_user);

search_type_0.addEventListener("change", function(){
    optional_field_party.classList.add("hidden");
    optional_field_user.classList.remove("hidden");
})

search_type_1.addEventListener("change", function(){
    optional_field_party.classList.remove("hidden");
    optional_field_user.classList.add("hidden");
})