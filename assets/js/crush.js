function crush() {
    var heart = document.querySelectorAll('.btn-crush');
    var clickHeart = false;

    for (var i in heart) {
        heart[i].onclick = function() {
            console.log(this);
            if (clickHeart == false) {
                this.src = 'assets/img/heart_red.png';
                clickHeart = true;
            }
            else {
                this.src = 'assets/img/heart.png';
                clickHeart = false;
            }
        };
    }
}