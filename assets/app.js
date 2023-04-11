/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';



/******** START HEADER********/

let header = document.querySelector('header');
let body = document.querySelector('body');
let site_title = document.querySelector('#site_title');
const btn_auto_scroll = document.getElementById("btn_auto-scroll_top");

/*START ANIMATION MENU*/
window.addEventListener('resize', () => {
    if (body.offsetWidth < 1280) {
        site_title.style.transform = "scale(1) translateY(0px)";
        site_title.style.transition = "all 1s ease";
    } else if (body.offsetWidth > 1280 && scrollY < 40) {
        site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
        header.style.boxShadow = "none";
        header.style.transition = "all 1.5s ease";
        site_title.style.transition = "all 1s ease";
    }
})

document.addEventListener('scroll', () => {
    if (scrollY > 40 && body.offsetWidth > 1280) {
        site_title.style.transform = "scale(1) translateY(0px)";
        site_title.style.transition = "all 1s ease";
        header.style.boxShadow = "2px 0px 2px black";
        header.style.transition = "all 1.5s ease";
    } else if (scrollY < 40 && body.offsetWidth > 1280) {
        site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
        site_title.style.transition = "all 1s ease";
        header.style.boxShadow = "none";
        header.style.transition = "all 1.5s ease";
    } else if (body.offsetWidth < 1280 && scrollY < 40) {
        header.style.boxShadow = "none";
        header.style.transition = "all 1.5s ease";
    } else {
        header.style.boxShadow = "2px 0px 2px black";
        header.style.transition = "all 1.5s ease";
    }

    if(scrollY > 100){
        btn_auto_scroll.classList.remove("hidden");
        header.style.transition = "all 1.5s ease";
    }else{
        btn_auto_scroll.classList.add("hidden");
        header.style.transition = "all 1.5s ease";
    }
})
/*END ANIMATION MENU*/

/* START BURGER MENU */
const open_mobile_menu_btn = document.querySelector('#mobile-open-button');
const close_mobile_menu_btn = document.querySelector('#mobile-close-button');
const mobile_menu = document.querySelector('#mobile-menu');
let isMobileMenuVisible = false;

function toggleMenu() {
    mobile_menu.classList.toggle('hidden');
    mobile_menu.classList.toggle('flex');
    if (isMobileMenuVisible) {
        isMobileMenuVisible = false;
    } else {
        isMobileMenuVisible = true;
    }
}

open_mobile_menu_btn.addEventListener('click', toggleMenu);
close_mobile_menu_btn.addEventListener('click', toggleMenu);
/* END BURGER MENU */

/*START PROFIL MENU*/
const profil_menu_buttons = document.querySelectorAll('.profil-menu-button');
const profil_menu = document.querySelector('#profil-menu');
let isProfilMenuVisible = false;

function toggleProfilMenu() {
    profil_menu.classList.toggle('hidden');
    profil_menu.classList.toggle('flex');

    if (isProfilMenuVisible) {
        isProfilMenuVisible = false;
    } else {
        isProfilMenuVisible = true;
    }
}

profil_menu_buttons.forEach(element => {
    element.addEventListener('click', toggleProfilMenu);
});

document.addEventListener('click', (e) => {
    if (e.target.id !== "profil-menu" && !e.target.classList.contains("profil-menu-button") && isProfilMenuVisible) {
        toggleProfilMenu();
    } else if (e.target.id !== "mobile-menu" && e.target.id !== "mobile-open-button" && isMobileMenuVisible) {
        toggleMenu();
    }
})
/*END PROFIL MENU*/
/********END HEADER********/


/******** Start FOOTER ********/

// Social media
const logo_facebook = document.querySelector("#logo_facebook");
const logo_twitter = document.querySelector("#logo_twitter");
const logo_instagram = document.querySelector("#logo_instagram");

logo_facebook.addEventListener("mouseover", function () {
    logo_facebook.src = '/img/social_icon/LogoFacebookOrange.svg';
});
logo_facebook.addEventListener("mouseout", function () {
    logo_facebook.src = '/img/social_icon/LogoFacebookWhite.svg';
});

logo_twitter.addEventListener("mouseover", function () {
    logo_twitter.src = '/img/social_icon/LogoTwitterOrange.svg';
});
logo_twitter.addEventListener("mouseout", function () {
    logo_twitter.src = '/img/social_icon/LogoTwitterWhite.svg';
});

logo_instagram.addEventListener("mouseover", function () {
    logo_instagram.src = '/img/social_icon/LogoInstagramOrange.svg';
});
logo_instagram.addEventListener("mouseout", function () {
    logo_instagram.src = '/img/social_icon/LogoInstagramWhite.svg';
});

/******** End FOOTER ********/

/******** End auto-scroll ********/

btn_auto_scroll.addEventListener('click', function(){
    let size = document.body.scrollHeight;
    let currentPosition = window.scrollY;
    let newCurrentPosition = currentPosition;

    let refreshId = setInterval(function() {
        newCurrentPosition -= 15;
        window.scrollTo(0, newCurrentPosition);
        currentPosition = newCurrentPosition;
        if (currentPosition < 15) {
          clearInterval(refreshId);
        }
      }, 10);
});

/******** End auto-scroll ********/