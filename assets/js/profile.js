function displaySavedList() {
    var btnSeeList = document.querySelectorAll('.btn-see-list');

    for (var i = 0; i < btnSeeList.length; i ++) {
        btnSeeList[i].onclick = function() {
            (this.previousElementSibling).style.display = 'block';
            this.style.display = 'none';
        };
    }
}