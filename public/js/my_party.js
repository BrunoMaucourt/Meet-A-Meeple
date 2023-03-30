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

//start incomming game slider//
    let finished_game_slider_container = document.querySelector('#finished_game_slider_container');
    let finished_game_cards = document.querySelectorAll('.finished_game_card');
    const finished_game_card_number = finished_game_cards.length;
    const finished_game_prev_btn = document.querySelector('#finished_game_prev_btn');
    const finished_game_next_btn = document.querySelector('#finished_game_next_btn');
    
    finished_game_next_btn.addEventListener('click', finished_game_next_slide);
    finished_game_prev_btn.addEventListener('click', finished_game_prev_slide);

    function finished_game_next_slide(){
        let cardwidth = finished_game_cards[0].scrollWidth;
        finished_game_slider_container.scrollBy(cardwidth,0);
    }
    function finished_game_prev_slide(){
        let cardwidth = finished_game_cards[0].scrollWidth;
        finished_game_slider_container.scrollBy(-cardwidth,0);
    }
//end incomming game slider//

//start incomming game slider//
    let created_game_slider_container = document.querySelector('#created_game_slider_container');
    let created_game_cards = document.querySelectorAll('.created_game_card');
    const created_game_card_number = created_game_cards.length;
    const created_game_prev_btn = document.querySelector('#created_game_prev_btn');
    const created_game_next_btn = document.querySelector('#created_game_next_btn');
    
    created_game_next_btn.addEventListener('click', created_game_next_slide);
    created_game_prev_btn.addEventListener('click', created_game_prev_slide);

    function created_game_next_slide(){
        let cardwidth = created_game_cards[0].scrollWidth;
        created_game_slider_container.scrollBy(cardwidth,0);
    }
    function created_game_prev_slide(){
        let cardwidth = created_game_cards[0].scrollWidth;
        created_game_slider_container.scrollBy(-cardwidth,0);
    }
//end incomming game slider//

//start canceled game slider//
    let canceled_game_slider_container = document.querySelector('#canceled_game_slider_container');
    let canceled_game_cards = document.querySelectorAll('.canceled_game_card');
    const canceled_game_card_number = canceled_game_cards.length;
    const canceled_game_prev_btn = document.querySelector('#canceled_game_prev_btn');
    const canceled_game_next_btn = document.querySelector('#canceled_game_next_btn');
    
    canceled_game_next_btn.addEventListener('click', canceled_game_next_slide);
    canceled_game_prev_btn.addEventListener('click', canceled_game_prev_slide);

    function canceled_game_next_slide(){
        let cardwidth = canceled_game_cards[0].scrollWidth;
        canceled_game_slider_container.scrollBy(cardwidth,0);
    }
    function canceled_game_prev_slide(){
        let cardwidth = canceled_game_cards[0].scrollWidth;
        canceled_game_slider_container.scrollBy(-cardwidth,0);
    }
//end canceled game slider//