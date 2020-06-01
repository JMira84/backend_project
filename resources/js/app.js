// DROPDOWN MENU
const subList = document.querySelectorAll(".sub-list");
const menuLink = document.querySelectorAll(".sub-list-trigger");

const headerArrow = document.querySelector(".header-arrow");

function closeOpenedMenus() {
    for(let i = 0; i < subList.length; i++) {
        subList[i].classList.remove("show-dropdown");
    }
}

for(let i = 0; i < menuLink.length; i++) {

    function dropdownMenu(e) {
        if(subList[i] != null) {
            const open = !subList[i].classList.contains("show-dropdown");
        
            e.preventDefault();

            closeOpenedMenus();
        
            if(open) {
                subList[i].classList.add("show-dropdown");
                headerArrow.classList.add("rotate-arrow");
            } else {
                subList[i].classList.remove("show-dropdown");
                headerArrow.classList.remove("rotate-arrow");
            }
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
const nextButton = document.querySelector(".next-arrow");
const prevButton = document.querySelector(".prev-arrow");

if(nextButton != null && prevButton != null) {
    
    const slides = document.querySelectorAll(".slides");

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
const header = document.querySelector("header");

function headerShadow() {
    if(document.body.scrollTop >= 67.6 || document.documentElement.scrollTop >= 67.6) {
        header.classList.add("shadow");
    } else {
        header.classList.remove("shadow");
    }
}

document.addEventListener("scroll", headerShadow);


// HAMBURGER
const hamburger = document.querySelector(".hamburger");
const nav = document.querySelector(".navbar");
const hamburgerTop = document.querySelector(".top");
const hamburgerMiddle = document.querySelector(".middle");
const hamburgerBottom = document.querySelector(".bottom");
const changeBrightness = document.querySelector(".brightness-effect");

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
const toTopBtn = document.querySelector(".back-to-top");
const toTopLink = document.querySelector(".back-to-top a");

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
const subMenuTrigger = document.querySelectorAll(".sub-menu-trigger");
const subMenus = document.querySelectorAll(".sub-menu");
const subMenuArrow = document.querySelectorAll(".sub-menu-arrow");

for(let i = 0; i < subMenuTrigger.length; i++) {
    function adminDropDown(e) {
    
        subMenus[i].classList.toggle("show-sub-menu");
        subMenuArrow[i].classList.toggle("rotate-arrow");
        
        e.preventDefault();
    }

    subMenuTrigger[i].addEventListener("click", adminDropDown);
}   


// ALERT MESSAGE REMOVE
const textArea = document.querySelectorAll(".text-area");
const alertMessage = document.querySelector(".alert-message-container");
const successMessage = document.querySelector(".success-message-container");

if(textArea != null) {
    for(text of textArea) {
        text.addEventListener("focus", () => {
            if(alertMessage) {
                alertMessage.remove();
            } else if(successMessage) {
                successMessage.remove();
            }
        });
    }
}


// RICH TEXT EDITOR
tinymce.init({
    selector: '#content',
    plugins: 'link casechange linkchecker autolink lists checklist image media mediaembed pageembed link permanentpen powerpaste table advtable tinymcespellchecker emoticons wordcount',
    toolbar: 'undo redo styleselect casechange wordcount image emoticons numlist bullist formatpainter pageembed link permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    height: "380"
});



function modalMessage(text) {
    const message = document.querySelectorAll(".message");
    const messageContent = document.querySelectorAll(".message-content");
    const modalButton = document.querySelectorAll(".modal-button");

    for (let i = 0; i < message.length; i++) {
        message[i].classList.add("show-message");
        messageContent[i].textContent = text;
        changeBrightness.classList.add("change-brightness");

        modalButton[i].addEventListener("click", () => {
            message[i].classList.remove("show-message");
            changeBrightness.classList.remove("change-brightness");
        });
    }
}

const crudButtons = document.querySelectorAll(".crud-button");

for (let button of crudButtons) {
    button.addEventListener("click", () => {

        const removeArticle = "/admin/delete_article/" + button.parentNode.dataset.article_id;
        const removeUser = "/admin/delete_user/" + button.parentNode.dataset.user_id;

        const addAdmin = "/admin/add_admin/" + button.parentNode.dataset.user_id;
        const removeAdmin = "/admin/remove_admin/" + button.parentNode.dataset.user_id;

        if (button.parentNode.classList.contains("delete-article")) {
            fetch(removeArticle, {
                "method": "DELETE",
                "headers":{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "credentials": "same-origin"
            })
            .then(response => response.text())
            .then(result => {
                if(result) {
                    button.parentNode.remove();

                    const text = "Artigo eliminado com sucesso!"

                    modalMessage(text);
                }
            })
            .catch(err => console.log(err));
            
        } else if (button.parentNode.classList.contains("delete-user")) {
            fetch(removeUser, {
                "method": "DELETE",
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "credentials": "same-origin"
            })
            .then(response => response.text())
            .then(result => {
                if (result) {
                    button.parentNode.remove();

                    const text = "Utilizador eliminado com sucesso!"

                    modalMessage(text);
                }
            })
            .catch(err => console.log(err));

        } else if (button.parentNode.classList.contains("add-admin")) {
            fetch(addAdmin, {
                "method": "PUT",
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "credentials": "same-origin"
            })
            .then(response => response.text())
            .then(result => {
                if (result) {
                    button.parentNode.remove();

                    const text = "Administrador adicionado com sucesso!"

                    modalMessage(text);
                }
            })
            .catch(err => console.log(err));

        } else if (button.parentNode.classList.contains("remove-admin")) {
            fetch(removeAdmin, {
                "method": "PUT",
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "credentials": "same-origin"
            })
            .then(response => response.text())
            .then(result => {
                if (result) {
                    button.parentNode.remove();

                    const text = "Administrador removido com sucesso!"

                    modalMessage(text);
                }
            })
            .catch(err => console.log(err));
        }
    });
}