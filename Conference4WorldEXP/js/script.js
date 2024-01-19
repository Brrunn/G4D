window.addEventListener('DOMContentLoaded', (event) => {
    const slideUpElements = document.querySelectorAll('.slide-up');

    const slideUpObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-appear');
                observer.unobserve(entry.target);
            }
        });
    });

    slideUpElements.forEach(element => {
        slideUpObserver.observe(element);
    });
});


// Script pour le forum 

var acc= document.getElementsByClassName("question");
        var i;
        for(i=0; i < acc.length; i++){
            acc[i].addEventListener("click", function(){
                this.classList.toggle("active");
                this.parentElement.classList.toggle("active");
                var reponse = this.nextElementSibling;

                if(reponse.style.display === "block"){
                    reponse.style.display = "none";
                }
                else{
                    reponse.style.display = "block";
                }
            });
        }


// Script parallax

window.addEventListener('scroll', function() {
    var scrollValue = window.scrollY;
    document.querySelector('.hero').style.setProperty('--scroll', scrollValue + 'px');
    document.querySelector('.hero').classList.toggle('active', scrollValue > 0);
});


// Script parallax partie 2

window.addEventListener('scroll', function() {
    if (window.innerWidth > 1100) {
        var scrollValue = window.scrollY;
        var windowHeight = window.innerHeight;
        var parallaxElementsGauche = document.querySelectorAll('.parallaxGauche');
        var parallaxElementsDroite = document.querySelectorAll('.parallaxDroite');

        parallaxElementsGauche.forEach(function(element) {
            var parallaxSpeed = element.getAttribute('data-parallax-speed');
            var translateX = (scrollValue - windowHeight) * parallaxSpeed;
            element.style.transform = 'translateX(' + translateX + 'px)';
        });

        parallaxElementsDroite.forEach(function(element) {
            var parallaxSpeed = element.getAttribute('data-parallax-speed');
            var translateX = -1 * (scrollValue - windowHeight) * parallaxSpeed;
            element.style.transform = 'translateX(' + translateX + 'px)';
        });
    }
});



