/**
 * Automatic scroll to end of div
 * */
const scroll_div = document.getElementById("scroll_div");

window.addEventListener("load", function () {
    scroll_div.scrollTo(0, scroll_div.scrollHeight);
});

const message_user_list_container = document.querySelector('#message_user_list_container');
const selected_user = document.querySelector('#selected_user');
console.log(selected_user.offsetLeft);
message_user_list_container.scrollTo(selected_user.offsetLeft-80, selected_user.offsetTop-232);