
<!DOCTYPE html>
<?php
    //va messo senno anche senza essere loggato potresti raggiungere questa pagina
    session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['loggato'])){
        header("Location: index.html");//se provi ad accedere a questa pagina ma non sei loggato vieni rindirizzato a quella html
        exit;
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.2.3/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="./owl.carousel.css">
    <link rel="stylesheet" href="./owl.theme.default.css">
    <script src="./bootstrap-5.2.3/dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
    
    <style>
        body{
            margin: 0 !important;
        }
        .container-fluid{/*toglie i bordi*/
            overflow: hidden;
            padding: 0;
        }
        #tasto_Utente{
            width: auto ;
            height: auto ; 
            /*background-color: #81c1ec59; /* colore azzurro più scuro al passaggio del mouse */
            background-color: #ffffff00;
            border-color: #ffffff00;
        }
        #tasto_Utente:hover{
            width: auto ;
            height: auto ; 
            background-color: #63fe9e7a; /* colore azzurro più scuro al passaggio del mouse */
            border-color: #000000;
        }

        /*parte delle delle due immagini con affianco testo*/
        #section_2{
            display: grid;
            grid-template-rows: 9fr 1fr; /* Prima riga unica, seconda divisa in tre */   
        }
        .second_box{
            display: grid;
            grid-template-rows: 1fr; /* Prima riga unica, seconda divisa in tre */
            grid-template-columns: 1fr 4fr 1fr; /* Prima e terza colonna con stessa larghezza, seconda molto più grande */
            grid-gap: 10px; /* Spazio tra le celle */
        }
        .second_box_item{
            background-color: #ffffff; /* Colore di sfondo grigio */
            padding: 20px; /* Padding per dare spazio interno alla cella */
            font-size: 24px; /* Dimensione del testo */
            text-align: center; /* Allineamento del testo al centro */
        }
        #central_box{
            display: grid;
            grid-template-rows: 1fr 1fr ; /* Prima riga unica, seconda divisa in tre */
            grid-template-columns: 1fr 2fr; /* Prima e terza colonna con stessa larghezza, seconda molto più grande */
            grid-row-gap: 50px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .central_box_item{
            padding: 20px; /* Padding per dare spazio interno alla cella */
            font-size: 24px; /* Dimensione del testo */
            text-align: center; /* Allineamento del testo al centro */
        }
        #central_box2_1{
            grid-row: 1 ;
            grid-column: 1;
            background-image: url("./img/strada.jpg");
            background-size:cover;
            background-position: center ;  
            transition: transform 0.2s ease-in-out;/*rend ela transizione applicata più fluidi*/             
        }
        #central_box2_1.move {/*quando scorro piu del x% della pagina si sposta*/
            transform: translateX(10px);
        }
        /*HOVER va messo sotto move senno non funziona*/
        #central_box2_1:hover{/*animazione quando ci passi sopra con mouse si ingrandisce*/
            transform: scale(1.05);
        }
       
        #central_box2_2{
            grid-row: 1 ;
            grid-column: 2;
            /*background-color: #a7d4f159; /* Colore di sfondo celestino */ 
            background-color: #51be7b6e; /**nuove colore verdino */
            transition: transform 0.2s ease-in-out;/*rend ela transizione applicata più smooth*/
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 100%;
            height: 100%;
        }
        #central_box2_2.move {/*quando scorro piu del 30% della pagina cambiano dimensione*/
            transform: translateX(50px);
        }
                
        #central_box2_3{
            grid-row: 2 ;
            grid-column: 1;
            /*background-color: #a7d4f159; /* Colore di sfondo celestino */ 
            background-color: #51be7b6e; /**nuove colore verdino */
            transition: transform 0.2s ease-in-out;/*rend ela transizione applicata più smooth*/
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 100%;
            height: 100%;
        }
        #central_box2_3.move {/*quando scorro piu del 30% della pagina cambiano dimensione*/
            transform: translateX(-50px);
        }
        
        #central_box2_4{
            grid-row: 2 ;
            grid-column: 2;
            background-image: url("./img/camper.jpg");
            background-size: cover;
            background-position:center ;
            transition: transform 0.2s ease-in-out;/*rend ela transizione applicata più smooth*/
        }
        #central_box2_4.move {/*quando scorro piu del 30% della pagina cambiano dimensione*/
            transform: translateX(-10px);
        }
        /*HOVER va messo sotto move senno non funziona*/
        #central_box2_4:hover{/*animazione quando ci passi sopra con mouse si ingrandisce*/
           background-color: #a7d3f1;/*ho reso meno trasparente senno si vede sotto*/
           transform: scale(1.05);
        }


        /*parte finale della pagina*/
        .third_box{
            width:100%;
            display: grid;
            background-color: #48a5e398;
            grid-template-rows: 1fr; /* Prima riga unica, seconda divisa in tre */
            grid-template-columns: 1.5fr 2.5fr 2.5fr 2.5fr 1.5fr ; /* Prima e terza colonna con stessa larghezza, seconda molto più grande */
            gap:3px;  
        }
        .third_box_item{
            background-color: #227ab598;
            padding: 15px; /* Padding per dare spazio interno alla cella */
            text-align: center; /* Allineamento del testo al centro */
        }
        .list_endpage{
            width: 100%;
            font-family: Georgia, 'Times New Roman', Times, serif;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        h4{
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        a:visited {/*cosi se lo hai visitato non cambia di colore*/
            color: rgb(3, 3, 3);
        }
        a{
            color: rgb(3, 3, 3) !important;
            text-decoration: none;/*toglie linea sottolineata*/
        }
        #logo{
            width: 150px;
            height: auto;
        }

        /*parte login popup*/
        .container {
        padding: 2rem 0rem;
        }
        .modal-dialog {
            max-width: 600px;
        }
        @media (min-width: 576px) {
            .modal-dialog .modal-content {
                padding: 1rem;
            }
        }
        .modal-header .close {
        margin-top: -1.5rem;
        }

        .form-title {
        margin: -2rem 0rem 2rem;
        }

        .btn-round {
        border-radius: 3rem;
        }

        .delimiter {
        padding: 1rem;
        }

        .social-buttons .btn {
        margin: 0 0.5rem 1rem;
        }

        .signup-section {
        padding: 0.3rem 0rem;
        }

        /*PARTE PER IL CAROUSEL*/
        #central_section{
            position:relative;
            width: auto;
            height: fit-content;
        }

        .bg-image-1{
            background-image: url(./img/japan.jpg);
        }

        .bg-image-2{
            background-image: url(./img/europe.jpg);
        }

        .bg-image-3{
            background-image: url(./img/carousel4.5.jpg);
        }

        .bg-image-4{
            background-image: url(./img/campeggio.jpg);
        }

        .bg-image-5{
            background-image: url(./img/carousel4.jpg);
        }

        .bg-image-6{
            background-image: url(./img/new-carousel4.5.jpg);
        }

        .bg-image-7{
            background-image: url(./img/carosello_7.jpg);
        }

        .bg-image-8{
            background-image: url(./img/carousel6.5.jpg);
        }

        .bg-image-9{
            background-image: url(./img/carousel7.jpg);
        }

        .bg-image-10{
            background-image: url(./img/carosello_10.jpg);
        }

        .carousel-img{
            height: 93vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            
        }
            
        .form-inline {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }

        
    #barra_nav{
        background-color: #4bc27921 !important;
        transition: background-color 0.6s ease-in-out; /* Aggiungiamo una transizione al cambio di colore */
    }
    #barra_nav.solid {
        background-color: #ffffff!important; /* Cambiamo lo sfondo quando la classe 'solid' viene aggiunta */
    }
    

    .slogan{
        height: 72vh;
        z-index: 100;
        font-family: monospace;
        font-style: italic;
        color: #ffffff;
        
    }

    #sezione-intermedia{
        height: auto;
        width: auto;
        background-color: #ffffff58;
        z-index: 100;
    }

    .titolino{
        background-color:#4bc2797a;
        height: 70px;
        width: auto;   
    }
    /**SI PUO ELIMINARE MI SA */
    .box_viaggio{
        height: 400px;
        width: 150px;
        background-image: url(./img/landscape_box.jpg);
        background-size: cover;
    }

    .card-img-top{
        height: 70vh;
        width: 100%;
        object-fit: cover;
    }

    .owl-prev{
        left: -30px;
    }
    .owl-next{
        right: -30px;
    }

    .owl-prev , .owl-next{
        position: absolute;
        top: 90px;
    }
     
    .owl-prev span, .owl-next span{
        font-size: 80px;
        color: #000000;
    }

    .owl-theme , .owl-nav[class*="owl-"]:hover{

        background: transparent;
    }

    .search-container{
        position: absolute;
        bottom: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
    }
    
    .input-group{
        width: fit-content;
        height: 50px;
    }

    .bg-cp{
        /*background-color: #d3d6db; colore grigio che c'era prima*/
        background-color:#4bc279b8

    }

    

    .fs-8{
        font-size: 13px;
    }
    
    .input-width{
        width: 240px;
    }
    @media (max-width: 525px) {
            .input-width{
                width: 200px;
            }
           

        }
    @media (max-width: 400px) {
        .input-width{
            width: 120px;
        }
        

    }

    .input-height{
        height: 52px;
    }

     
    </style>

    <script>
        /*funzioni per il popup login*/
        function openPopup(){
            document.getElementById("create_trip").style.display = "block";
            document.getElementById("overlay_viaggio").style.display = "block";
        }
        function closePopup() {
            document.getElementById("create_trip").style.display = "none";
            document.getElementById("overlay_viaggio").style.display = "none"
            //se hai creato un viaggio appare il messaggio di successo, se chiudi il popup il messaggio scompare, senno dato che ajax non ricarica la pagina se aprissi nuovamente il pop up ritrovereti "viaggio creato con successo"
            document.getElementById('risultato_creazione_viaggio').textContent = '';
        }  
    </script>
 
    <script>
        $('#carousel').on('slid.bs.carousel', function (e) {
            var $carousel = $(this);
            if ($('.carousel-item:last').hasClass('active')) {
                $carousel.carousel('pause');
                $carousel.carousel(0);
                $carousel.carousel('cycle');
            }
        });
    </script>
    <script>
    function check_field(){
        //la data di partenza deve essere successiva alla data odierna
        var data_odierna = new Date();
        var data_partenza = new Date(document.modulo_viaggio.data_partenza_input.value);
        if(data_partenza < data_odierna){
            alert("La data di partenza deve essere successiva alla data odierna");
            return false;
        }
        //giorno di partenza sia minore del giorno di ritorno
        var data_partenza = document.modulo_viaggio.data_partenza_input.value;
        var data_ritorno = document.modulo_viaggio.data_ritorno_input.value;
        if(data_partenza > data_ritorno){
            alert("La data di partenza deve essere precedente alla data di ritorno");
            return false;
        }
        //titolo_viaggio non superi i 30 caratteri
        if(document.modulo_viaggio.titolo_viaggio_input.value.length > 50){
            alert("Il titolo del viaggio non puo superare i 50 caratteri");
            return false;
        }
        //campo descrizione non superi i 100 caratteri
        if(document.modulo_viaggio.descrizione_input.value.length > 255){
            alert("La descrizione non puo superare i 255 caratteri");
            return false;
        }
        if(document.modulo_viaggio.destinazione_input.value.length > 30){
            alert("La destinazione non puo superare i 40 caratteri");
            return false;
        }
        if( isNaN(document.modulo_viaggio.budget_input.value)){ 
            alert("Il budget deve essere un numero"); 
            return false; 
        }
        if(document.modulo_viaggio.max_partecipanti_input.value <= 1){//numero di partecipanti deve essere maggiore di 1
            alert("Il numero di partecipanti deve essere maggiore di 1");
            return false;
        }
        return true;
    }
    </script>
    <script>
        
        /*funzione che modifica l'eleemnto con id central_box2_2 quando si scrolla*/
        
        function scrollFunction_change_dim() {
            const myDiv1 = document.getElementById("central_box2_1");
            const myDiv2 = document.getElementById("central_box2_2");
            const myDiv3 = document.getElementById("central_box2_3");
            const myDiv4 = document.getElementById("central_box2_4");
           
            window.addEventListener("scroll", () => {
           
            if ((document.documentElement.scrollTop / (document.documentElement.scrollHeight - document.documentElement.clientHeight)) * 100 > 60) {
                myDiv1.classList.add("move");
                myDiv2.classList.add("move");
                myDiv3.classList.add("move");
                myDiv4.classList.add("move");
            } 
            
            else {
                myDiv1.classList.remove("move");
                myDiv2.classList.remove("move");
                myDiv3.classList.remove("move");
                myDiv4.classList.remove("move");
            }
            });
        }
        document.addEventListener("scroll", scrollFunction_change_dim);

        function scrollFunction_change_NAV_COL(){
            var nav = document.getElementById("barra_nav");
            var lente = document.getElementById("lente");
            window.addEventListener("scroll", function() {
                if (window.scrollY >= 200) {
                    nav.classList.add("solid"); /* Aggiungiamo la classe 'solid' alla navbar quando si scrolla la pagina */
                    lente.style.display = "block";
                } else {
                    nav.classList.remove("solid"); /* Rimuoviamo la classe 'solid' quando si torna in cima alla pagina */
                    lente.style.display = "none";
                }
            });
        }      
        document.addEventListener("scroll", scrollFunction_change_NAV_COL);

    </script>

