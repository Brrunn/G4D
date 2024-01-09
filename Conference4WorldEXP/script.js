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





// Pour le calendrier :

let Cases = document.getElementsByClassName('case')

let date = new Date();
let year = date.getFullYear();
let month = date.getMonth() + 1;
let day = date.getDate();

const monthName = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

const UP_MONTH = "upMonth"
const DOWN_MONTH = "downMonth"

 
function CALENDRIER_REDUCER(action) {
    switch(action) {
        case UP_MONTH:
            if (month < 12) month++
            else {
                year++
                month = 1
            }
            break;
        case DOWN_MONTH:
            if (month > 1) month--
            else {
                year--
                month = 12
            }
            break;
        default:
            break;
    }
    calendrier(year, month)
}


document.getElementById("avant").onclick = function() {
    CALENDRIER_REDUCER(DOWN_MONTH)
    console.log(month)
}
 

document.getElementById("après").onclick = function() {
    CALENDRIER_REDUCER(UP_MONTH)
    console.log(month)
}


function calendrier (year, month) {
    const monthNb = month + 12 * (year - 2020)
    let cld = [{dayStart: 2, length: 31, year: 2020, month: "janvier"}]
    for (let i = 0; i < monthNb - 1; i++) {
        let yearSimulée = 2020 + Math.floor(i / 12)
        const monthsSimulélongueur = [31, getFévrierLength(yearSimulée), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
        let monthSimuléIndex = (i + 1) - (yearSimulée - 2020) * 12

        cld[i + 1] = {
            dayStart: (cld[i].dayStart + monthsSimulélongueur[monthSimuléIndex - 1]) % 7,
            length: monthsSimulélongueur[monthSimuléIndex],
            year: 2020 + Math.floor((i + 1) / 12),
            month: monthName[monthSimuléIndex]
        }

        if (cld[i + 1].month === undefined) {
            cld[i + 1].month = "janvier"
            cld[i + 1].length = 31
        }

    }

 
    for (let i = 0; i < Cases.length; i++) {
        Cases[i].innerText = ""
    }

    for (let i = 0; i < cld[cld.length - 1].length; i++) {
        Cases[i + cld[cld.length - 1].dayStart].innerText = i + 1
    }

    document.getElementById("calT").innerText = cld[cld.length - 1].month.toLocaleUpperCase() + " " + cld[cld.length - 1].year 

}
calendrier(year, month)


function getFévrierLength(year) {
    if (year % 4 == 0) return 29
    else return 28
}


function CalMenu() {
    var menuBox = document.getElementsByClassName('case_menu');    
    if(menuBox.style.display == "block") { // if is menuBox displayed, hide it
      menuBox.style.display = "none";
    }
    else { // if is menuBox hidden, display it
      menuBox.style.display = "block";
    }
  }

