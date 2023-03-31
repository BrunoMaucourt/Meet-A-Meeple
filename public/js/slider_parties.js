/*START SLIDER*/
//start recommended party slider//
let recommended_party_slider_container = document.querySelector('#recommended_party_slider_container');
let recommended_party_cards = document.querySelectorAll('.recommended_party_card');
const recommended_party_card_number = recommended_party_cards.length;
const recommended_party_prev_btn = document.querySelector('#recommended_party_prev_btn');
const recommended_party_next_btn = document.querySelector('#recommended_party_next_btn');
console.log(recommended_party_prev_btn);
console.log(recommended_party_next_btn);
recommended_party_next_btn.addEventListener('click', recommended_party_next_slide);
recommended_party_prev_btn.addEventListener('click', recommended_party_prev_slide);
//end recommended player slider//
/*END SLIDER*/

function recommended_party_next_slide() {
    let testslide = recommended_party_cards[0].scrollWidth;
    recommended_party_slider_container.scrollBy(testslide, 0);
}
function recommended_party_prev_slide() {
    let testslide = recommended_party_cards[0].scrollWidth;
    recommended_party_slider_container.scrollBy(-testslide, 0);
}