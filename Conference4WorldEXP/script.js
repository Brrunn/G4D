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