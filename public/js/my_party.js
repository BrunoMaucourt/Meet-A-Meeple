const tabs_btns = document.querySelectorAll('.tab_btn')
const games_container = document.querySelectorAll('.games_container')
let default_btn = 0;

for (let i = 0; i < tabs_btns.length; i++) {
    tabs_btns[i].addEventListener('click',()=>{
        if(!tabs_btns[i].classList.contains('active')){
            tabs_btns[default_btn].classList.toggle('active');
            tabs_btns[i].classList.toggle('active');
            tabs_btns[i].classList.toggle('bg-main-orange/70');
            tabs_btns[i].classList.toggle('text-white');
            tabs_btns[default_btn].classList.toggle('bg-main-orange/70');
            tabs_btns[default_btn].classList.toggle('text-white');

            games_container[default_btn].classList.toggle('hidden');
            games_container[default_btn].classList.toggle('flex');
            games_container[i].classList.toggle('hidden');
            games_container[i].classList.toggle('flex');
    
            default_btn = i;  
        }
    }) 
}