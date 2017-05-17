window.onload = function() {
    var currentPage = window.location.href;
    var header = document.querySelector('header');
    var convertLink = document.querySelector('#convert-page');
    var basketLink = document.querySelector('#basket-page');
    var recipeLink = document.querySelector('#recipe-page');
    var aboutLink = document.querySelector('#about-page');

    if (currentPage.search('home') !== -1) {
        header.id = 'header-home';
        convert();
        listActions();
        crush();
        modalActions();
    }

    if (currentPage.search('convert') !== -1) {
        convertLink.id = 'active-page';
        convertLink.parentNode.childNodes[1].id = 'bookmark';
        header.id = 'header-convert';
        convert();
        listActions();
    }

    if (currentPage.search('basket') !== -1) {
        basketLink.id = 'active-page';
        basketLink.parentNode.childNodes[1].id = 'bookmark';
        header.id = 'header-basket';
        anchor();
    }

    if (currentPage.search('recipe') !== -1) {
        recipeLink.id = 'active-page';
        recipeLink.parentNode.childNodes[1].id = 'bookmark';
        header.id = 'header-recipe';
        crush();
        modalActions();
    }

    if (currentPage.search('profile') !== -1) {
        //header.id = 'header-profile';

        var modifyLink = document.querySelector('#modify-link');
        var pinLink = document.querySelector('#pin-link');
        var favoritesLink = document.querySelector('#favorites-link');

        var modifyContent = document.querySelector('#modify-content');
        var pinContent = document.querySelector('#pin-content');
        var favoritesContent = document.querySelector('#favorites-content');

        modifyLink.onclick = function() {
            location.reload();
        };
        pinLink.onclick = function() {
            location.reload();
        };
        favoritesLink.onclick = function() {
            location.reload();
        };

        if (currentPage.search('pin') !== -1) {
            pinLink.parentNode.id = 'active-tab';
            pinContent.parentNode.id = 'active-content';
        }
        else if (currentPage.search('favorite') !== -1) {
            favoritesLink.parentNode.id = 'active-tab';
            favoritesContent.parentNode.id = 'active-content';
        }
        else { // currentPage.search('modify') !== -1 || nothing
            modifyLink.parentNode.id = 'active-tab';
            modifyContent.parentNode.id = 'active-content';
        }
    }

    if (currentPage.search('about') !== -1) {
        aboutLink.id = 'active-page';
        aboutLink.parentNode.childNodes[1].id = 'bookmark';
        header.id = 'header-about';
    }
    
    if (currentPage.search('modal') !== -1) {
        header.id = 'header-modal';
    }
};