function anchor() {
    $('.category').on('click', function () {
        var page = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(page).offset().top}, speed); // Go
        return false;
    });
}