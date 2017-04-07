$(function() {
    var buttonAddProduct = $('#add-product');
    var product = $('select');
    shoppingList = [];

    // add new product clicking on button
    buttonAddProduct.on('click', function() { // error if buttonAddProduct
        var newProduct = product.clone().insertBefore(this); // insert select before button
        newProduct.after('<br>'); // add space after new select
        console.log($('select'));
    });

/*
    // add newProduct clicking on product
    $('select').on('click', function() { 
        var newProduct = product.clone().insertAfter(this);
        newProduct.after('<br>');
    });
*/

/*
    $('select').each(function() {
        $(this).on('click', function() {
            if ($(this).val() != 'NULL') {
                shoppingList.push($(this).val());
                console.log($(this).val());
            }
        });
    });
*/

    $('select').on('click', function() {
        if ($(this).val() != 'NULL') {
            shoppingList.push($(this).val());
            console.log($(this).val());
        }
    });

    $('form').on('submit', function() {
        $('form').slideUp(); // $('form').hide();
        $('#recap-list').text(shoppingList);
        return false;
    });

});