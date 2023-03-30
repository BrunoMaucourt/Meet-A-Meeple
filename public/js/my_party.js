//start incomming game slider//
    let incomming_game_slider_container = document.querySelector('#incomming_game_slider_container');
    let incomming_game_cards = document.querySelectorAll('.incomming_game_card');
    const incomming_game_card_number = incomming_game_cards.length;
    const incomming_game_prev_btn = document.querySelector('#incomming_game_prev_btn');
    const incomming_game_next_btn = document.querySelector('#incomming_game_next_btn');
    
    incomming_game_next_btn.addEventListener('click', incomming_game_next_slide);
    incomming_game_prev_btn.addEventListener('click', incomming_game_prev_slide);

    function incomming_game_next_slide(){
        let cardwidth = incomming_game_cards[0].scrollWidth;
        incomming_game_slider_container.scrollBy(cardwidth,0);
    }
    function incomming_game_prev_slide(){
        let cardwidth = incomming_game_cards[0].scrollWidth;
        incomming_game_slider_container.scrollBy(-cardwidth,0);
    }

//end incomming game slider//