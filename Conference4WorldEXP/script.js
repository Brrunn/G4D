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


// barre recherche 
  function search() {
    var userInput = document.getElementById("searchInput").value.trim();

    if (userInput === "") {
        document.getElementById("resultMessage").innerHTML = "Veuillez écrire votre requête.";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            if (result === "NoResult") {
                document.getElementById("resultMessage").innerHTML = "Aucun résultat.";
            } else {
                document.getElementById("resultMessage").innerHTML = "Résultat : " + result;
            }
        }
    };

    xhr.open("GET", "search.php?query=" + userInput, true);
    xhr.send();
}

        
