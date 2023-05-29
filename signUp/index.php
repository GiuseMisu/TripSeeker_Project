<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.css"/>
    <script src="../bootstrap-5.2.3/dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.js'></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <script src="./singUp.js"></script>
    <link rel="stylesheet" href="./singUp.css">
    
    <title>Registrazione</title>
    
</head>
<body class="text-center">
    <div class="container-fluid">
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
        <div id="div_sotto_barra">
            <div class="row">
            </div>
        </div>    
        <br><br><br><br>
    <!--div rettangolare con delle immagini che separa da form -->
        <div class="container-fluid" id="griglia1x3" style="text-align: left;">
            <div id="first_col" ></div>
            <div id="second_col"  style="padding:10px;">
                <form name="modulo_signup" action="registrazione.php" method="POST" onsubmit="return controlla_campi()" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <br><h1 id="titoloform">Compila i campi per registrarti</h1>
                            <br><h2>Dati anagrafici</h2>
                            <div class="row">
            <!-- prima parte form z-->
                                <div class="col-md-6 form-group"><label for="nome">Nome</label> <input type="text" id="nome" class="form-control" name="inputNome" placeholder="Nome" required></div>
                                <div class="col-md-6 form-group"><label for="cognome">Cognome</label> <input type="text" id="cognome" class="form-control" name="inputCognome" placeholder="Cognome" required></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group"><label for="cittaN">Citta di nascita</label> <input type="text" id="cittaN" class="form-control" name="inputCittaN" placeholder="Città di nascita" required></div>
                                <div class="col-md-3 form-group"><label for="nazio">Nazionalità</label> <input type="text" id="nazio" class="form-control" name="inputNazio" placeholder="Nazionalità" required></div>
                                <div class="col-md-3 form-group"><label for="data_nascita">Data di nascita</label> <input type="date" id="data_nascita" class="form-control" name="inputData_nascita" placeholder="Data di nascita" required></div>
                                <div class="col-md-2 form-group"><label for="sesso">Sesso</label> 
                                    <select id="sesso" class="form-control" name="inputSesso" placeholder="Sesso" required>
                                    <option value="" selected>-</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                    <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>                     
            <!-- Seconda parte form z-->
                            <br>
                            <div class="row"><div class="col-md-12 form-group"><hr></div></div><!-- linea divisoria-->
                            <br><br><h2>Profilo</h2>    
                            <div class="row">
                                <!--devi fare in js un or fra telefono e email-->
                                <div class="col-md-6 form-group"><label for="telefono">Telefono</label> <input type="text" id="telefono" class="form-control" name="inputTelefono" placeholder="Telefono"></div>
                                <div class="col-md-6 form-group"><label for="email">Email</label> <input type="email" id="email" class="form-control" name="inputEmail" placeholder="Email" required ></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 form-group"><label for="username">Username</label> <input type="text" id="username" class="form-control" name="inputUsername" placeholder="Username" required></div> 
                                <div class="col-md-4 form-group"><label for="immagine_profilo">Immagine profilo</label> <input type="file" id="immagine_profilo" class="form-control" name="image" accept="image/*" placeholder="Immagine profilo"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 form-group"><label for="password">Password</label> <input type="password" id="password" class="form-control" name="inputPassword" placeholder="Password" required></div>
                                <div class="col-md-5 form-group"><label for="conferma_password">Conferma password</label> <input type="password" id="conferma_password" class="form-control" name="inputConferma_password" placeholder="Conferma password" required></div>   
                            </div> 
                            <br><br><br>
                            <div class="col-md-12 form-group" ><input type="submit" value="Registrati" class="btn btn-success btn-block py-2 px-2"></div>    
                            <br><br><br>
                        </div>
                    </div>
                </form>
            </div>
            <div id="third_col"></div>
        </div>  
    </div>
    <br><br><br><br>
    <!--parte che deve stare sempre sotto-->
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
                <li><a href="../Termini_Condizioni/Termini_Condizioni.php"><i class="fas fa-list"></i>&nbsp;Termini e condizioni</a></li>
                <li><a href="../FAQ/faq.php"><i class="fas fa-question"></i>&nbsp;FAQ</a></li>
            </ul>
        </div>
    </footer>

    
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /*background-color: rgba(0, 0, 0, 0.5);*/
            z-index: 1031;
            display: none;
        }
        .overlay.blur {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        
        #e_input:focus,#pswrd_input:focus {
            box-shadow: 0 0 10px #4c9b48 !important;
            border-color: #4c9b48 !important;
        }
            

    </style>

<div id="overlay" class="overlay blur"></div>
    <!--log in PopUp-->
    <div class="modal" id="loginPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-image: url(../img/1600806_217886-P0LHA0-902.jpg);background-position: center;background-size: cover;z-index: 1032;">
                <div class="modal-header border-bottom-0">
                    <style>
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
                                <input id="e_input"type="email" placeholder="indirizzo mail..." name="inputEmail" class="form-control" required autofocus>
                            </div>
                            <br>
                            <div class="form-group">
                                <input id="pswrd_input" type="password" placeholder="password..." name="inputPassword" class="form-control" required>
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
                    <div class="signup-section">Non hai un account? <a href="./signUp/index.php" class="text-info"> Registrati!</a></div>
                </div>
            </div>
        </div>
    </div> 
    


</body>
</html>