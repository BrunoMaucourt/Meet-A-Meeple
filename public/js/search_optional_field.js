/**
 * Hide and show optional field in user/party form
 */

// Load content
const search_type_0 = document.getElementById("form_search_type_0");
const search_type_1 = document.getElementById("form_search_type_1");
const optional_field_party = document.getElementById("optional_field_party");
const optional_field_user = document.getElementById("optional_field_user");
const btn_more_field = document.getElementById("btn_more_field");

// Set default value at page loading
window.onload=function(){
    search_type_0.checked = true;
    search_type_1.checked = false;
}

btn_more_field.addEventListener("click", function(){
    if(search_type_0.checked == true){
        optional_field_user.classList.toggle("hidden");
        optional_field_party.classList.add("hidden");
    }else{
        optional_field_party.classList.toggle("hidden");    
        optional_field_user.classList.add("hidden");  
    }
});

search_type_0.addEventListener("change", function(){
    optional_field_party.classList.add("hidden");  
    optional_field_user.classList.add("hidden");  
})

search_type_1.addEventListener("change", function(){
    optional_field_party.classList.add("hidden");  
    optional_field_user.classList.add("hidden");  
})

/*
search_type_0.addEventListener("change", function () {
    optional_field_party.classList.add("hidden");
    optional_field_user.classList.remove("hidden");
})

search_type_1.addEventListener("change", function () {
    optional_field_party.classList.remove("hidden");
    optional_field_user.classList.add("hidden");
})
*/
