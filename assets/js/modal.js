function openModal() {
    var modal = document.querySelectorAll('.open-modal img');
    
    for (var i in modal) {
        modal[i].onclick = function() {
            // open modal
        };
    }

}