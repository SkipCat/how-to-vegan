$(function() {
    var product = $('select');
    var shoppingList = [];
    var productAlreadyExist = [];

    var filter = $('input[type="checkbox"]');
    var filterList = [];

    // lock buttons by default to avoid empty submitted form
    $('input[type="submit"]').prop('disabled', true);

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

    function createSelect() {
        var newProduct = product.clone().insertBefore($('input[type="submit"]')).after('<br>');
        newProduct.each(function() {
            $(this).on('click', function() {
                if ($(this).val() != 'NULL' && $.inArray($(this).val(), shoppingList) == -1) {
                // product not NULL and doesn't already exist
                    shoppingList.push($(this).val());
                    createSelect();
                }
            });
        });
    }

    // for 1rst select
    product.each(function() {
        $(this).on('click', function() {
            if ($(this).val() != 'NULL' && shoppingList.length == 0) {
                shoppingList.push($(this).val());
                $('input[type="submit"]').prop('disabled', false); // unlock button submit
                createSelect();
            }
        });
    });

    // form submit and conversion
    $('form').on('submit', function() {
        $('form').slideUp(); // OR $('form').hide();

        $.ajax({
            url: 'assets/json/list.json',//'?action=adminlogin'
            type: 'GET',
            dataType: 'json',
            success: function(result) { // CAUTION: json already parsed
                $('#recap-list').append('Votre liste de courses : <br><br>');
                console.log(filterList);

                for (var i in result) {
                    for(var j in shoppingList) {
                        if (i == shoppingList[j]) {
                            if (filterList.length > 0) { // if filter(s) checked
                                if ($.inArray('Bio', filterList) !== -1 && $.inArray('Gluten-free', filterList) !== -1) {
                                    if (result[i].BG == "NULL") {
                                        $('#recap-list').append('Ce produit n\'existe pas pour les filtres sélectionnés. Equivalent vegan de base : ' + result[i].vegan + '<br>');
                                    }
                                    else {
                                         $('#recap-list').append(result[i].BG + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
                                    }
                                }
                                else if ($.inArray('Bio', filterList) !== -1) {
                                    $('#recap-list').append(result[i].bio + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
                                }
                                else if ($.inArray('Gluten-free', filterList) !== -1) {
                                    $('#recap-list').append(result[i].gluten + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
                                }
                            }
                            else {
                                $('#recap-list').append(result[i].vegan + '<br>'); // DISPLAY FIRST PRODUCT AS LAST
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
