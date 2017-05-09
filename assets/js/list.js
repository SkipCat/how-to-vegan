// pin/delete/keep list

function listActions() {
    var pinButton = document.querySelector('#img-pin');
    var deleteButton = document.querySelector('#img-delete');
    var keepButton = document.querySelector('#img-list-skip');
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