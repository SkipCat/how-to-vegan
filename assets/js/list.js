function listActions() {
    var deleteButton = document.querySelector('#img-delete');
    var ul = document.querySelector('.list ul');
    var firstSelect = document.querySelector('.list ul').childNodes[1];
    var recapList = document.querySelector('#recap-list');

    var pinButton = document.querySelector('#img-pin');
    var formPinList = document.forms['form-pin'];
    var inputContent = formPinList.elements['list-content'];
    var btnClose = document.querySelector('#btn-close');
    console.log(pinButton, formPinList, inputContent, btnClose);

    function pinList() {
        var list = document.querySelectorAll('.list select');
        var products = [];
        var stringList = '';

        // get value of each select
        for (var i = 0; i < list.length; i ++) {
            var element = list[i].options[list[i].selectedIndex].value;
            if (element !== 'NULL') {
                products.push(element);
            }
        }

        // concatene all values in one string
        for (var i = 0; i < products.length; i ++) {
            if (i < products.length - 1) {
                    stringList += products[i] + ',';
            }
            else {
                stringList += products[i];
            }
        }

        inputContent.value = stringList;
        formPinList.style.display = 'flex';
    }

    pinButton.onclick = function() {
        pinList();
    };
    btnClose.onclick = function() {
        formPinList.style.display = 'none';
    };

    function deleteList() {
        // remove all select elements from DOM
        while (ul.firstChild) {
            ul.removeChild(ul.firstChild);
        }
        
        // create default select element
        var li = document.createElement('li');
        li.className = 'shop-li';
        //li = ul.insertBefore(li, recapList);
        ul.appendChild(li);
        
        firstSelect.childNodes[1].value = 'NULL';
        li.appendChild(firstSelect);
    }

    deleteButton.onclick = function() {
        deleteList();
    };

}

/* PIN

page profil :
for () // afficher toutes les listes dont username = username du profil
for () // dasn chq liste on split la string et on affiche sous forme de liste

*/