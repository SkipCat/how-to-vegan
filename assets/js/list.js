function listActions() {
    var pinButton = document.querySelector('#img-pin');

    var deleteButton = document.querySelector('#img-delete');
    var ul = document.querySelector('.list ul');
    var firstSelect = document.querySelector('.list ul').childNodes[1];
    var recapList = document.querySelector('#recap-list');

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

table list :
- id (AI)
- content
- date
- username

quand on clique sur bouton :
- on récupère toutes les valeurs
- on les concatène avec une virgule dans une string
- on stocke la string dans la table list['content']

page profil :
for () // afficher toutes les listes dont username = username du profil
for () // dasn chq liste on split la string et on affiche sous forme de liste

*/