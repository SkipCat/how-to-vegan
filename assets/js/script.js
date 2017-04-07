/*window.onload = function() {
    var form = document.querySelector("form");
    var product = document.querySelectorAll("select");
    var listProducts = [];
    var buttonAdProduct = document.querySelector("#add-product");
    console.log(form, product, buttonAdProduct);

    for (var i = 0; i < product.length; i ++) {
        if (product[i].value != "NULL") {
            console.log('troll');
            form.insertBefore(product[0], buttonAdProduct);
        }
        console.log(product[i].value);
    }

    buttonAdProduct.onclick = function(event) {
        console.log('jvklrjglr');
        //event.preventDefault();
        form.insertBefore(product[0], buttonAdProduct);
        //return false;
    };

    form.onsubmit = function() {
        console.log('form submitted');
    };
};
*/

$(function() {
    var buttonAdProduct = document.querySelectorAll('select');
    var product = $('select');
    var text = $('input[type="text"]');
    console.log(text);

    $(document).on('click', '#add-product', function() {
        product.clone().insertAfter(text); // add <br> ?
    });

});