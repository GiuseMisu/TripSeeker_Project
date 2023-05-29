var faq = document.getElementsByClassName("faq-page");
var i;

for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
        //funzione che fa apparire e scomparire il testo della domanda
        this.classList.toggle("active"); //aggiungo la classe active al bottone cliccato

        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling; //prendo il body della domanda
        if (body.style.display === "block") { //se il body è visibile lo rendo invisibile
            body.style.display = "none"; //se il body è invisibile lo rendo visibile
        } else {
            body.style.display = "block"; //se il body è invisibile lo rendo visibile
        }
    });
}