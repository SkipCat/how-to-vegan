window.onload = function() {
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

/*
    buttonAdProduct.onclick = function(event) {
        event.preventDefault();
        var newProduct = form.insertBefore(product[0], buttonAdProduct);
        return false;
    };
*/

    form.onsubmit = function() {
        console.log('form submitted');
    };
}