<title>TripSeeker</title>
</head>
<body class="text-center">

    <script src="./bootstrap-5.2.3/dist/js/bootstrap.bundle.js"></script>
    <div class="container-fluid">
        <nav id="barra_nav"   class="navbar fixed-top navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="index.php" ><img src="./img/logo3.0.png" id="logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"  data-toggle="modal" data-target="#loginModal" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toggle_button_2">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link"href="./Lista_Viaggi/index.php">Viaggi</a>                     
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#section_2" tabindex="-1" aria-disabled="true">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Contact_Us/contact.html">Contattaci</a>
                    </li>
                    <li class="nav-item" id="lente" > 
                        <a class="nav-link" href="#central_section"><i class="fas fa-search">&nbsp;&nbsp;</i></a>
                    </li>
                </ul>
            </div>
            
            <div class="ml-auto d-flex">  
                <?php
                    echo '<button id="tasto_Utente" type="button" class="btn btn-info btn-round d-flex justify-content-center align-items-center" data-toggle="modal"" onclick="window.location.href=\'User/index.php\'">'.$_SESSION['username'].'&nbsp <i class="fas fa-user-edit"> </i></button>';
                ?>
                &nbsp;
                <div class="dropdown">
                    <button style="background-color: #ffffff00;color:black; border-color: #ffffff00; "class="btn btn-secondary dropdown-toggle" type="button" id="tuoi_viaggi_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo'Viaggi di '.$_SESSION['username'].'';?></button>
                    <div class="dropdown-menu" aria-labelledby="tuoi_viaggi_drop">
                        <a class="dropdown-item"  onclick="openPopup()">Crea viaggio</a>
                        <a class="dropdown-item" href="../I_Tuoi_Viaggi/User_Trip.php">I tuoi viaggi</a><!--pagina per vedere i tuoi viaggi presenti futuri e passati-->
                    </div>
                </div>
            </div>
        </nav>
        <style>
            #barra_nav.collapsed {
                background-color: #ffffff !important;
            }

        </style>
        <script>
            document.getElementById('toggle_button_2').addEventListener('click', function() {
                var navbar = document.getElementById('barra_nav');
                if (navbar.classList.contains('collapsed')) {
                    navbar.classList.remove('collapsed');
                } else {
                    navbar.classList.add('collapsed');
                }
            });

        </script>

        <div id="central_section">      
            <div id="carousel" class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" data-bs-interval="6000">


                <div class="carousel-inner">
                    <div class="carousel-item carousel-img bg-image-1 active">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-2">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-3">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-4">
                       
                    </div>
                    <div class="carousel-item carousel-img bg-image-5">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-6">
                       
                    </div>
                    <div class="carousel-item carousel-img bg-image-7">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-8">
                       
                    </div>
                    <div class="carousel-item carousel-img bg-image-9">
                        
                    </div>
                    <div class="carousel-item carousel-img bg-image-10">
                       
                    </div>
                    
                    <script>
                        function check_campi(){
                            //giorno di partenza sia minore del giorno di ritorno
                            var data_p = document.modulo_search.data_partenza.value;
                            var data_r = document.modulo_search.data_ritorno.value;
                            //solo se entrambi sono stati inseriti
                            if(data_p != "" && data_r != ""){
                                if(data_p > data_r){
                                    alert("La data di partenza deve essere precedente alla data di ritorno");
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>
                    <script>
                        function change() {
                            if (window.innerWidth > 1200) {
                                document.getElementById("xl_indicator").value = "XL";
                                document.getElementById("xs_indicator").value = "";
                            }
                            else {
                                document.getElementById("xs_indicator").value = "XS";
                                document.getElementById("xl_indicator").value = "";
                            }
                        }
                        //aggiungi un ascoltatore per il ridimensionamento della finestra
                        window.addEventListener('resize', function(event){
                            change();
                        });
                    </script>
                    <style>
                         #exampleDataList, #exampleDataList2, #data_partenza, #data_ritorno,#select_viaggiatori{
                            box-shadow: none!important;
                            border: none!important;
                        }
                    </style>

                    <!--BARRA DI RICERCA-->
                    <div class="search-container  justify-content-center align-items-center">
                        <form name="modulo_search" action="./Lista_Viaggi/index.php" method="POST" onsubmit="return check_campi()">
                            <!--input nascosto che faccia capire quando invio la post che è stato cliccato il tasto cerca dalla homepage cosi che dentro lista_viaggi differenzio-->
                            <input type="hidden" name="from_home" value="home">
                            <input type = "hidden" id = "xl_indicator" name = "XL" value="XL">
                            <div class="position-relative">
                                <div class="d-none d-xl-block position-absolute start-50 top-50 translate-middle">
                                    <p style="font-family:Playfair Display; font-style: initial;" class="fw-bold text-white fs-1">TripSeeker, chase the adventure</p>
                                    <div class="rounded p-3 bg-cp" style="margin-bottom: 40%; width: auto;">
                                        <div class="d-flex align-items-center py-2">
                                            <div style="width: 500px; padding:5px;">
                                                <label for="exampleDataList" name="citta_destinazione" class="form-label fw-bold fs-8 m-0">Destinazione</label>
                                                <input class="form-control input-height" list="datalistOptions_xl" name="destinazione" id="exampleDataList_xl" placeholder="Dove vuoi andare?"> 
                                                <datalist id="datalistOptions_xl">
                                                    <option value="San Francisco">
                                                    <option value="New York">
                                                    <option value="Seattle">
                                                    <option value="Los Angeles">
                                                    <option value="Chicago">
                                                </datalist>
                                            </div>
                                            
                                            <div style="padding:5px;">
                                                <label for="data-partenza" class="fw-bold fs-8">Data di partenza</label>
                                                <input type="date" name="data-partenza" id="data_partenza_xl" class="form-control input-width input-height">
                                            </div>
                                            <div style="padding:5px;">
                                                <label for="data-ritorno" class="fw-bold fs-8">Data di ritorno</label>
                                                <input type="date" name="data-ritorno" id="data_ritorno_xl" class="form-control input-width input-height">
                                            </div>
                                            <div style="padding:5px;">
                                                <label for="" class="fw-bold fs-8">numero massimo viaggiatori</label>
                                                <select class="form-select input-width input-height" name="n-viaggiatori"id="n_viaggiatori_xl" aria-label="Default select example">
                                                    <option value="" selected>indifferente</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option> 
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="10+">10+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--checkbox date simili e bottone-->
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="date_precise" id="date_precise_button" checked>
                                                    <label class="form-check-label fw-bold fs-8" for="date_precise_button">Date esatte</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="5" name="date_simili" id="date_simili_button">
                                                    <label class="form-check-label fw-bold fs-8" for="date_simili_button">±5 giorni partenza</label>
                                                </div>
                                                 <script>
                                                // seleziona i checkbox
                                                var datePreciseCheckbox = document.getElementById("date_precise_button");
                                                var dateSimiliCheckbox = document.getElementById("date_simili_button");

                                                // aggiungi un ascoltatore di eventi al checkbox "datePreciseCheckbox"
                                                datePreciseCheckbox.addEventListener('change', function() {
                                                if (this.checked) {
                                                    // se il checkbox "datePreciseCheckbox" è selezionato, disattiva il checkbox "dateSimiliCheckbox"
                                                    dateSimiliCheckbox.checked = false;
                                                }
                                                });

                                                // aggiungi un ascoltatore di eventi al checkbox "dateSimiliCheckbox"
                                                dateSimiliCheckbox.addEventListener('change', function() {
                                                if (this.checked) {
                                                    // se il checkbox "dateSimiliCheckbox" è selezionato, disattiva il checkbox "datePreciseCheckbox"
                                                    datePreciseCheckbox.checked = false;
                                                }
                                                });
                                            </script>
                                            </div>
                                            <input type="submit" id="submit-btn-xl" style="display:none;">
                                            <div class="btn btn-dark fw-bold btn-lg input-width" onclick="document.getElementById('submit-btn-xl').click();">Cerca Viaggio!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                         <!--barra se cambiano le dimensioni-->
                        <form action="./Lista_Viaggi/index.php" name = "form_xs" method="post" onsubmit="return check_campi_xs()">
                            <input type="hidden" name="from_home" value="home">
                            <input type = "hidden" id= "xs_indicator" name = "XS" value="XS">
                            <div class="position-relative">
                                <div class="d-block d-xl-none rounded-2  py-3 px-3 position-absolute start-50 top-50 translate-middle" id="bar_xs">
                                    <p style="font-family:Playfair Display; font-style: initial;" class="fw-bold text-white fs-1">TripSeeker, chase the adventure</p>
                                    <div class="rounded p-3 bg-cp" style="margin-bottom: 40%; width: auto;">
                                        <div>
                                            <label for="exampleDataList" class="form-label fw-bold fs-8 m-0">Destinazione</label>
                                            <input class="form-control" list="datalistOptions" name="destinazione_xs" id="exampleDataList-xs" placeholder="Dove vuoi andare?">
                                                <datalist id="datalistOptions_xs">
                                                    <option value="San Francisco">
                                                    <option value="New York">
                                                    <option value="Seattle">
                                                    <option value="Los Angeles">
                                                    <option value="Chicago">
                                                </datalist>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <label for="" class="fw-bold fs-8">Data di partenza</label>
                                                <input type="date" name="data_partenza_xs" id="data_partenza_xs" class="form-control input-width input-height">
                                            </div>
                                            <div>
                                                <label for="" class="fw-bold fs-8">Data di itorno</label>
                                                <input type="date" name="data_ritorno_xs" id="data_ritorno_xs" class="form-control input-width input-height">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between ">
                                            <div>
                                                <label for="" class="fw-bold fs-8">numero massimo viaggiatori</label>
                                                <select class="form-select input-width input-height" name="n_viaggiatori_xs" aria-label="Default select example">
                                                    <option value="" selected>indifferente</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option> 
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="10+">10+</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="" class="fw-bold fs-8" style="color:transparent">numero massimo viaggiatori<!--serve per allineare input max partecipanti con bottone di invio--></label>
                                                <input type="submit" id="submit-btn-xs" style="display:none;">
                                                <div style="height: 52px;" class="btn btn-dark fw-bold input-width d-flex align-items-center justify-content-center" onclick="document.getElementById('submit-btn-xs').click();">Cerca Viaggio!</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="date_precise_xs" id="date_precise_button_xs" checked>
                                                    <label class="form-check-label fw-bold fs-8" for="date_precise_button_xs">Date esatte</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="5" name="date_simili_xs" id="date_simili_button_xs">
                                                    <label class="form-check-label fw-bold fs-8" for="date_simili_button_xs">±5 giorni partenza</label>
                                                </div>
                                                <script>
                                                    // seleziona i checkbox
                                                    var datePreciseCheckbox_xs = document.getElementById("date_precise_button_xs");
                                                    var dateSimiliCheckbox_xs = document.getElementById("date_simili_button_xs");

                                                    datePreciseCheckbox_xs.addEventListener('change', function() {
                                                    if (this.checked) {
                                                        dateSimiliCheckbox_xs.checked = false;
                                                    }
                                                    });

                                                    dateSimiliCheckbox_xs.addEventListener('change', function() {
                                                    if (this.checked) {
                                                        datePreciseCheckbox_xs.checked = false;
                                                    }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="sezione-intermedia">
            <div class="titolino text-center align-content-lg-center">
                <h1 class="card-title" style="font-family:Playfair Display;">Lots of destinations all over the world!</h1>
            </div>
            <style>
                .card:hover{
                    color: #51be7b;
                }
            </style>
            <script src="./owl.carousel.js"></script>

            <div class="container">
                <div class="owl-carousel owl-theme">
                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Spagna&search=">
                            <div class="card">
                                <img data-src="./img/spagna.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Spagna</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Roma&search=">
                            <div class="card">
                                <img data-src="./img/colosseo.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Roma</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Europa+by+train&search=">
                            <div class="card">
                                <img data-src="./img/europa.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Europa by train</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Aurora+Boreale&search=">
                            <div class="card">
                                <img data-src="./img/aurora_boreale.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Aurora Boreale</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Muraglia+Cinese&search=">
                            <div class="card">
                                <img data-src="./img/muraglia_cinese.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">La Grande Muraglia Cinese</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Indonesia&search=">
                            <div class="card">
                                <img data-src="./img/indonesia.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Indonesia</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=ghiacci+artici&search=">
                            <div class="card">
                                <img data-src="./img/ghiacci_artici.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">I ghiacci artici</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ms-2 me-2">
                        <a href="./Lista_Viaggi/index.php?search-bar=Langhe&search=">
                            <div class="card">
                                <img data-src="./img/langhe.jpg" class="card-img-top owl-lazy">
                                <div class="card-body">
                                    <h5 class="card-title">Le Langhe</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        
        <script src="./owl-carousel-mio.js"> </script>

        <!--SECTION 2-->
        <div id="section_2">
            <div class="second_box">
                <div class="second_box_item" id="primacolonna"></div>
                <div class="second_box_item" id="central_box">
                    <div class="central_box_item" id="central_box2_1"></div>
                    <div class="central_box_item" id="central_box2_2">Noi di TripSeeker, comprendiamo l'importanza di avere un compagno di viaggio con interessi simili per condividere esperienze indimenticabili. Ecco perché abbiamo reso facile connettersi con viaggiatori di tutto il mondo che condividono i tuoi interessi e lo stile di viaggio. Con la nostra piattaforma riuscirai a trovare il viaggio e la compagnia perfetta in poco tempo. Non lasciare che la paura di viaggiare da solo ti trattiene dal tuo viaggio dei sogni, unisciti a TripSeeker oggi stesso e lascia che le avventure abbiano inizio!</div>
                    <div class="central_box_item" id="central_box2_3">Stai cercando qualcuno con cui viaggiare? Non cercare oltre! TripSeeker può aiutarti a trovare un compagno di viaggio. È sempre più divertente esplorare nuovi luoghi con un amico. Inoltre, avere un compagno può rendere i viaggi più sicuri e meno stressanti. Quindi, iscriviti oggi stesso e inizia a pianificare la tua prossima avventura con un nuovo amico!</div>
                    <div class="central_box_item" id="central_box2_4"></div>
                </div>
                <div class="second_box_item"></div>
            </div>
        </div>
    </div>
    <style>
        footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
        background-color: #4bc2797a;
        font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .social, .info, .contacts {
        flex: 1 1 30%;
        margin-bottom: 10px;
        }

        .social h3, .info h3, .contacts h3 {
        margin-bottom: 10px;
        font-size: 1.2rem;
        }

        .social ul, .info ul, .contacts ul {
        list-style: none;
        margin: 0;
        padding: 0;
        }

        .social li, .info li, .contacts li {
        margin-bottom: 5px;
        }

        .social a, .info a, .contacts a {
        color: #333;
        text-decoration: none;
        }

        .map {
        margin-top: 10px;
        }

        iframe {
        width: 100%;
        height: 200px;
        }

        /* media query per dispositivi con larghezza inferiore a 600px */
        @media (max-width: 600px) {
        footer {
            flex-direction: column;
        }
        }
        @media (min-width: 601px) {
        footer > hr {
            display: none;
            margin-top: none;
        }
        }

    </style>

    <footer>
        <div class="social">
            <h4>Social</h4>
            <ul>
                <li><a href="#"><i class="fab fa-facebook-square"></i>&nbspFacebook</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i>&nbspTwitter</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i>&nbspInstagram</a></li>
            </ul>
        </div>
        <hr>
        <div class="contacts">
            <h4>Contatti</h4>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i>&nbspIndirizzo: Circonvallazione Tiburtina, 4, 00185 Roma RM</li>
                <li><i class="far fa-envelope"></i>&nbspEmail: TripSeeker@gmail.com</li>
                <li><i class="fas fa-mobile-alt"></i>&nbspTelefono: 06 12345678</li>
            </ul>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2975.425071536982!2d12.512006915577496!3d41.90224137350806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f601c3fd13a63%3A0xd84e4301702a9c36!2sCirconvallazione%20Tiburtina%2C%204%2C%2000185%20Roma%20RM%2C%20Italy!5e0!3m2!1sen!2sus!4v1653724527156!5m2!1sen!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <hr>
        <div class="info">
            <h4>Info & Link Utili</h4>
            <ul>
                <li><a href="./Termini_Condizioni/Termini_Condizioni.php"><i class="fas fa-list"></i>&nbsp;Termini e condizioni</a></li>
                <li><a href="./FAQ/faq.php"><i class="fas fa-question"></i>&nbsp;FAQ</a></li>
            </ul>
        </div>
    </footer>
    
    <!--parte del pop up crea viaggio-->
    <style>
        /*tolgo ombra quando premo su input, il resto sono altri effetti visivi quando premi*/
        .form-control:focus {
            box-shadow: none;
            border-width: 3px;
            border-image-slice: 1;
        }
        
        /*stile della croce di chiusura popup*/
        button[aria-label="Close"] {
            position: absolute; 
            top: 5%;
            left: 95%;
            transform: translate(-50%, -50%);
            padding: 0;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        button[aria-label="Close"] i {
            color: #333333;
            font-size: 20px;
        }

        button[aria-label="Close"]:hover i {
            color: #ff0000;
        }

        #div_popup_create_viaggio{
            background-image: url(./img/9081966_4092826.jpg);
            background-size: cover;
        }
    </style>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1031; /*per farlo stare sopra il body*/
            display: none;
        }
        .overlay.blur {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }


    </style>
    <script>
        //usiamo l'oggetto JavaScript XMLHttpRequest per effettuare la richiesta asincrona.
        document.addEventListener("DOMContentLoaded", function() {
            var form_viaggio = document.querySelector('form[name="modulo_viaggio"]');
            
            form_viaggio.addEventListener("submit", function(e) {
                e.preventDefault(); // Previene il comportamento di default dell'invio del form che ricarica pagina
                var xhr = new XMLHttpRequest(); //oggetto utilizzato per inviare richieste HTTP asincrone al server
                xhr.open(form_viaggio.method, "./Crea_Viaggio/nuovo_viaggio.php");  
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //La funzione sottostante verifica se lo stato della risposta HTTP (xhr.status) è uguale a 200 (che indica una risposta di successo).
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var risp = JSON.parse(xhr.responseText);
                        if (risp.successo) {
                            document.getElementById('risultato_creazione_viaggio').textContent = 'Viaggio creato con successo!✅';
                            document.getElementById('form_viaggio').reset();//reset form
                        } 
                        else{
                            document.getElementById('risultato_creazione_viaggio').textContent = 'Si è verificato un errore nella creazione del viaggio!';
                        }
                    } else {
                        console.log('Si è verificato un errore nella richiesta Ajax.'); //debug
                    }
                };
                
                xhr.onerror = function() {
                    console.log('Si è verificato un errore nella richiesta Ajax.'); //debug
                };
                
                xhr.send(new URLSearchParams(new FormData(form_viaggio)).toString());
            });
        });
        </script>
    <div id="overlay_viaggio" class="overlay blur"></div>
    <div class="modal" id="create_trip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content"  id="div_popup_create_viaggio" style="z-index:1032;">
                <div class="modal-header border-bottom-0">
                    <style>
                        
                    </style>
                    <button type="button" onclick="closePopup()" aria-label="Close" >
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h2 style="font-family:Playfair display">Crea il tuo viaggio</h2>
                        <!--linea sotto il titolo-->
                        <style>
                            .linea {
                                width: 100%;
                                height: 1px;
                                background-color: grey;
                                margin: 20px auto;
                            }
                            #titolo_viaggio_input:focus,#data_partenza_input:focus,#data_ritorno_input:focus,#budget_input:focus,#max_partecipanti_input:focus,#destinazione_input:focus,#descrizione_input:focus{
                                box-shadow: 0 0 10px #4c9b48 !important;
                                border-color: #4c9b48 !important;
                            }
                        </style>
                        <div class="linea"></div>

                    </div>
                    <form name="modulo_viaggio" action="./Crea_Viaggio/nuovo_viaggio.php" method="POST" id="form_viaggio">
                        <div class="row" style="text-align: left;">
                            <div class="col-md-12 form-group"><label for="titolo_viaggio">Titolo del viaggio:</label><input type="text" class="form-control" name="titolo_viaggio" id="titolo_viaggio_input" required></div>
                            <div class="col-md-6 form-group"><label for="data_partenza">Data di partenza:</label> <input type="date" id="data_partenza_input" class="form-control" name="data_partenza" placeholder="Data di partenza" required ></div>
                            <div class="col-md-6 form-group"><label for="data_ritorno">Data di ritorno:</label> <input type="date" id="data_ritorno_input" class="form-control" name="data_ritorno" placeholder="Data di ritorno" required></div>
                            <div class="col-md-4 form-group"><label for="budget">Budget, <i class="fas fa-euro-sign fa-xs"></i> :</label><input type="text" name="budget" class="form-control" id="budget_input"  required></div>
                            <div class="col-md-4 form-group"><label for="max_partecipanti">Num partecipanti:</label><input type="number" class="form-control" name="max_partecipanti" id="max_partecipanti_input" required></div>
                            <div class="col-md-4 form-group"><label for="destinazione">Destinazione:</label><input type="text" class="form-control" name="destinazione" id="destinazione_input" required ></div>
                            <div class="col-md-12 form-group"><label for="descrizione">Descrizione:</label><textarea class="form-control" name="descrizione" id="descrizione_input" rows="4" required placeholder="Inserisci una descrizione del tuo viaggio"></textarea></div>
                            <br><br><br><br><br><br>
                            <div class="col-md-12 form-group text-center"><button type="submit" value="Crea Trip" class="btn btn-success btn-block btn-round">Crea</button></div>                                
                            <h3 style="color:green;text-align:center;" id="risultato_creazione_viaggio"></h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
  
</body>
</html>