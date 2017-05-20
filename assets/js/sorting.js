function sortingRecipes() {
    var form = document.getElementById('filter-submit');
    var submit = document.getElementById('submit');

    submit.onclick = function () {
        var recipe = document.getElementsByClassName('spotlight-recipe');
        var myFilters = form.elements['myFilters'];
        var filters = [];

        for (var i = 0; i < recipe.length; i += 1) {
            recipe[i].style.display = 'none';
        }
        for (i = 0; i < myFilters.length; i++) {
            if (myFilters[i].checked === true)
                filters.push(myFilters[i].value);
        }
        for (var y = 0; y < recipe.length; y += 1 ) {
            for(var x = 0; x < filters.length; x += 1) {
                if (recipe[y].classList.contains(filters[x])) {
                    recipe[y].style.display = 'flex';
                }
            }
        }
    };
}

function sortingBaskets() {
    var baskets = document.querySelectorAll('.desc_basket');
    var category = document.querySelectorAll('.category');
    var details = document.querySelector('#details');
    var clickBasketMobile = document.querySelector('.click-basket-mobile');
    var clickBasketDesktop = document.querySelector('.click-basket-desktop');

    for (var i = 0; i < baskets.length; i++) {
        baskets[i].onclick = function () {
            var ingreHide = document.querySelectorAll('.ingredient');
            var idShow = this.getAttribute('id');
            var ingreShow = document.getElementsByClassName(idShow);

            details.style.display = 'flex';
            clickBasketMobile.style.display = 'none';
            clickBasketDesktop.style.display = 'none';

            for (var i = 0; i < ingreHide.length; i += 1) {
                ingreHide[i].style.display = 'none';
            }
            for (var i = 0; i < ingreShow.length; i += 1) {
                ingreShow[i].style.display = 'flex';
            }
        };
    }

    for(var y = 0; y < category.length; y++) {
        category[y].onclick = function(){
            var ingreHide = document.querySelectorAll('.ingredient');
            var basketHide = document.querySelectorAll('.basket');
            var idShow = this.getAttribute('id');
            var basketShow = document.getElementsByClassName(idShow);
            
            for (var i = 0; i < ingreHide.length; i += 1) {
                ingreHide[i].style.display = 'none';
            }
            for (var i = 0; i < basketHide.length; i += 1) {
                basketHide[i].style.display = 'none';
            }
            for (var i = 0; i < basketShow.length; i += 1) {
                basketShow[i].style.display = 'flex';
            }
        };
    }

    $('.category').on('click', function () {
        var page = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(page).offset().top}, speed); // Go
        return false;
    });
    $('.basket').on('click', function () {
        var page = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(page).offset().top}, speed); // Go
        return false;
    });
}