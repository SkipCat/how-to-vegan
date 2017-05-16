function modalActions() {
    var btnOpenModal = document.querySelectorAll('.open-modal');
    var btnCloseModal = document.querySelector('.btn-close');
    
    for (var i in btnOpenModal) {
        btnOpenModal[i].onclick = function() {
            document.querySelector('body').style.overflow = 'hidden';
            document.querySelector('header').classList.add('blur-elements');
            document.querySelector('main').classList.add('blur-elements');
            document.querySelector('#footer-mobile').classList.add('blur-elements');
            document.querySelector('#footer-desktop').classList.add('blur-elements');
        };
    }

    btnCloseModal.onclick = function() {
        document.querySelector('body').style.overflow = 'auto';
        document.querySelector('header').classList.remove('blur-elements');
        document.querySelector('main').classList.remove('blur-elements');
        document.querySelector('#footer-mobile').classList.remove('blur-elements');
        document.querySelector('#footer-desktop').classList.remove('blur-elements');
    };
}