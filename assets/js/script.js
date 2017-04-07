$(function() {
    var buttonAddProduct = $('#add-product');
    var product = $('select');
    shoppingList = [];

    // add new product clicking on button
    buttonAddProduct.on('click', function() { // error if buttonAddProduct
        var newProduct = product.clone().insertBefore(this); // insert select before button
        newProduct.after('<br>'); // add space after new select
    });

/*
    // add newProduct clicking on product
    $(document).on('click', 'select', function() { 
        var newProduct = product.clone().insertAfter(this);
        newProduct.after('<br>');
    });
*/
    

    product.on('click', function() {
        if (product.val() != 'NULL') {
            shoppingList.push(product.val());
        }
    });

    $('form').on('submit', function() {
        //console.log(shoppingList);
        $('form').slideUp();
        $('#recap-list').text(shoppingList);
    });

});