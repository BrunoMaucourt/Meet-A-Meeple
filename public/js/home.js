const div_to_animate = document.querySelector('.div_to_animate');
const img_meeple_zoom = document.querySelector('#meeple_zoom');
const img_glass_animation = document.querySelector('#glass_animation');
const img_pop_meeple_map = document.querySelector('#pop_meeple_map');
const img_chat1 = document.querySelector('#chat1');
const img_chat2 = document.querySelector('#chat2');
const img_chat3 = document.querySelector('#chat3');

const observe_img = new IntersectionObserver((entries)=>{
    entries.forEach((entry) => {
        if (entry.isIntersecting){
            img_meeple_zoom.classList.add('animate-meeple-zoom');
            img_glass_animation.classList.add('animate-glass-animation');
            img_pop_meeple_map.classList.add('animate-pop-meeple-map');
            img_chat1.classList.add('animate-chat1');
            img_chat2.classList.add('animate-chat2');
            img_chat3.classList.add('animate-chat3');
        }else{
            img_meeple_zoom.classList.remove('animate-meeple-zoom');
            img_glass_animation.classList.remove('animate-glass-animation');
            img_pop_meeple_map.classList.remove('animate-pop-meeple-map');
            img_chat1.classList.remove('animate-chat1');
            img_chat2.classList.remove('animate-chat2');
            img_chat3.classList.remove('animate-chat3');
        }
    });
},
{threshold: 0.75}
);

observe_img.observe(div_to_animate);
