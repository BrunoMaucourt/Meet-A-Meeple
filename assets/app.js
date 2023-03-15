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



/******** START FOOTER********/

    let header = document.querySelector('header');
    let body = document.querySelector('body');
    let site_title = document.querySelector('#site_title');

    /*START ANIMATION MENU*/
    window.addEventListener('resize',()=>{
        if(body.offsetWidth < 1280){
            site_title.style.transform = "scale(1) translateY(0px)";
            site_title.style.transition = "all 1s ease";
        }else if(body.offsetWidth > 1280 && scrollY < 80){
            site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
            header.style.boxShadow = "none";
            header.style.transition = "all 1.5s ease";
            site_title.style.transition = "all 1s ease";
        }
    })

    document.addEventListener('scroll', ()=>{
        if(scrollY>80 && body.offsetWidth>1280){
            site_title.style.transform = "scale(1) translateY(0px)";
            site_title.style.transition = "all 1s ease";
            header.style.boxShadow = "2px 0px 2px black";
            header.style.transition = "all 1.5s ease";    
        }else if(scrollY<80 && body.offsetWidth>1280){
            site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
            site_title.style.transition = "all 1s ease";
            header.style.boxShadow = "none";
            header.style.transition = "all 1.5s ease"; 
        }else if(body.offsetWidth < 1280 && scrollY < 80){
            header.style.boxShadow = "none";
            header.style.transition = "all 1.5s ease";
        }else{
            header.style.boxShadow = "2px 0px 2px black";
            header.style.transition = "all 1.5s ease";
        }
    }) 
    /*END ANIMATION MENU*/ 

    /* START BURGER MENU */
    const open_mobile_menu_btn = document.querySelector('#mobile-open-button');
    const close_mobile_menu_btn = document.querySelector('#mobile-close-button');
    const mobile_menu = document.querySelector('#mobile-menu');
    let isMobileMenuVisible = false;

    function toggleMenu(){
        mobile_menu.classList.toggle('hidden');
        mobile_menu.classList.toggle('flex');
        console.log(isMobileMenuVisible);
        if(isMobileMenuVisible){
            isMobileMenuVisible = false;
        }else{
            isMobileMenuVisible = true;
        }
    }

    open_mobile_menu_btn.addEventListener('click',toggleMenu);
    close_mobile_menu_btn.addEventListener('click',toggleMenu);
    /* END BURGER MENU */

    /*START PROFIL MENU*/
    const profil_menu_button = document.querySelector('#profil-menu-button');
    const profil_menu = document.querySelector('#profil-menu');
    let isProfilMenuVisible = false;

    function toggleProfilMenu(){
        profil_menu.classList.toggle('hidden');
        profil_menu.classList.toggle('flex');

        if(isProfilMenuVisible){
            isProfilMenuVisible = false;
        }else{
            isProfilMenuVisible = true;
        }
    }

    profil_menu_button.addEventListener('click',toggleProfilMenu);

    document.addEventListener('click',(e)=>{
        if(e.target.id !== "profil-menu" && e.target.id !== "profil-menu-button" && isProfilMenuVisible){
            toggleProfilMenu();
        }else if(e.target.id !== "mobile-menu" && e.target.id !== "mobile-open-button" && isMobileMenuVisible){
            toggleMenu();
        }
    })
    /*END PROFIL MENU*/
/********END FOOTER********/