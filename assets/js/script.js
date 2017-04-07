window.onload = function() {
    var form = document.querySelector("form");
    var product = document.querySelectorAll("select");
    var listProducts = [];
    var buttonAdProduct = document.querySelector("#add-product");

    for (var i = 0; i < product.length; i ++) {
        listProducts.push(product[i].value);
        console.log(product[i].value);
    }

    buttonAdProduct.onclick = function(event) {
        event.preventDefault();
        var newProduct = form.insertBefore(product[0], buttonAdProduct);
        return false;
    };

    form.onsubmit = function() {
        console.log('form submitted');
    };
}