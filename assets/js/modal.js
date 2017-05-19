function modalActions() {
    var btnOpenModal = document.querySelectorAll('.open-modal');

    var body = document.querySelector('body');
    var header = document.querySelector('header');
    var footerMobile = document.querySelector('#footer-mobile');
    var footerDesktop= document.querySelector('#footer-desktop');
    var blur = document.querySelectorAll('.blur');
    
    function openModal() {
        body.style.overflow = 'hidden';

        header.classList.add('blur-elements');
        footerMobile.classList.add('blur-elements');
        footerDesktop.classList.add('blur-elements');
        
        for (var i = 0; i < blur.length; i ++) {
            blur[i].classList.add('blur-elements');
        }
    }

    function closeModal() {
        body.style.overflow = 'auto';

        header.classList.remove('blur-elements');
        footerMobile.classList.remove('blur-elements');
        footerDesktop.classList.remove('blur-elements');

        for (var i = 0; i < blur.length; i ++) {
            blur[i].classList.remove('blur-elements');
        }
    }

    for (var i in btnOpenModal) {
        btnOpenModal[i].onclick = function() {
            openModal();
        };
        var btnCloseModal = document.querySelector('.btn-close');
        btnCloseModal.onclick = function() {               
            closeModal();
        };
    }
}