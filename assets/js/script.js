$(function() {
    var product = $('select');
    var shoppingList = [];
    var productAlreadyExist = []; 
    
    var filter = $('input[type="checkbox"]');
    var filterList = [];
    var filterAlreadyExist = [];

    // get chosen filters
    filter.each(function() {
        $(this).click(function() {
            if ($(this).is(':checked') == true) {
                if (filterList.length == 0) { // 1rst value in array
                    filterList.push($(this).val());
                }
                else { // all other values
                    if ($.inArray($(this).val(), filterList) == -1) {
                        filterList.push($(this).val());
                    }
                }
            }
            else { // unchecked
                if ($.inArray($(this).val(), filterList) != -1) {
                    filterList.splice($.inArray($(this).val(), filterList), 1); // remove filter from array
                }
            }
        });
    });

    // add new product clicking on button
    $('#add-product').on('click', function() {
        var newProduct = product.clone().insertBefore(this); // insert select before button
        newProduct.after('<br>'); // add space after new select

        // for new selects
        newProduct.each(function() {
            $(this).on('click', function() {
                /*
                for (var i = 0; i < shoppingList.length; i ++) {
                    productAlreadyExist.push(shoppingList[i]);
                }
                if ($(this).val() != 'NULL' && $.inArray($(this).val(), productAlreadyExist) == -1) {
                    shoppingList.push($(this).val());
                }
                */
                if ($(this).val() != 'NULL' && $.inArray($(this).val(), shoppingList) == -1) {
                // product not NULL and doesn't already exist
                    shoppingList.push($(this).val());
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

        if (filterList.length > 0) { // if filter(s) checked
            $('#recap-list').html('Your shopping list:<br>' + shoppingList + '<br><br>with filters:<br>' + filterList); 
        }
        else {
            $('#recap-list').html('Your shopping list:<br>' + shoppingList);
        }

        return false;
    });

});