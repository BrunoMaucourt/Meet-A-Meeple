/*START SLIDER*/
//start recommended friend slider//
let recommended_friend_slider_container = document.querySelector('#recommended_friend_slider_container');
let recommended_friend_cards = document.querySelectorAll('.recommended_friend_card');
const recommended_friend_card_number = recommended_friend_cards.length;
const recommended_friend_prev_btn = document.querySelector('#recommended_friend_prev_btn');
const recommended_friend_next_btn = document.querySelector('#recommended_friend_next_btn');
console.log(recommended_friend_next_btn);
recommended_friend_next_btn.addEventListener('click', recommended_friend_next_slide);
recommended_friend_prev_btn.addEventListener('click', recommended_friend_prev_slide);
//end recommended friend slider//


//start recommended banned slider//
let recommended_banned_slider_container = document.querySelector('#recommended_banned_slider_container');
let recommended_banned_cards = document.querySelectorAll('.recommended_banned_card');
const recommended_banned_card_number = recommended_banned_cards.length;
const recommended_banned_prev_btn = document.querySelector('#recommended_banned_prev_btn');
const recommended_banned_next_btn = document.querySelector('#recommended_banned_next_btn');

recommended_banned_next_btn.addEventListener('click', recommended_banned_next_slide);
recommended_banned_prev_btn.addEventListener('click', recommended_banned_prev_slide);
//end recommended banned slider//
/*END SLIDER*/


function recommended_banned_next_slide() {
    let testslide = recommended_banned_cards[0].scrollWidth;
    recommended_banned_slider_container.scrollBy(testslide, 0);
}
function recommended_banned_prev_slide() {
    let testslide = recommended_banned_cards[0].scrollWidth;
    recommended_banned_slider_container.scrollBy(-testslide, 0);
}
function recommended_friend_next_slide() {
    let testslide = recommended_friend_cards[0].scrollWidth;
    recommended_friend_slider_container.scrollBy(testslide, 0);
}
function recommended_friend_prev_slide() {
    let testslide = recommended_friend_cards[0].scrollWidth;
    recommended_friend_slider_container.scrollBy(-testslide, 0);
}
