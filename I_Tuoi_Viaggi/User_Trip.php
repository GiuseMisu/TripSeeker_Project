<!DOCTYPE html>
<html lang="en">
<?php 
    //va messo senno anche senza essere loggato potresti raggiungere questa pagina
    session_start();
    if( !isset($_SESSION['loggato']) ){
        header("Location: index.html");
        exit;
    }
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
    <link rel="stylesheet" href="./tuoi_viaggi.css">
    <title>Viaggi</title>
    
    <script>
        //controlli a seguito partecipazione o abbandono viaggio
        if (window.location.href.indexOf("error=utente-gia-partecipante") > -1) {
            alert("Utente già partecipante a questo viaggio");
            window.location.href = "User_Trip.php";
        }
        if (window.location.href.indexOf("success=partecipazione-registrata") > -1) {
            alert("Partecipazione al viaggio registrata con successo");
            window.location.href = "User_Trip.php";
        }
        if(window.location.href.indexOf("success=partecipazione-eliminata") > -1){
            alert("Viaggio abbandonato con successo");
            window.location.href = "User_Trip.php";
        }
        if(window.location.href.indexOf("error=utente-non-partecipante") > -1){
            alert("Utente non partecipante a questo viaggio");
            window.location.href = "User_Trip.php";
        }
   </script>
   <script>
        function mostraDescrizione(a) {//a è id_viaggio
            
            var descrizioneTextarea = document.getElementById("descrizione-textarea"+a);//in questa maniera distingui i div creati in maniera dinamica
            var etichettaTextarea = document.getElementById("etichetta-textarea"+a);
            var freccia_giu = document.getElementById("freccia_animata_giu"+a);
            var freccia_su = document.getElementById("freccia_animata_su"+a);
            var read_more = document.getElementById("read_more"+a);
            var read_less = document.getElementById("read_less"+a);

            if (descrizioneTextarea.style.display === "none") {
                freccia_giu.style.display = "none";
                freccia_su.style.display = "block";
                etichettaTextarea.style.display = "block";
                descrizioneTextarea.style.display = "block";
                read_less.style.display = "block";
                read_more.style.display = "none";
            } else {
                freccia_giu.style.display  = "block";
                freccia_su.style.display = "none";
                etichettaTextarea.style.display = "none";
                descrizioneTextarea.style.display = "none";
                read_less.style.display = "none";
                read_more.style.display = "block";
            }
        }
    </script>

</head>

