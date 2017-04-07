$(function() {
    var buttonAdProduct = document.querySelectorAll('select');
    var product = $('select');
    var text = $('input[type="text"]');
    console.log(text);

    $(document).on('click', '#add-product', function() {
        product.clone().insertAfter(text); // add <br> ?
    });

});