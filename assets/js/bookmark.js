window.onload = function() {
//function getCurrentPage() {
    var currentPage = window.location.href;
    var convertLink = document.querySelector('#convert-page');
    var basketLink = document.querySelector('#basket-page');
    var recipeLink = document.querySelector('#recipe-page');
    var aboutLink = document.querySelector('#about-page');

    if (currentPage.search('home') !== -1) {
        document.querySelector('header').id = 'header-home';
        convert();
        listActions();
        crush();
    }
    if (currentPage.search('convert') !== -1) {
        convertLink.id = 'active-page';
        convertLink.parentNode.childNodes[1].id = 'bookmark';
        document.querySelector('header').id = 'header-convert';
        convert();
        listActions();
    }
    if (currentPage.search('basket') !== -1) {
        basketLink.id = 'active-page';
        basketLink.parentNode.childNodes[1].id = 'bookmark';
        document.querySelector('header').id = 'header-basket';
    }
    if (currentPage.search('recipe') !== -1) {
        recipeLink.id = 'active-page';
        recipeLink.parentNode.childNodes[1].id = 'bookmark';
        document.querySelector('header').id = 'header-recipe';
        crush();
    }
    if (currentPage.search('about') !== -1) {
        aboutLink.id = 'active-page';
        aboutLink.parentNode.childNodes[1].id = 'bookmark';
        //document.querySelector('header').id = 'header-about';
    }
    if (currentPage.search('modal') !== -1) {
        document.querySelector('header').className = 'header-modal';
    }
};