/**
 * Automatic scroll to end of div
 * */
const scroll_div = document.getElementById("scroll_div");

window.addEventListener("load", function () {
    scroll_div.scrollTo(0, scroll_div.scrollHeight);
});