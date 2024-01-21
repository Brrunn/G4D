window.addEventListener('DOMContentLoaded', (event) => {
    // Animation slide-up
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

    // Script pour le menu mobile
    const checkbox = document.getElementById('check');
    const navigation = document.querySelector('.navigation');

    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            navigation.style.display = 'flex';
        } else {
            navigation.style.display = 'none';
        }
    });

    // Script pour le forum
    var acc = document.getElementsByClassName("question");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            this.parentElement.classList.toggle("active");
            var reponse = this.nextElementSibling;

            if (reponse.style.display === "block") {
                reponse.style.display = "none";
            } else {
                reponse.style.display = "block";
            }
        });
    }
});
