$(".owl-carousel").owlCarousel({
    autoplay: true, //fa partire la galleria automaticamente
    autoplayhoverpause: true, //serve per fermare la galleria quando si passa il mouse sopra
    autoplaytimeout: 50, //questo fa cambiare le immagini ogni 5 secondi
    items: 4, //fa apparire 4 immagini per volta
    nav: true, //serve per le frecce per scorrere le immagini
    loop: true,     //per ripartire la galleria dall'inizio a loop
    lazyLoad: true, //questo fa caricare lentamente le immagini
    margin: 5,
    padding: 5,
    stagePadding: 5,
    responsive:{    //questo serve per far apparire le immagini in base alla grandezza dello schermo
        0 : {
            items: 1,
            dots: false
        },
        485 : {
            items: 2,
            dots: false
        },
        728 : {
            items: 3,
            dots: false
        },
        960 : {
            items: 4,
            dots: false
        },
        1200 : {
            items: 4,
            dots: true
        }
    }
});