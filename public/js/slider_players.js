/*START SLIDER*/
    //start recommended player slider//
    let recommended_player_slider_container = document.querySelector('#recommended_player_slider_container');
    let recommended_player_cards = document.querySelectorAll('.recommended_player_card');
    const recommended_player_card_number = recommended_player_cards.length;
    const recommended_player_prev_btn = document.querySelector('#recommended_player_prev_btn');
    const recommended_player_next_btn = document.querySelector('#recommended_player_next_btn');
    
    recommended_player_next_btn.addEventListener('click', recommended_player_next_slide);
    recommended_player_prev_btn.addEventListener('click', recommended_player_prev_slide);
    //end recommended player slider//
    /*END SLIDER*/
    
    function recommended_player_next_slide(){
        let testslide = recommended_player_cards[0].scrollWidth;
        recommended_player_slider_container.scrollBy(testslide,0);
    }
    function recommended_player_prev_slide(){
        let testslide = recommended_player_cards[0].scrollWidth;
        recommended_player_slider_container.scrollBy(-testslide,0);
    }
