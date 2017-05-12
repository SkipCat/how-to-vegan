function convert() {
    var formConvert = $('#form-list');
    var product = $('select');
    var filter = $('input[type="checkbox"]');

    var shoppingList = [];
    var filterList = [];
    var disabled = [];

    // lock buttons by default to avoid empty submitted form
    $('.submit input[type="submit"]').prop('disabled', true);

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
        
    function disableOptions() {
        $('option').prop('disabled', false);
        $.each(disabled, function(key, val) {
            $('option[value="' + val + '"]').prop('disabled', true);
        });
    };

    function createSelect() {
        // insert new select in li
        var newProduct = product.clone();
        $('<li></li>').addClass('shop-li').insertBefore($('#recap-list'));
        ($('li').last()).append(newProduct);

        // select click
        newProduct.each(function() {
            $(this).on('click', function() {
                if ($('select').last().val() != 'NULL'){
                    $('input[type="submit"]').prop('disabled', false);
                    createSelect();
                    disabled = [];

                    $('select').each(function(){
                        if($(this).val() != 'NULL'){
                            $('option').prop('disabled', false);
                            disabled.push( $(this).val() );
                        }
                    });
                    disableOptions();
                }
            });
        });
    }

    // for 1rst select
    product.each(function() {
        $(this).on('click', function() {
            if ($(this).val() != 'NULL') {
                $('input[type="submit"]').prop('disabled', false); // unlock button submit

                if ($('select').last().val() != 'NULL'){
                    createSelect();
                    disabled = [];
                    $('select').each(function(){
                        if($(this).val() != 'NULL'){
                            $('option').prop('disabled', false);
                            disabled.push($(this).val());
                        }
                    });
                    disableOptions();
                }
            }
        });
    });

    formConvert.on('submit', function() {
        $('select').each(function(){
            var value =  $(this).find("option:selected").text();
            shoppingList.push(value);
        });

        $.ajax({
            url: 'assets/json/list.json', //'?action=adminlogin'
            type: 'GET',
            dataType: 'json',
            success: function(result) { // CAUTION: json already parsed
                $('.list li').css('display', 'none');

                for (var i in result) {
                    for(var j in shoppingList) {
                        if (i == shoppingList[j]) {
                            if (filterList.length > 0) { // if filter(s) checked
                                if ($.inArray('Bio', filterList) !== -1 && $.inArray('Gluten-free', filterList) !== -1) {
                                    if (result[i].BG == "NULL") {
                                        $('#recap-list').append('<li></li>');
                                        ($('li').last()).after('Ce produit n\'existe pas pour les filtres sélectionnés. Equivalent vegan de base : ' + result[i].vegan + '<br>');
                                    }
                                    else {
                                         $('#recap-list').append('<li></li>');
                                        ($('li').last()).addClass('result-li').append(result[i].BG + '<br>');
                                    }
                                }
                                else if ($.inArray('Bio', filterList) !== -1) {
                                    $('#recap-list').append('<li></li>').addClass('result-li');
                                    ($('li').last()).addClass('result-li').append(result[i].bio + '<br>'); 
                                }
                                else if ($.inArray('Gluten-free', filterList) !== -1) {
                                    ($('li').last()).addClass('result-li').append(result[i].gluten + '<br>');
                                }
                            }
                            else {
                                $('#recap-list').append('<li></li>').addClass('result-li');
                                ($('li').last()).addClass('result-li').append(result[i].vegan + '<br>');
                            }
                        }
                    }
                }
            },
            error: function(err, stat, mess) {
                console.log(err, stat, mess);
            }
        });

        return false;
    });
}
