$(function() {
    var buttonAddProduct = $('#add-product');
    var product = $('select');
    var shoppingList = [];
    var alreadyExist = []; 

    var filter = $('input[type="checkbox"]');
    var listFilters = [];

    // get chosen filters
    filter.each(function() {
        $(this).click(function() {
            if ($(this).is(':checked') == true) {
                listFilters.push($(this).val());
            }
        });
    });
    // remove unchecked filters from list

    // add new product clicking on button
    buttonAddProduct.on('click', function() {
        var newProduct = product.clone().insertBefore(this); // insert select before button
        newProduct.after('<br>'); // add space after new select

        // for new selects
        newProduct.each(function() {
            $(this).on('click', function() {
                if ($(this).val() != 'NULL') {
                    for (var i = 0; i < shoppingList.length; i ++) {
                        alreadyExist.push(shoppingList[i]);
                    }

                    if ($.inArray($(this).val(), alreadyExist) == -1) { // product not found in array
                        shoppingList.push($(this).val());
                        console.log('list:', shoppingList, shoppingList.length);
                    }
                    else {
                        console.log('product null or already selected');
                    }
                }
            });
        });
    });
    
    // for 1rst select
    product.each(function() {
        $(this).on('click', function() {
            if ($(this).val() != 'NULL' && shoppingList.length == 0) {
                shoppingList.push($(this).val());
            }
        });
    });

    $('form').on('submit', function() {
        $('form').slideUp(); // OR $('form').hide();

        if (listFilters.length > 0) { // display filters and shopping
            $('#recap-list').html('Your shopping list:<br>' + shoppingList + '<br><br>with filters:<br>' + listFilters); 
        }
        else { // display only shopping list
            $('#recap-list').html('Your shopping list:<br>' + shoppingList);
        }

        return false;
    });

});