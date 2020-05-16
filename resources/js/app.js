import { slides, nextButton, prevButton, header, hamburger, hamburgerTop, hamburgerMiddle, hamburgerBottom, nav, toTopBtn, toTopLink, subList, menuLink, subMenus, subMenuTrigger, subMenuArrow, changeBrightness, headerArrow } from "./modules/elements.js";


// DROPDOWN MENU
function closeOpenedMenus() {
    for(let i = 0; i < subList.length; i++) {
        subList[i].classList.remove("show-dropdown");
    }
}

for(let i = 0; i < menuLink.length; i++) {
    function dropdownMenu(e) {
        const open = !subList[i].classList.contains("show-dropdown");

        e.preventDefault();

        closeOpenedMenus();
    
        if(open) {
            subList[i].classList.add("show-dropdown");
            headerArrow.classList.add("rotate-arrow");
        }
    }
    
    menuLink[i].addEventListener("click", dropdownMenu);
}

// fechar dropdown quando carregamos fora dele 
function closeClickOutside(e) {
    for(let i = 0; i < subList.length; i++) {

        if (!e.target.matches(".sub-list-trigger")) {
            if (subList[i].classList.contains("show-dropdown")) {
                subList[i].classList.remove("show-dropdown");
            }
    
            if(headerArrow.classList.contains("rotate-arrow")) {
                headerArrow.classList.remove("rotate-arrow");
            }
        }
    }
}

window.addEventListener("click", closeClickOutside);


// SLIDESHOW
if(nextButton != null && prevButton != null) {
    let slideIndex = 1;

    function playSlides(n) {    
        if (n > slides.length) {
            slideIndex = 1;
        }
        
        if (n < 1) {
            slideIndex = slides.length;
        }

        for(let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        
        slides[slideIndex - 1].style.display = "flex";
    }

    function nextSlide() {
        playSlides(slideIndex += 1);
    }

    function prevSlide() {
        playSlides(slideIndex -= 1);
    }

    nextButton.addEventListener("click", nextSlide);
    prevButton.addEventListener("click", prevSlide);

    playSlides(slideIndex);
}


// HEADER EFFECT
function headerShadow() {
    if(document.body.scrollTop >= 67.6 || document.documentElement.scrollTop >= 67.6) {
        header.classList.add("shadow");
    } else {
        header.classList.remove("shadow");
    }
}

document.addEventListener("scroll", headerShadow);


// HAMBURGER
function hamburgerMenu() {
    hamburgerTop.classList.add("top-transform");
    hamburgerMiddle.classList.add("middle-transform");
    hamburgerBottom.classList.add("bottom-transform");

    nav.classList.toggle("navbar-show");
    changeBrightness.classList.toggle("change-brightness");

    if(!nav.classList.contains("navbar-show")) {
        hamburgerTop.classList.remove("top-transform");
        hamburgerMiddle.classList.remove("middle-transform");
        hamburgerBottom.classList.remove("bottom-transform");
    }
}

hamburger.addEventListener("click", hamburgerMenu);


// BACK-TO-TOP
function backToTop() {
    if(document.body.scrollTop >= 60 || document.documentElement.scrollTop >= 60) {
        return toTopBtn.classList.add("back-to-top-show");
    } else {
        return toTopBtn.classList.remove("back-to-top-show");
    }
}

document.addEventListener("scroll", backToTop);


// SMOOTH SCROLL
if(toTopLink != null) {
    function smoothScroll(e) {
        window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth"
        });
    
        e.preventDefault();
    }
    
    toTopLink.addEventListener("click", smoothScroll);
}


// ADMIN AND PROFILE AREA MENU
for(let i = 0; i < subMenuTrigger.length; i++) {
    function adminDropDown(e) {
    
        subMenus[i].classList.toggle("show-sub-menu");
        subMenuArrow[i].classList.toggle("rotate-arrow");
        
        e.preventDefault();
    }

    subMenuTrigger[i].addEventListener("click", adminDropDown);
}   


tinymce.init({
    selector: '#content',
    plugins: 'link casechange linkchecker autolink lists checklist image media mediaembed pageembed link permanentpen powerpaste table advtable tinymcespellchecker',
    toolbar: 'image casechange numlist bullist formatpainter pageembed link permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    height: "380"
});