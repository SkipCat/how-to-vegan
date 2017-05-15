function openModal() {
    document.querySelector('body').style.overflow = 'hidden';
    document.querySelector('header').classList.add('blur-elements');
    document.querySelector('main').classList.add('blur-elements');
    document.querySelector('footer').classList.add('blur-elements');
}
function hideModal() {
    document.querySelector('body').style.overflow = 'auto';
    document.querySelector('header').classList.remove('blur-elements');
    document.querySelector('main').classList.remove('blur-elements');
    document.querySelector('footer').classList.remove('blur-elements');
}

function modalActions() {
    var btnOpenModal = document.querySelectorAll('.open-modal');
    var btnCloseModal = document.querySelector('.btn-close');
    
    for (var i in btnOpenModal) {
        btnOpenModal[i].onclick = function() {
            openModal();
        };
    }

    btnCloseModal.onclick = function() {
        hideModal();
    };
}