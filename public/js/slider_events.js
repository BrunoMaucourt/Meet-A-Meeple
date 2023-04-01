/*START SLIDER*/
    //start incomming event slider//
        let incomming_event_slider_container = document.querySelector('#incomming_event_slider_container');
        let incomming_event_cards = document.querySelectorAll('.incomming_event_card');
        const incomming_event_card_number = incomming_event_cards.length;
        const incomming_event_prev_btn = document.querySelector('#incomming_event_prev_btn');
        const incomming_event_next_btn = document.querySelector('#incomming_event_next_btn');

        incomming_event_next_btn.addEventListener('click', event_next_slide);
        incomming_event_prev_btn.addEventListener('click',event_prev_slide);
    //end incomming event slider//
/*END SLIDER*/

function event_next_slide(){
    let testslide = incomming_event_cards[0].scrollWidth;
    incomming_event_slider_container.scrollBy(testslide,0);
}
function event_prev_slide(){
    let testslide = incomming_event_cards[0].scrollWidth;
    incomming_event_slider_container.scrollBy(-testslide,0);
}