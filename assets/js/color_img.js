window.onload = function() {
    var heart = document.querySelectorAll('.crush img');
    var openModal = document.querySelectorAll('.open-modal img');
    console.log(heart, openModal);

    var modalYellow = document.createElement('img');
    modalYellow.src = 'assets/img/open_modal_yellow.png';
    var heartRed = document.createElement('img');
    heartRed.src = 'assets/img/heart_red.png';

    var clickHeart = false;
    var heartRedList = [];
    
    for (var i = 0; i < heart.length; i ++) {
        heart[i].onclick = function() {
            if (clickHeart == false) {
                this.parentNode.append(heartRed);
                this.style.display = 'none';

                clickHeart = true;
                heartRedList.push(heartRed);
            }
            else {
                console.log('else');
                for (var j = 0; j < heartRedList.length; j ++) {
                    heartRedList[j].style.display = 'block';
                    this.style.display = 'none';
                    clickHeart = false;
                }
            }
        };
    }
    /*
    heart.onclick = function() {
        if (clickHeart == false) {
            heart.parentNode.append(heartRed);
            heart.style.display = 'none';
            clickHeart = true;
        }
        else {
            heartRed.style.display = 'block';
            heart.style.display = 'none';
            clickHeart = false;
        }
    };
    heartRed.onclick = function() {
        heart.style.display = 'block';
        heartRed.style.display = 'none';
    };
    */

    var clickModal = false;
    openModal.onclick = function() {
        if (clickModal == false) {
            openModal.parentNode.append(modalYellow);
            openModal.style.display = 'none';
            clickModal = true;
        }
        else {
            modalYellow.style.display = 'block';
            openModal.style.display = 'none';
            clickModal = false;
        }
    };
    modalYellow.onclick = function() {
        openModal.style.display = 'block';
        modalYellow.style.display = 'none';
    };

};