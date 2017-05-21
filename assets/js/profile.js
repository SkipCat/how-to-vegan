function displaySavedList() {
    var btnSeeList = document.querySelectorAll('.btn-see-list');
    for (var i = 0; i < btnSeeList.length; i ++) {
        btnSeeList[i].onclick = function() {
            (this.previousElementSibling).style.display = 'block';
            this.style.display = 'none';
        };
    }
}

function modifyPassword() {
    var pModify = document.querySelector('.password .link');
    var divModify = document.querySelector('.password div:last-child');

    pModify.onclick = function() {
        divModify.style.display = 'flex';
    };
}