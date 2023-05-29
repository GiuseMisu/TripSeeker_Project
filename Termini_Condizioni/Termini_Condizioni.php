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
    <link rel="stylesheet" href="./termini_condizioni.css">
    <title>Termini e Condizioni</title>

   
    <script>
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
                        <a onclick="openPopup()" type="button" class="btn btn-info btn-round d-flex justify-content-center align-items-center" data-toggle="modal" id="tasto_login"><ion-icon name="person-outline"></ion-icon>Login</a>
                    ';
                }
            ?>
        </nav>

        <div id="div_sotto_barra"></div>
        <div class="container-fluid" id="griglia1x3" style="text-align: left;">  
            <div id="first_col" ></div>
            <div id="second_col">
                <h1 style="color:green;">Termini e condizioni del sito TripSeeker</h1>
                <p>Benvenuto nel sito web TripSeeker. Prima di utilizzare il sito, ti invitiamo a leggere attentamente i seguenti termini e condizioni che disciplinano il tuo utilizzo e l'accesso a questo servizio. L'utilizzo del sito implica l'accettazione piena e senza riserve di questi termini e condizioni. Se non sei d'accordo con questi termini, ti preghiamo di non utilizzare il sito.</p>
                
                <h2 style="color:green;">1. Descrizione del servizio</h2>
                <p>TripSeeker è un sito web che mette in contatto persone interessate a viaggiare e a trovare compagni di viaggio. Il sito facilita la comunicazione tra gli utenti e fornisce uno spazio online per pubblicare annunci di viaggio, cercare compagni di viaggio compatibili e scambiare informazioni relative ai viaggi.</p>
                
                <h2 style="color:green;">2. Utilizzo del sito</h2>
                <ol>
                    <li>
                        <h3 style="color:green;" >Registrazione</h3>
                        <p>Per utilizzare appieno il sito, è necessario registrarsi e creare un account personale. Le informazioni fornite durante la registrazione devono essere accurate, complete e aggiornate. Sei responsabile della riservatezza delle tue credenziali di accesso e delle attività svolte sul tuo account.</p>
                    </li>
                    <li>
                        <h3 style="color:green;">Condotta dell'utente</h3>
                        <p>Devì impegnarti a utilizzare il sito in modo lecito e in conformità con queste condizioni. Non devi pubblicare, trasmettere o condividere contenuti che siano diffamatori, ingiuriosi, osceni, offensivi, illegali o che violino i diritti di terzi. Inoltre, non devi utilizzare il sito per scopi fraudolenti o per promuovere attività illegali.</p>
                    </li>
                    <li>
                        <h3 style="color:green;">Contenuti dell'utente</h3>
                        <p>Sei responsabile dei contenuti che pubblichi sul sito, inclusi annunci di viaggio, commenti e recensioni. Garantisci di avere i diritti necessari per pubblicare tali contenuti e di non violare i diritti di terzi. Il sito si riserva il diritto di rimuovere o modificare qualsiasi contenuto che ritenga inappropriato o che violi questi termini e condizioni.</p>
                    </li>
                </ol>
                
                <h2 style="color:green;">3. Responsabilità</h2>
                <ol>
                    <li>
                        <h3 style="color:green;">Limitazione di responsabilità</h3>
                        <p>Il sito TripSeeker non può garantire l'accuratezza, la completezza o la veridicità delle informazioni fornite dagli utenti. Sebbene ci impegniamo a mantenere un ambiente sicuro e affidabile, non siamo responsabili per le azioni o i comportamenti degli utenti. Gli incontri e le interazioni tra utenti sono a loro piena discrezione e responsabilità.</p>
                    </li>
                    <li>
                        <h3 style="color:green;">Collegamenti esterni</h3>
                        <p>Il sito può contenere collegamenti ad altri siti web o risorse di terze parti. Questi collegamenti sono forniti solo per comodità degli utenti e non implicano un'approvazione da parte nostra. Non siamo responsabili per la disponibilità o l'accuratezza di tali siti o risorse esterne.</p>
                    </li>
                </ol>
                <h2 style="color:green;">4. Proprietà intellettuale</h2>
                <p>Tutti i diritti di proprietà intellettuale relativi al sito TripSeeker e ai suoi contenuti (ad eccezione dei contenuti forniti dagli utenti) sono di proprietà di TripSeeker. Non è consentito copiare, modificare, distribuire, vendere o noleggiare qualsiasi parte del sito o dei suoi contenuti senza il nostro consenso scritto.</p>
            </div>
            <div id="third_col" ></div>
        </div>
    </div>
   
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
                <li><a href="../FAQ/faq.php"><i class="fas fa-question"></i>&nbsp;FAQ</a></li>
            </ul>
        </div>
    </footer>

   <div class="modal" id="loginPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-image: url(../img/1600806_217886-P0LHA0-902.jpg);background-position: center;background-size: cover;" >
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
                    
                        <div class="text-center text-muted delimiter">oppure accedi tramite social network</div>
                        <div class="d-flex justify-content-center social-buttons">
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <i class="fab fa-linkedin"></i>
                            </button>
                        </div>
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