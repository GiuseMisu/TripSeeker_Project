<?php
    if (!isset($_POST["pulsante_invio_token"])){
        header("Location: ../index.php");
        exit();
    }

    $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
    if (!$dbconn){
        die('Could not connect: ' . pg_last_error());
    }

    $email = $_POST["email"];
    $q1 = "SELECT token FROM reset_password WHERE email_utente = $1";
    $result = pg_query_params($dbconn, $q1, array($email));
    if ($result) {
        $row = pg_fetch_assoc($result); // Ottieni la riga risultante come array associativo
        $tokendb = $row['token']; // Salva il valore del token nella variabile $tokendb
    } else {
        echo "Errore nella query: " . pg_last_error($dbconn);
    }

    $token = $_POST["token"];

    if ($token == $tokendb) {
    //query per eliminare la tupla dal db
    $q2 = "DELETE FROM reset_password WHERE email_utente = $1";
    $result = pg_query_params($dbconn, $q2, array($email));
    if ($result) {
    
    } else {
        echo "Errore nella query: " . pg_last_error($dbconn);
    }
    pg_close($dbconn);
    } else {// mettere un alert javascript "toker errato":
        header("Location: inserimento_token.php?email=$email&error=token_errato");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
    <link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.css"/>
    <script src="../bootstrap-5.2.3/dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.js'></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <title>Password dimenticata</title>
    <style>
        body{
            margin: 0;
        }
        .container-fluid{/*toglie i bordi brutti*/
            overflow: hidden;
            padding: 0;
        }
        #tasto_login{
            width: auto ;
            height: auto ; 
            background-color: #4bc27921; /* colore azzurro più scuro al passaggio del mouse */
            border-color: #000000;
        }
        #tasto_login:hover{
            width: auto ;
            height: auto ; 
            background-color: #00d9ae; /* colore azzurro più scuro al passaggio del mouse */
            border-color: #000000;
        }
        #logo{
            width: 150px;
            height: auto;
        }
        #barra_nav{
            background-color: #51be7b7d!important;
        }
    
        #griglia1x3{
            display: grid;
            height: auto;
            grid-template-columns: 1fr 6fr 1fr; /* 3 colonne */
            grid-template-areas: "first_col second_col third_col" /* aree delle celle della prima riga */
        }  
        #first_col{
            grid-area: first_col;
            background-color: rgb(255, 255, 255); 
        }
        #second_col{
            grid-area: second_col;
            background-color: white;
            padding-left: 60px;
            padding-right: 60px;
            padding-top: 30px;
            padding-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #second_col {
            margin: 0 auto;
            max-width: 800px; /* Cambia questo valore in base alla larghezza massima che vuoi impostare per il form */
        }
        #contact-form label, #contact-form input, #contact-form textarea {
        display: block;
        }

        #third_col{
            grid-area: third_col;
            background-color: rgb(255, 255, 255);
        }

       
    </style>
</head>
<body>
<div class="container-fluid" style="text-align: center;" >
        <nav id="barra_nav"  class="navbar top navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="../index.php" ><img src="../img/logo3.0.png" id="logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../Lista_Viaggi/index.php">Viaggi</a>                     
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html#section_2" tabindex="-1" aria-disabled="true">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact_Us/contact.html">Contattaci</a>
                    </li>
                    <li class="nav-item" id="lente" > 
                        <a class="nav-link" href="../index.html#central_section"><i class="fas fa-search"></i>&nbsp;&nbsp; </a>
                    </li>
                </ul>
            </div>
        </nav>
        <style>
        #div_sotto_barra{
            height: 200px;
            width: auto;
            background-image: url("../img/beach-alone-relax-summer-aerial-view-ios-10-stock-1920x1200-5393.jpg");
            background-position: center;
            background-repeat: no-repeat;
            opacity: 85%;
        }
        </style>
        <div id="div_sotto_barra"></div>
        <!--parte sotto barra è griglia-->
        <div class="container-fluid" id="griglia1x3">
            <div id="first_col" ></div>
            <div id="second_col">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Credenziali dimenticate? <br>Ripristina qui la tua password!</h2>
                            <p>Inserisci la tua email e ti invieremo un token per cambiare la tua password</p>
                            <script>
                                function check_pass(){
                                    //lunghezza password di almeno 8 caratteri e contenga almeno un numero, una lettera maiuscola e un simbolo speciale
                                    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;
                                    if(!regex.test(document.modulo_newpass.nuova_password.value)){
                                        alert("La password deve contenere almeno 8 caratteri, una lettera maiuscola e un numero");
                                        return false;
                                    }         
                                    if(document.modulo_newpass.nuova_password.value != document.modulo_newpass.nuova_password_ripetizione.value){
                                        alert("Le password non coincidono");
                                        return false;
                                    }

                                    return true;
                                }
                            </script>
                            <form action="./salva_password_db.php" method="POST" name = "modulo_newpass" onsubmit="return check_pass()">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">psw</span>
                                    <div class="form-floating">
                                        <input type="password" name="nuova_password" class="form-control" id="nuova_password" placeholder="password">
                                        <label for="nuova_password">Inserisci qui la tua password</label>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">psw</span>
                                    <div class="form-floating">
                                        <input type="password" name="nuova_password_ripetizione" class="form-control" id="nuova_password_ripetizione" placeholder="password">
                                        <label for="nuova_password_ripetizione">Ripeti la tua password</label>
                                    </div>
                                </div>
                                <input type="hidden" name="email" value="<?php echo $_POST["email"]; ?>">
                                <button type="submit" name="cambio_password" class="btn btn-success">Salva</button>

                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div id="third_col"></div>     
        </div>
          
        <script src="contact.js"></script>
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
    
    <footer style="text-align: center;">
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
                <li><a href="../Termini_Condizioni/Termini_Condizioni.php"><i class="fas fa-list"></i>&nbspTermini e condizioni</a></li>
                <li><a href="../FAQ/faq.php"><i class="fas fa-question"></i>&nbspFAQ</a></li>
            </ul>
        </div>
    </footer>
    
   <?php
        pg_close($dbconn);
        header("Location: ./reset_password_db.php");

   ?>
    
</body>
</html>