/*START SLIDER*/
let recommended_player_slider_container = document.querySelector('#recommended_player_slider_container');
let recommended_player_cards = document.querySelectorAll('.recommended_player_card');
const recommended_player_card_number = recommended_player_cards.length;
const recommended_player_prev_btn = document.querySelector('#recommended_player_prev_btn');
const recommended_player_next_btn = document.querySelector('#recommended_player_next_btn');
let currentIndex = 0;

    
function nextSlide(){
    let testslide = recommended_player_cards[currentIndex].scrollWidth;
    recommended_player_slider_container.scrollBy(testslide,0);
}
function prevSlide(){
    let testslide = recommended_player_cards[currentIndex].scrollWidth;
    recommended_player_slider_container.scrollBy(-testslide,0);
}
recommended_player_next_btn.addEventListener('click', nextSlide);
recommended_player_prev_btn.addEventListener('click',prevSlide);
/*END SLIDER*/