<style>
    body{
        background-image: url('../img/pietro-de-grandi-T7K4aEPoGGk-unsplash.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        /* rendi piu trasparente lo sfondo */
        background-color: rgba(255, 255, 255, 0.5);
    }
</style>

<body class="text-center">
    <div class="container-fluid">
    <nav id="barra_nav"   class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="../index.php" ><img src="../img/logo3.0.png" id="logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"  data-toggle="modal" data-target="#loginModal" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link"href="../Lista_Viaggi/index.php">Viaggi</a>                     
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php#section_2" tabindex="-1" aria-disabled="true">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact_Us/contact.html">Contattaci</a>
                    </li>
                    <li class="nav-item" id="lente" > 
                        <a class="nav-link" href="../index.php#central_section"><i class="fas fa-search">&nbsp;&nbsp;</i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <style>
           
        </style>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group d-flex flex-wrap justify-content-center" role="group" aria-label="Button group" style="margin-bottom: 20px;">
                        <!--bottone che se premi refresha la pagina e quindi resetta i filtri-->
                        <button class="verdi btn btn-primary mx-1 my-1" onclick="window.location.href='User_Trip.php'" style="border-radius:7px;"><i class="fas fa-sync-alt black-text"></i></button>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione ASC" value="destinazione ASC">Destinazione &nbsp<i class="fas fa-sort-alpha-down" style="vertical-align: middle;"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione DESC" value="destinazione DESC">Destinazione<i class="fas fa-sort-alpha-up" ></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_partenza" value="data_partenza">Data partenza<i class="fas fa-plane-departure"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_ritorno" value="data_ritorno">Data ritorno<i class="fas fa-plane-arrival"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget ASC" value="budget ASC">Prezzo<i class="fas fa-sort-amount-up"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget DESC" value="budget DESC">Prezzo<i class="fas fa-sort-amount-down"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="posti_disponibili ASC" value="posti_disponibili ASC">Posti liberi<i class="fas fa-long-arrow-alt-up"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="posti_disponibili DESC" value="posti_disponibili DESC">Posti liberi<i class="fas fa-long-arrow-alt-down"></i></button>
                        </form>
                        <!--barra di ricerca quello che scrivi qui viene cercato nella descrizione del viaggio-->
                        <form class="form-inline my-1 my-lg-0 d-flex align-items-center" method="GET">    
                            <input class="form-control mr-2" type="search" placeholder="Cerca per parole chiavi" aria-label="Search" name="search-bar">
                            <button  type="submit" name="search" style="background-color: transparent; border: none;"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--parte sotto barra è griglia-->
        <div class="container-fluid" id="griglia1x3">
            <div id="first_col" ></div>
            <div id="second_col" >
                <?php
                     function propic($email_utente, $caso){
                        $query = "SELECT profile_pic FROM utente WHERE email = '$email_utente'";
                        $result = pg_query($GLOBALS['dbconn'], $query);
                        if($result){//se query che deve trovare la tupla avente email uguale a quella di utente loggato va  a buon fine
                            $tupla = pg_fetch_assoc($result);
                            $path = $tupla['profile_pic'];
                            if($path != null){
                                echo"<style>
                                        .pic {
                                            background-size: cover;
                                            background-position: center;
                                            width: 50px;
                                            height: 50px;
                                            border-radius: 50%;
                                            display: inline-block;
                                            margin: 5px;
                                        }
                                    </style>";
                                $A = "../foto_profilo/$path";
                                if($caso == 1){//sei tu
                                    echo'<a href="../User/index.php"><div style="background-image: url('.$A.');" class="pic" ></div></a>';
                                }
                                else{
                                    echo'<a href="../Other_User/Altro_Utente.php?email='.$email_utente.'"><div style="background-image: url('.$A.');" class="pic"></div></a>';
                                }
                            }
                            else{   //se utente non ha caricato nessuna immagine profilo stampa quella di default 
                                echo '
                                <style>
                                    .pic_null {
                                        background-size: cover;
                                        background-position: center;
                                        width: 50px;
                                        height: 50px;
                                        border-radius: 50%;
                                        display: inline-block;
                                        margin: 5px;
                                    }
                                </style>';
                                $B ="../img/Default_profilepicture.svg.png";
                                if($caso == 1){//sei tu
                                    echo'<a href="../User/index.php"><div style="background-image: url('.$B.');" class="pic_null"></div></a>';
                                }
                                else{
                                    echo'<a href="../Other_User/Altro_Utente.php?email='.$email_utente.'"><div  style="background-image: url('.$B.');" class="pic_null"></div></a>';
                                }
                            }
                        }
                        else{//se query non va a buon fine
                            echo "errore query";
                        } 
                                                       
                    }
                    function get_travel_offers_get($search, $sort_by, $EMAIL) {
                        $sql = "SELECT * FROM Viaggio join partecipazioni on viaggio.id_viaggio = partecipazioni.id_viaggio WHERE ( LOWER(descrizione) LIKE LOWER('%$search%') OR LOWER(destinazione) LIKE LOWER('%$search%') ) AND Partecipazioni.Email_Utente_Partecipante = '$EMAIL' ORDER BY $sort_by";

                        //$sql = "SELECT * FROM Viaggio WHERE LOWER(descrizione) LIKE LOWER('%$search%') OR LOWER(destinazione) LIKE LOWER('%$search%') ORDER BY $sort_by";
                        return $sql;
                    }
                    function get_travel_offers_post($sort_by, $EMAIL) {
                        $sql = "SELECT * FROM Viaggio join Partecipazioni on Viaggio.id_viaggio = Partecipazioni.id_viaggio WHERE Partecipazioni.Email_Utente_Partecipante = '$EMAIL' ORDER BY $sort_by";
                        //$sql = "SELECT * FROM Viaggio ORDER BY $sort_by";
                        return $sql;
                    }
                    function stampa_viaggio($row){   
                        //fai una query che dato email utente organizzatore prende username da utente avente stessa email
                        $email = $row["email_utente_organizzatore"];
                        $sql = "SELECT username FROM Utente WHERE email = $1";
                        $result = pg_query_params($GLOBALS['dbconn'], $sql, array($email));
                        $row2 = pg_fetch_assoc($result);
                        $username = $row2["username"];
                        echo'<div class="container-fluid" style="padding: 12px;"><!--con style messo cosi compaiono i bordi anche laterali-->
                                <div class="row">
                                    <div class="col-1" style="background-color: red;"></div>
                                        <div id="rettangolo_viaggio" onclick="mostraDescrizione('.$row["id_viaggio"].')" >
                                            <br>
                                            <h2 style="text-align: left;">'.$row["titolo"].',&nbsporganizzatore: <a style="color:green;" href="../Other_User/Altro_Utente.php?email='.$row["email_utente_organizzatore"].'">'.$username.'</a></h2>
                                            <br>
                                            <!--<label><b>id_viaggio:</b></label>	id_viaggio non va visualizzato ma serve per mandarlo al server 
                                            <input type="text" class = "campo_testo" disabled value='.$row["id_viaggio"].' size="1">-->
                                            &nbsp                                            
                                            <label><b>Organizzatore:</b></label>';
                                            $lunghezza = strlen($username);
                                            echo'<input type="text" class = "campo_testo" disabled value='.$username.' size="'.$lunghezza.'">
                                            &nbsp';
                                            echo'
                                            <label><b><i class="fas fa-at"></i>Email:</b></label>';
                                            $lunghezza = strlen($row["email_utente_organizzatore"]);
                                            echo '<input type="text" class="campo_testo" disabled value="'.$row["email_utente_organizzatore"].'" size="'.$lunghezza.'">
                                            &nbsp';
                                            echo'
                                            <label><b><i class="fas fa-map-marked-alt"></i>Destinazione:</b></label>';
                                            $lunghezza = strlen($row["destinazione"]);
                                            echo'<input type="text" class = "campo_testo" disabled value='.$row["destinazione"].' size="'.$lunghezza.'">
                                            &nbsp';
                                            echo'
                                            <br><br>
                                            <label><b><i class="fas fa-plane-departure"></i>Partenza:</b></label>
                                            <input class = "campo_testo" disabled value='.$row["data_partenza"].' size="7">
                                            &nbsp
                                            <label><b><i class="fas fa-plane-arrival"></i>Ritorno:</b></label>
                                            <input class = "campo_testo" disabled value='.$row["data_ritorno"].' size="7">
                                            &nbsp
                                            <label><b>Budget:</b></label>
                                            <input type="text" class = "campo_testo" disabled value='.$row["budget"].' style="text-align: right;" size="5" ><i class="fas fa-euro-sign fa-xs"></i> 
                                            &nbsp
                                            <label><b><i class="fas fa-users"></i>Numero partecipanti massimi:</b></label>
                                            <input type="text" class = "campo_testo" disabled value='.($row["num_max_partecipanti"] + 1).' size="1"><!--aggiungo uno perche tieni conto anche del organizzatore-->
                                            &nbsp
                                            <label><b><i class="fas fa-users"></i>Posti rimasti:</b></label>
                                            <input type="text" class = "campo_testo" disabled value='.$row["posti_disponibili"].' size="1">';
                                            
                                            $sql = "SELECT * FROM Partecipazioni WHERE id_viaggio = $1";//query che dato id_viaggio prende tutti i partecipanti associati a quel viaggio
                                            $result = pg_query_params($GLOBALS['dbconn'], $sql, array($row["id_viaggio"]));
                                            if($result){
                                                $num_rows = pg_num_rows($result);
                                                if($num_rows > 0){//fai apparire la lista dei partecipanti solo se ce ne sono
                                                    
                                                    echo'<br><br><label><b><i class="fas fa-user-check"></i>Partecipanti al Trip:</b></label><br>';
                                                    while($row3 = pg_fetch_assoc($result)){
                                                        $email_user = $row3["email_utente_partecipante"];//query per ottenere username utante data email
                                                        
                                                        if( isset($_SESSION['loggato']) ){//questa cosa vale solo se sei loggato
                                                            //devi vedere gli altri partecipanti eccetto chi sta visualizzando
                                                            if($row3["email_utente_partecipante"] != $_SESSION['email']){
                                                                propic($row3["email_utente_partecipante"],2); //funzione che stampa la propic, divisione di casi se sei tu o meno
                                                            }
                                                            else{
                                                                propic($row3["email_utente_partecipante"],1); //funzione che stampa la propic
                                                            }
                                                        }
                                                        else{
                                                            propic($row3["email_utente_partecipante"],2); //funzione che stampa la propic
                                                        }
                                                    }
                                                }
                                            }
                                            else{
                                                echo'errore nella query partecipazioni';
                                            }
                                            echo'
                                            <br>
                                            <b id="read_more'.$row["id_viaggio"].'">Premi per saperne di più</b>
                                            <b id="read_less'.$row["id_viaggio"].'" style="display: none;">Premi per nascondere la descrizione</b>
                                        
                                            <i id="freccia_animata_giu'.$row["id_viaggio"].'" class="fas fa-angle-double-down"></i>
                                            <i id="freccia_animata_su'.$row["id_viaggio"].'" style="display: none;" class="fas fa-angle-double-up"></i>
                                            <br>
                                            <label id="etichetta-textarea'.$row["id_viaggio"].'" style="display: none;"><b>Descrizione</b></label>
                                            <textarea id="descrizione-textarea'.$row["id_viaggio"].'" class="form-control form-control-lg" rows="3" style="display: none;" disabled>'.$row["descrizione"].'</textarea> 
                                            <br>
                                            <div class="container text-center">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="btn-group d-flex flex-wrap justify-content-left" role="group" aria-label="Button group" style="margin-bottom: 20px;">
                                                        <!--essendo che sei nella seizone dei tuoi viaggi non metto il pulsante join-->
                                                            <form action="dismiss.php" method="POST">
                                                                <button type="submit" class="btn btn-danger btn-round d-flex justify-content-center align-items-center mx-1" name="dismiss_button_id_viaggio" value='.$row["id_viaggio"].'>Rinuncia&nbsp <i class="fas fa-backspace"></i></button>
                                                            </form>'; 
                                                            if($row["email_utente_organizzatore"] == $_SESSION['email']){ //se sei il creatore del viaggio fai apparire scritta
                                                                echo "<br><div class='d-flex justify-content-center' style='height:100%; padding:5px;'><h5><i class='fas fa-exclamation-triangle'></i> &nbspSei l'organizzatore del viaggio, rinunciando tutti i partecipanti verranno rimossi</h5></div>";
                                                            }
                                                            else{
                                                                echo'
                                                                <form><!-- form messa solamente per le sue proprietà css che si allinea a tutti gli altri bottoni-->';
                                                                    //se email NON TERMINA CON .COM ALLORA NON TI INSERISCE DA SOLO LA MAIL DENTRO IL CAMPO DESTINATARIO
                                                                    $A = $row["email_utente_organizzatore"];
                                                                    $b = "https://mail.google.com/mail/?view=cm&to=";
                                                                    $c = $b.$A;
                                                                    
                                                                    echo'
                                                                    <style>
                                                                    #bottone_mail_to_2{
                                                                        background-color: #2196F3; /* Blue */
                                                                        border: none;
                                                                        color: white; 
                                                                    }
                                                                    </style>
                                                                    <a target="_blank" id="bottone_mail_to_2" href='.$c.' class="btn  btn-round d-flex justify-content-center align-items-center mx-1"><i class="far fa-envelope"></i>&nbsp;Organizzatore</a>                                                                                                                          
                                                                </form>';
                                                            }
                                                        echo'
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <br>
                        ';
                        
                    }
                 ?>
                <?php
                if(isset($_GET['search'])){
                    $EMAIL = $_SESSION['email'];
                    $search = $_GET['search-bar'];
                    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
//PER RENDERE LA RICERCA CASE UNSENSITIVE metto lower alla colonna cosicche tutti gli elem sono minuscoli e anche quello che cerco lo metto minuscolo
                    if(reset($_POST) != NULL){
                        //echo'<h1>post ricevuta</h1>';     
                        $ordinamento = reset($_POST);
                        //echo '<h1>stai eseguendo ordinamento per:'.$ordinamento.'</h1>';//stampa per confermare che stai ordinando per quello che hai scelto
                        $sql = get_travel_offers_get($search,$ordinamento,$EMAIL);
                    }
                    else{
                        //echo'<h1>post NON ricevuta</h1>';  
                        //echo'<h1>stai eseguendo ordinamento per:default</h1>';
                        $sql = "SELECT * FROM Viaggio join partecipazioni on viaggio.id_viaggio = partecipazioni.id_viaggio WHERE ( LOWER(descrizione) LIKE LOWER('%$search%') OR LOWER(destinazione) LIKE LOWER('%$search%') ) AND Partecipazioni.Email_Utente_Partecipante = '$EMAIL' ORDER BY Viaggio.id_viaggio; ";
                    }
                    
                    $res= pg_query($dbconn, $sql);
                    
                    if($res){//se sono andate entrambe a buon fine
                        $queryResult1 = pg_num_rows($res);
                        if( $queryResult1 > 0 ){
                            echo'<h1 style="color:white;">Viaggi a cui partecipi</h1>';
                            while($row1 = pg_fetch_assoc($res)){
                                stampa_viaggio($row1);
                            }                                   
                        }
                        else{ 
                            echo'<h1 style="color:white;">Nessun viaggio trovato</h1>';
                        } 
                    }
                    else{//se una delle due non va bene restituisci errore
                        echo'errore nella query';
                    }  
                }
                else{           
                    //echo'<h1>get NON ricevuta</h1>';  
                    $EMAIL = $_SESSION['email'];
                    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                    
                    if(reset($_POST) != NULL){
                        $ordinamento = reset($_POST);
                        //echo '<h1>stai eseguendo ordinamento per:'.$ordinamento.'</h1>';//stampa per confermare che stai ordinando per quello che hai scelto
                        $query = get_travel_offers_post($ordinamento,$EMAIL);
                    }
                    else{
                        //echo'<h1>stai eseguendo ordinamento per:default</h1>';
                        $query = "SELECT * FROM Viaggio join Partecipazioni on Viaggio.id_viaggio = Partecipazioni.id_viaggio WHERE Partecipazioni.Email_Utente_Partecipante = '$EMAIL' ORDER BY Viaggio.id_viaggio;";
                    }
                                   
                    $result = pg_query($dbconn, $query);
                    if($result){//se query che deve trovare la tupla avente email uguale a quella di utente loggato va  a buon fine
                        //stampa ogni tupla che trovi nella tabella viaggio
                        //se la lunghezza di result è 0 allora non ci sono viaggi disponibili
                        if(pg_num_rows($result) == 0){
                            echo'<h1 style="color:white;">Nessun viaggio trovato</h1>';
                        }
                        else{
                            echo'<h1 style="color:white;">Viaggi a cui partecipi</h1>';
                            while($row = pg_fetch_assoc($result)){
                                stampa_viaggio($row);                        
                            }
                        }
                    }   
                    else{//se una delle due non va bene restituisci errore
                        echo'errore nella query';
                    }
                }   
                ?>  
            </div>
            <div id="third_col"></div>
        </div>  
    </div>  

    </body>
</html>