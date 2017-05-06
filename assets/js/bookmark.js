window.onload = function() {
    var currentPage = window.location.href;
    var convertLink = document.querySelector('#convert-page');
    var basketLink = document.querySelector('#basket-page');
    var recipeLink = document.querySelector('#recipe-page');
    var aboutLink = document.querySelector('#about-page');

    if (currentPage.search('convert') !== -1) {
        convertLink.id = 'active-page';
    }
    if (currentPage.search('basket') !== -1) {
        basketLink.id = 'active-page';
    }
    if (currentPage.search('recipe') !== -1) {
        recipeLink.id = 'active-page';
    }
    if (currentPage.search('about') !== -1) {
        aboutLink.id = 'active-page';
    }
};
