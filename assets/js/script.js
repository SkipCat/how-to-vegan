$(function() {
    var product = $('select');
    var shoppingList = [];
    var productAlreadyExist = []; 
    
    var filter = $('input[type="checkbox"]');
    var filterList = [];
    var filterAlreadyExist = [];

    // lock buttons by default to avoid empty submitted form
    $('input[type="submit"]').prop('disabled', true);
    $("#add-product").css({'pointer-events': 'none'});

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
        $("#add-product").css({'pointer-events': 'none'}); // lock link

        // for new selects
        newProduct.each(function() {
            $(this).on('click', function() {
                if ($(this).val() != 'NULL' && $.inArray($(this).val(), shoppingList) == -1) {
                // product not NULL and doesn't already exist
                    shoppingList.push($(this).val());
                    $("#add-product").css({'pointer-events': 'auto'}); // unlock link
                }
            });
        });      
    });
    
    // for 1rst select
    product.each(function() {
        $(this).on('click', function() {
            if ($(this).val() != 'NULL' && shoppingList.length == 0) {
                shoppingList.push($(this).val());
                $('input[type="submit"]').prop('disabled', false); // unlock button submit
                $("#add-product").css({'pointer-events': 'auto'});
            }
        });
    });

    $('form').on('submit', function() {
        $('form').slideUp(); // OR $('form').hide();

        $.ajax({
            url: 'assets/json/list.json',//'?action=adminlogin'
            type: 'GET',
            dataType: 'json',
            success: function(result) { // CAUTION: json already parsed
                for (var i in result) {
                    for(var j in shoppingList) {
                        if (i == shoppingList[j]) {
                            $('#recap-list').html('Your shopping list:<br>');
                            
                            if (filterList.length > 0) { // if filter(s) checked
                                 $('#recap-list').append(result[i].Vegan + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
                                //$('#recap-list').html('Your shopping list:<br>' + shoppingList + '<br><br>with filters:<br>' + filterList); 
                            }
                            else {
                                $('#recap-list').append(result[i].Vegan + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
                                //$('#recap-list').html('Your shopping list:<br>' + shoppingList);
                            }
                           
                        }
                    }
                }
            },
            error: function(err, stat, mess) {
                console.log('an error occurred');
                console.log(err, stat, mess);
            }
        });

        return false;
    });

});