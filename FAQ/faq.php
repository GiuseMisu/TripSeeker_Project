<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
   
    
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.css"/>
    <script src="../bootstrap-5.2.3/dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.js'></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="stylesheet" href="./faq.css">
    <title>FAQ PAGE</title>

    <script>
        
        /*funzioni per il popup login*/
        function openPopup(){
            document.getElementById("loginPopUp").style.display = "block";
        }
        function closePopup() {
            document.getElementById("loginPopUp").style.display = "none";
        }     

    </script>
   

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
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
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
            <?php
                //se sei già loggato il tasto di log non deve comparire
                if( !isset($_SESSION['loggato']) ){
                    //<!--log in PopUp-->
                    echo'
                        <a onclick="openPopup()" type="button" class="btn btn-info btn-round d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#loginModal" id="tasto_login"><ion-icon name="person-outline"></ion-icon>Login</a>
                    ';
                }
            ?>
        </nav>

        <div id="div_sotto_barra"></div>
        <div class="container-fluid" id="griglia1x3" style="text-align: left;">  
            <div id="first_col" ></div>
            <div id="second_col">
                <section class="faq-container">
                    <div class="faq-one">
                        <!-- faq question -->
                        <h3 class="faq-page">Quante persone possono partecipare a un viaggio?</h3>

                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p>Non c'è limite al numero di persone che possono partecipare a un viaggio.
                                Il numero di persone dipende dalle preferenze dell'organizzatore del viaggio e dalle sistemazioni disponibili.
                            </p>
                            <br>
                        </div>
                    </div>
                    <hr class="hr-line">

                    <div class="faq-two">
                        <!-- faq question -->
                        <h3 class="faq-page">Come posso sapere se un viaggio è disponibile nelle date in cui voglio viaggiare?</h3>

                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p>Il modulo di creazione del viaggio include le date di viaggio, quindi con la barra di ricerca puoi filtrare i viaggi disponibili in base alle date desiderate.
                               Se non sei sicuro delle date in cui desideri viaggiare, puoi selezionare ±5 giorni per vedere i viaggi disponibili entro un intervallo di 5 giorni dalle tue date di viaggio desiderate.
                            </p>
                            <br>
                        </div>
                    </div>
                    <hr class="hr-line">

                    <div class="faq-three">
                        <!-- faq question -->
                        <h3 class="faq-page">Come posso creare un viaggio su questo sito web?</h3>

                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p> Per creare un viaggio, devi compilare il modulo di creazione del viaggio fornito sul sito.
                                Questo modulo include informazioni come la destinazione, le date di viaggio, il budget e la descrizione del viaggio.
                                Una volta compilato il modulo, il tuo viaggio sarà pubblicato sul sito web e altri utenti potranno unirsi al tuo viaggio.
                            </p>
                            <br>
                        </div>
                    </div>
                    <hr class="hr-line">

                    <div class="faq-four">
                        <!-- faq question -->
                        <h3 class="faq-page">Che tipo di attività sono di solito incluse in un viaggio?</h3>
            
                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p> Il tipo di attività incluse in un viaggio dipende dalla destinazione e dalle preferenze dell'organizzatore del viaggio.
                                Alcune attività comuni includono visite turistiche, avventure all'aperto come escursioni, esperienze culturali come visite ai musei o partecipazione a festival, e attività di relax come trattamenti spa o tempo in spiaggia.
                                È importante leggere attentamente la descrizione del viaggio per capire quali attività sono incluse nel viaggio.
                            </p>
                            <br>
                        </div>
                    </div>
                    <hr class="hr-line">

                    <div class="faq-five">
                        <!-- faq question -->
                        <h3 class="faq-page">Posso personalizzare l'itinerario del mio viaggio?</h3>
                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p> Dipende dalle preferenze dell'organizzatore del viaggio e dal tipo di viaggio a cui ti stai unendo.
                                Alcuni organizzatori di viaggio potrebbero essere disposti a personalizzare l'itinerario in base alle preferenze dei partecipanti, mentre altri potrebbero avere un itinerario fisso che non può essere modificato.
                                Se hai richieste specifiche o preferenze per l'itinerario del tuo viaggio, è meglio comunicarle all'organizzatore del viaggio prima di unirti al viaggio tramite l'apposito bottone.
                            </p>
                            <br>
                        </div>
                    </div>
                    <hr class="hr-line">

                    <div class="faq-six">
                        <!-- faq question -->
                        <h3 class="faq-page">Cosa succede se devo cancellare il mio viaggio?</h3>
                        <!-- faq answer -->
                        <div class="faq-body">
                            <br>
                            <p> La politica di cancellazione per ciascun viaggio è stabilita dall'organizzatore del viaggio e può variare a seconda del viaggio.
                                È importante leggere attentamente la descrizione del viaggio e la politica di cancellazione prima di unirti al viaggio.
                                Se hai bisogno di cancellare il tuo viaggio, dovresti contattare l'organizzatore del viaggio il prima possibile e seguire le linee guida della politica di cancellazione.
                            </p>
                            <br>
                        </div>
                    </div>
                    
                </section>
            </div>
            <div id="third_col" ></div>
        </div>
    </div>
    <script src="faq.js"></script>
    <div id="div_sotto_faq"></div>
   

    <footer style="text-align:center">
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
                <li><i class="fas fa-map-marker-alt"></i>&nbspIndirizzo: Via Roma 1, 00100 Roma</li>
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
                <li><a href="../Termini_Condizioni/Termini_Condizioni.php"><i class="fas fa-list"></i>&nbsp;Termini e condizioni</a></li>
                <li><a href="./FAQ/faq.php"><i class="fas fa-question"></i>&nbsp;FAQ</a></li>
            </ul>
        </div>
    </footer>

   <div class="modal" id="loginPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content" style="background-image: url(../img/15226638_v660-mon-04-travelbadge.jpg);background-position: center;background-size: cover;">
                <div class="modal-header border-bottom-0">
                    <style>
                        
                    </style>
                    <button type="button" onclick="closePopup()" aria-label="Close" >
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h3>Per scoprire di più sul tuo prossimo viaggio accedi o registrati!</h3>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form name="myForm" action="../login.php" method="POST" class="form-signin">
                            <div class="form-group">
                                <input type="email" placeholder="indirizzo mail..." name="inputEmail" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="password..." name="inputPassword" class="form-control" required>
                            </div>
                             
                            <br>
                            <a href="../PHPMailer/password_dimenticata.php" name="psw_dimenticata" style=" color:green;">Password dimenticata?</a>
                            <br>
                            <button type="submit" class="btn btn-success btn-block btn-round">Login</button>
                            <br>
                        </form>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Non hai un account? <a href="../signUp/index.php" class="text-info"> Registrati!</a></div>
                </div>
            </div>
        </div>
    </div>';
    

   
    
</body>


</html>