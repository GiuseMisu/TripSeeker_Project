<!DOCTYPE html>
<html lang="en">
<?php 
    //se sei stato rindirizzato qui con una get va bene senno errore
    if(isset($_GET['email'])){
        $email_utente = $_GET['email'];
    }
    else{
        echo "errore";
    }
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
    <link rel="stylesheet" href="./Altro_Utente.css">
    
    <?php
        $qu = "SELECT username FROM Utente WHERE email = '$email_utente'";
        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $res = pg_query($dbconn, $qu);
        if ($res){
            $temp = pg_fetch_assoc($res);
            $username = $temp["username"];
        }
        pg_close($dbconn);
    ?>

<title><?php echo'Profilo di '. $username  ;?></title>

        <!--parte per login popup-->
     <script>
      
       function openPopup(){
            document.getElementById("loginPopUp").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }
        function closePopup() {
            document.getElementById("loginPopUp").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }     
        
    </script>
    <script>
        //se url contiene error=password-sbagliata compare alert con errore
        if (window.location.href.indexOf("error=password-sbagliata") > -1) {
            alert("Password sbagliata riprova");
        }
   </script>

</head>


<body class="text-center">
    <div class="container-fluid">
        <nav id="barra_nav" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.php" ><img src="../img/logo3.0.png" id="logo" > </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <!--cambiato link perche dobbiamo ritornare a home in particolare pos--> 
                <a class="nav-link" href="../index.php#section_2" aria-disabled="true">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Contact_Us/contact.html">Contattaci</a>
                </li>
                <li class="nav-item" id="lente" > 
                    <a class="nav-link" href="../index.html#central_section"><i class="fas fa-search">&nbsp;&nbsp;</i></a>
                </li>
            </ul>
            </div>
        </nav>
        <style>
            #sotto_barra_navi{
                height: auto;
            }
            #ref_stelle:visited {/*cosi se lo hai visitato non cambia di colore*/
                color: rgb(3, 3, 3);
            }
            #ref_stelle{
                color: rgb(3, 3, 3) !important;
                text-decoration: none;/*toglie linea sottolineata*/
            }  
        </style>
        <style>
            #griglia1x3{
                background-image: url('../img/james-donaldson-toPRrcyAIUY-unsplash.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                /* rendi piu trasparente lo sfondo */
                background-color: rgba(255, 255, 255, 0.5);
            }
        </style>
        <!--parte sotto barra è griglia-->
        <div class="container-fluid" id="griglia1x3">
            <div id="first_col" ></div>
            <div id="second_col" >
                    <div id="sotto_barra_navi">
                        
                    <?php       //parte per le stelle delle recensioni utente
                        $EMAIL = $email_utente;//ottenuta con get
                        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                        $q = "SELECT username FROM Utente WHERE email = '$EMAIL'";
                        $result = pg_query($dbconn, $q);
                        if($result){
                            $row = pg_fetch_assoc($result);
                            
                            $EMAIL = $email_utente;//ottenuta con get
                            $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                            $sql = "SELECT * FROM recensioni WHERE email_utente_recensito = '$EMAIL'";
                            $res = pg_query($dbconn, $sql);
                            if($res){
                                $somma_voti = 0;
                                $num_recensioni = 0;
                                //scandisci le tuple che trovi
                                while( $tupla = pg_fetch_assoc($res) ){ 
                                    $somma_voti += $tupla["voto"];
                                    $num_recensioni++;                                   
                                }
                                if($num_recensioni == 0){//se non ha nessuna recensione non far apparire nulla
                                    $media_voti = 0;
                                    echo'<h2 style="text-align:left;padding:15px;">'.$row["username"].'</h2>';
                                }
                                else{//altrimenti fai la media e stampa le stelle
                                    $media_voti = $somma_voti/$num_recensioni;
                                    $string = "";
                                    for ($i = 0; $i <$media_voti; $i++) {
                                        $string .= "<i class='fas fa-star fa-xs' style='color:#c7c53e;'></i>";
                                    }
                                    echo"<h3'></h3>";
                                    echo '<h2 style="text-align:left;padding:15px;">'.$row["username"].',<a id="ref_stelle" href="#last_row">'.$string.'('.$num_recensioni.')</a></h2>';
                                }
                                
                            }
                            else{
                                echo "errore query";
                            }
                        }
                        else{
                            echo "errore query";
                        }
                    ?>
                </div>  
                <div class="row" id="first_row">
                    <div id="profpic" class="col-lg-3 col-sm-3">
                        <div id="img_prof" class="profile-pic" >
                            <?php
                                $EMAIL = $email_utente;//ottenuta con get
                                $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                                $query = "SELECT profile_pic FROM utente WHERE email = '$EMAIL'";
                                $result = pg_query($dbconn, $query);
                                if($result){//se query che deve trovare la tupla avente email uguale a quella di utente loggato va  a buon fine
                                    $row = pg_fetch_assoc($result);
                                    $path = $row['profile_pic'];
                                    if($path != null){
                                        echo "<img src=../foto_profilo/$path width='100px' height='100px'>";
                                    }
                                    else{   //se utente non ha caricato nessuna immagine profilo stampa quella di default 
                                        echo "<img src='../img/Default_profilepicture.svg.png' width='100px' height='100px' >";  
                                    }
                                }
                                else{//se query non va a buon fine
                                    echo "errore query";
                                }
                            ?>
                        </div>
                        <br>
                    </div>    <!--parte a destra della foto profilo con nome cognome e username messi nella registrazione-->

                    <div id="dx_profpic" class="col-lg-9 col-sm-9" style="background-color: #ffffff00;  display: flex; justify-content: center;  align-items: center; padding: 50px;"><!--proprieta per centrare sia su y che x -->
                        <div class="row">
                            <?php 
                                $EMAIL = $email_utente;//ottenuta con get
                                $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                                $query = "SELECT * FROM utente WHERE email = '$EMAIL'";
                                $result = pg_query($dbconn, $query);
                                if($result){
                                    $row = pg_fetch_assoc($result);
                                    echo'<div class="form-group col-lg-3 col-sm-5"><label for="nome-input">Nome:</label> <input type="text" class="form-control" id="nome" name="nome" value="'.$row["nome"].'"readonly></div>';
                                    echo'<div class="form-group col-lg-3 col-sm-5"><label for="surname-input">Cognome:</label> <input type="text" class="form-control" id="cognome" name="cognome" value="'.$row["cognome"].'"readonly></div>';
                                    echo'<div class="form-group col-lg-3 col-sm-5"><label for="username-input">Username:</label> <input type="text" class="form-control" id="username-input" name="username" value="'.$row["username"].'"readonly></div>';
                                    echo'<div class="form-group col-lg-4 col-sm-5"><label for="nazionalità-input">Nazionalità:</label><input type="text" class="form-control" name="nazionalita" value="'.$row["nazionalita"].'"readonly></div>';
                                    //email è un campo obbligatorio, telefono no//se uno nella registrazione ha messo pure il telefono comparirà anche nel profilo, altrimenti no
                                    if(isset($row['email']) && $row['telefono'] != ""){ 
                                        echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Email:</label><input type="text" class="form-control" name="email" value="'.$row["email"].'" readonly></div> '; 
                                        echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Telefono:</label><input type="text" class="form-control" name="telefono" value="'.$row["telefono"].'" readonly></div>'; 
                                    } 
                                    elseif(isset($row['email']) && $row['telefono'] == ""){ 
                                        echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Email:</label><input type="text" class="form-control" name="email" value="'.$row["email"].'" readonly></div> '; 
                                    } 
                                }
                                else{
                                    echo "errore query";
                                }
                               
                            ?>                   
                            <form method="POST">
                                <div class="form-group">
                                    <label id="label_bio" for="biografia">Biografia:</label>
                                    <?php
                                        if( isset($row["biografia"]) && $row["biografia"] != ""){
                                            echo'<textarea class="form-control" id="input_biografia" name="input_biografia" rows="4" readonly>'.$row["biografia"].'</textarea>';
                                        }
                                        else{//se nel database non trovi una bio inserita fai apparire la seguente scritta nella text area
                                            echo '<textarea class="form-control" id="input_biografia" name="input_biografia" rows="4" placeholder="nessuna bio..."readonly></textarea>';
                                        }
                                    ?>      
                                </div>
                            </form>  
                                             
                        </div>  
                    </div>
                </div>
                <style>
                #rettangolo_viaggio{
                    width: 100%;
                    height:auto; 
                    padding: 20px;
                    padding-top: 0px;
                    padding-bottom: 0px;
                }
                .campo_testo{
                    border-top: none;
                    border-left: none;
                    border-right: none;
                    border-bottom-color: black;
                    outline: none;
                    text-align : center;
                }
                #rettangolo_viaggio textarea {
                    text-align: center;
                    max-width: 95%;
                    margin: 0 auto;
                }
                #rettangolo_viaggio hr {
                    text-align: center;
                    max-width: 70%;
                    margin: 0 auto;
                }
                </style>
                <div id="second_row" style= "background-color: #ffffff00;  padding:10px; text-align: left;">
                    <h2 style="color:#459f68;">Ultimi viaggi con TripSeeker</h2><hr><!-- linea divisoria-->
                    
                    <?php       //mostra gli ultimi due viaffi effettuatii dall'utente
                        $EMAIL = $email_utente;//ottenuta con get
                        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                        $query = "SELECT * FROM partecipazioni join viaggio on partecipazioni.id_viaggio = viaggio.id_viaggio WHERE partecipazioni.Email_Utente_Partecipante = '$EMAIL'";
                        $result = pg_query($dbconn, $query);
                        if($result){
                            $count = 2;
                            //numero di righe che mi ritorna la query
                            $num_rows = pg_num_rows($result);
                            if($num_rows == 0){
                                echo '<h5 style="text-align: left;">Utente non ha ancora partecipato a nessun viaggio con TripSeeker<br></h5>';
                            }
                            else{
                                while( ($row = pg_fetch_assoc($result)) && $count > 0){
                                    $count = $count - 1;
                                    $email_org = $row["email_utente_organizzatore"];
                                    $sql = "SELECT username FROM Utente WHERE email = $1";
                                    $res = pg_query_params($dbconn, $sql, array($email_org));
                                    $row2 = pg_fetch_assoc($res);
                                    $username = $row2["username"];
                                    //info viaggio prese da db
                                    echo'
                                    <div class="container-fluid" style="padding: 12px;"><!--con style messo cosi compaiono i bordi anche laterali-->
                                        <div class="row">
                                            <div id="rettangolo_viaggio" >
                                            
                                                <h2 style="text-align: left;">'.$row["titolo"].'</h2>
                                                <h5 style="text-align: left; font-style: italic;">organizzato da: <a style="color:green;" href="../Other_User/Altro_Utente.php?email='.$row["email_utente_organizzatore"].'">'.$username.'</a></h5>
                                                                                
                                                <label><b><i class="fas fa-map-marked-alt"></i>Destinazione:</b></label>
                                                <input type="text" class = "campo_testo" disabled value='.$row["destinazione"].' size="7">
                                                &nbsp
                                                <label><b><i class="fas fa-plane-departure"></i>Partenza:</b></label>
                                                <input class = "campo_testo" disabled value='.$row["data_partenza"].' size="7">
                                                &nbsp
                                                <label><b><i class="fas fa-plane-arrival"></i>Ritorno:</b></label>
                                                <input class = "campo_testo" disabled value='.$row["data_ritorno"].' size="7">
                                                &nbsp
                                                <label><b>Budget:</b></label>
                                                <input type="text" class = "campo_testo" disabled value='.$row["budget"].' style="text-align: right;" size="5" ><i class="fas fa-euro-sign fa-xs"></i> 
                                                &nbsp
                                                <label><b><i class="fas fa-users"></i>Participanti</b></label>
                                                <input type="text" class = "campo_testo" disabled value='.($row["num_max_partecipanti"] - $row["posti_disponibili"]).' size="1">
                                                &nbsp
                                                <br><br>
                                                <label style="text-align: center; width: 100%;" id="etichetta-textarea'.$row["id_viaggio"].'" ><b>Descrizione</b></label>
                                                <textarea id="descrizione-textarea'.$row["id_viaggio"].'" class="form-control form-control-lg" rows="3"  readonly>'.$row["descrizione"].'</textarea>    
                                                <br>';
                                                if($count == 1){//dato che mostriamo solo gli ultimi due viaggi fai apparire la riga solo fra il primo e il secondo e non pure alla fine del secondo
                                                    echo' <br><hr>';
                                                }
                                               echo'
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        }
                        else{
                            echo "errore query";
                        }
                    ?>

                        <h2 style="color:#459f68;">Caratteristiche profilo</h2><hr><!-- linea divisoria-->
                        <div id="guarda_interessi" style="display:block; justify-contente:center;" >
                            
                            <?php   
                            $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                            $query = "SELECT * FROM interessiutente WHERE email = '$email_utente'";//mail presa con la get a inizio pagina
                            $result = pg_query($dbconn, $query);
                            $num_rows = pg_num_rows($result);
                            
                            if ($num_rows > 1) {
                                echo "Non possono esistere due righe interessi per utente";
                            } else if ($num_rows == 1) {
                                    $row = pg_fetch_assoc($result);
                                    echo'
                                    <h4>Viaggi</h4>
                                    <div class="row">
                                        <div class="col">
                                            <label for="paesi_visitati_div">Paesi in cui hai viaggiato:</label>
                                            <div id="paesi_visitati_div" class="checkbox_scroll">';
                                                $paesi_visitati = $row["paesi_visitati"];
                                                $count=0;
                                                if($paesi_visitati != null){
                                                    $paesi_visitati = explode(",", $paesi_visitati);
                                                    foreach ($paesi_visitati as $paese) {
                                                        $count++;
                                                        echo '<input type="checkbox" name="paesi_visitati[]" value="'.$paese.'" checked disabled> '.$paese.'<br>';
                                                    }
                                                }
                                                else{
                                                    echo 'Nessun paese selezionato';
                                                }
                                            echo'   
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="lingue_parlate_div">Lingue parlate:</label>
                                            <div id="lingue_parlate_div" class="checkbox_scroll">';
                                                $lingue_parlate = $row["lingue_parlate"];
                                                if($lingue_parlate != null){
                                                    $lingue_parlate = explode(",", $lingue_parlate);
                                                    foreach ($lingue_parlate as $lingua) {
                                                        echo '<input type="checkbox" name="lingue_parlate[]" value="'.$lingua.'" checked disabled> '.$lingua.'<br>';
                                                    }
                                                }
                                                else{
                                                    echo 'Nessuna lingua selezionata';
                                                }
                                            echo'
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="attivita_preferite_div">Attività preferite in viaggio:</label>
                                            <div id="attivita_preferite_div" class=checkbox_scroll >';
                                                $attivita_preferite = $row["attivita_preferite"];
                                                if($attivita_preferite != null){
                                                    $attivita_preferite = explode(",", $attivita_preferite);
                                                    foreach ($attivita_preferite as $attivita) {
                                                        echo '<input type="checkbox" name="attivita_preferite[]" value="'.$attivita.'" checked disabled> '.$attivita.'<br>';
                                                    }
                                                }
                                                else{
                                                    echo 'Nessuna attività selezionata';
                                                }
                                            echo'
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="mezzi_preferiti_div">Mezzi di trasporto più usati:</label>
                                            <div id="mezzi_preferiti_div" class=checkbox_scroll  >';
                                                $mezzi_preferiti = $row["mezzi_trasporto"];
                                                if($mezzi_preferiti != null){
                                                    $mezzi_preferiti = explode(",", $mezzi_preferiti);
                                                    foreach ($mezzi_preferiti as $mezzo) {
                                                        echo '<input type="checkbox" name="mezzi_preferiti[]" value="'.$mezzo.'" checked disabled> '.$mezzo.'<br>';
                                                    }
                                                }
                                                else{
                                                    echo 'Nessun mezzo selezionato';
                                                }
                                            echo'  
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                    <div class="col-lg-3 col-sm-4">
                                        <label for="sv_input">Stile di viaggio ideale:</label>';
                                        $stile_viaggio = $row["stile_viaggio"];
                                        if($stile_viaggio == null){
                                            echo' <input type="text" value="ND" class="form-control" disabled>';
                                        }
                                        else{
                                            echo'  <input type="text" readonly class="form-control" id="sv_input" value="'. $stile_viaggio .'"readonly>';
                                        }
                                        echo'
                                    </div>
                                    <div class="col-lg-3 col-sm-4">
                                        <label for="b_input">Budget medio:</label>';
                                        $budget_medio = $row["budget"];
                                        if($budget_medio == null){
                                            echo' <input type="text" value="ND" class="form-control" disabled>';
                                        }
                                        else{
                                            echo'  <input type="text" readonly class="form-control" id="b_input" value="'. $budget_medio .'"readonly>';
                                        }
                                        echo'
                                    </div>
                                    <div class="col-lg-3 col-sm-4">
                                        <label for="nv_input">Numero di paesi visitati:</label>';
                                        if($count == 0){
                                            echo'<input id="nv_input"  class="form-control" type="text" value="ND"disabled>';
                                        }else{
                                            echo'<input id="nv_input"  class="form-control" type="text" value="'.$count.'"readonly>';
                                        }
                                        echo'
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                                <br>
                                <h4>Vita privata</h4>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="l_input">Lavoro</label>';
                                        $lavoro = $row["professione"];
                                        if($lavoro == null){
                                            echo' <input type="text" value="ND" class="form-control" disabled>';
                                        }
                                        else{
                                            echo' <input type="text" readonly class="form-control" id="l_input" value="'. $lavoro .'"readonly>';
                                        }
                                        echo'
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="studi_input">Studi: </label>';
                                        $studi = $row["titolo_studio"];
                                        if($studi == null){
                                            echo' <input type="text" value="ND" class="form-control" disabled>';
                                        }
                                        else{
                                            echo' <input type="text" readonly class="form-control" id="studi_input" value="'. $studi .'"readonly>';
                                        }
                                        echo'
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="sc_input" class=" align-middle">Stato civile: </label>';
                                        $stato_civile = $row["stato_civile"];
                                        if($stato_civile == null){
                                            echo' <input type="text" value="ND" class="form-control" disabled>';
                                        }
                                        else{
                                            echo' <input type="text" readonly class="form-control" id="sc_input" value="'. $stato_civile .'"readonly>';
                                        }
                                        echo'
                                    </div>
                                </div>
                                <br>
                                <h4>Gusti</h4>
                                <div class="row">
                                    <div class="col">
                                        <label for="gm_div">Genere musicale preferito:</label>
                                        <div class="checkbox_scroll" id="gm_div">';
                                            $gusto_musicale = $row["gusto_musicale"];
                                            if($gusto_musicale != null){
                                                $gusto_musicale = explode(",", $gusto_musicale);
                                                foreach ($gusto_musicale as $gusto) {
                                                    echo '<input type="checkbox" name="gusto_musicale[]" value="'.$gusto.'" checked disabled> '.$gusto.'<br>';
                                                }
                                            }
                                            else{
                                                echo 'Nessun genere selezionato';
                                            }
                                        echo'
                                        </div>
                                    </div>
                                    <div class="col"> 
                                        <label for="gc_div">Tipologia di film preferita:</label>  
                                        <div class="checkbox_scroll" id="gc_div"> ';
                                            $gusto_cinematografico = $row["gusto_cinematografico"];
                                            if($gusto_cinematografico != null){
                                                $gusto_cinematografico = explode(",", $gusto_cinematografico);
                                                foreach ($gusto_cinematografico as $gusto) {
                                                    echo '<input type="checkbox" name="gusto_cinematografico[]" value="'.$gusto.'" checked disabled> '.$gusto.'<br>';
                                                }
                                            }
                                            else{
                                                echo 'Nessun genere selezionato';
                                            }
                                        echo'
                                        </div>
                                    </div>
                                    <div class="col">   
                                        <label for="gs_div">Sport seguiti:</label>                    
                                        <div class="checkbox_scroll" id="gs_div" name="Gusto_Sportivo_checkbox_scroll[]">';
                                            $gusto_sportivo = $row["gusto_sportivo"];
                                            if($gusto_sportivo != null){
                                                $gusto_sportivo = explode(",", $gusto_sportivo);
                                                foreach ($gusto_sportivo as $gusto) {
                                                    echo '<input type="checkbox" name="gusto_sportivo[]" value="'.$gusto.'" checked disabled> '.$gusto.'<br>';
                                                }
                                            }
                                            else{
                                                echo 'Nessun genere selezionato';
                                            }
                                        echo'
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                                <h4>Altro</h4>
                                <div class="row">
                                    <div class="col">
                                        <label for="rs_div">Restrizioni alimentari:</label>           
                                        <div class="checkbox_scroll" id="rs_div">';
                                            $RS = $row["restrizioni_alimentari"];
                                            if($RS == null){
                                                echo 'Nessuna restrizione selezionata';
                                            }
                                            else{
                                                $RS = explode(",", $RS);
                                                foreach ($RS as $a) {
                                                    echo '<input type="checkbox" name="altro[]" value="'.$a.'" checked disabled> '.$a.'<br>';
                                                }
                                            }
                                        echo'
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="tp_div">Patenti:</label>
                                        <div class="checkbox_scroll" id="tp_div">';
                                            $tp = $row["tipo_patente"];
                                            if($tp == null){
                                                echo 'Nessuna patente selezionata';
                                            }
                                            else{
                                                $tp = explode(",", $tp);
                                                foreach ($tp as $b) {
                                                    echo '<input type="checkbox" name="altro[]" value="'.$b.'" checked disabled> '.$b.'<br>';
                                                }
                                            }
                                        echo'
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                </div>
                                <br> '; 
                                }
                                else {
                                    echo "<h5 style='text-align:left;'>Utente non ha ancora inserito nessun interesse</h5>";
                                }
                            
                            ?>
                        </div>     
                     </div>       
                
                    
                
                <style>
                    #last_row {
                        display: flex;
                        flex-direction: row;
                        padding: 10px;
                    }

                    #colonna_form {
                        width: 40%;
                        background-color: whitesmoke;
                        height: 60%;
                        padding: 5px;
                        border-radius: 15px;
                        border-color : green;
                        border-style: solid;

                    }

                    #colonna_recensioni {
                    width: 60%;
                    background-color: white;
                    overflow-y: scroll;
                    max-height: 600px; /* impostare la dimensione massima della colonna */
                    background-color: #ffffff00;
                    }

                    #rettangolo_recensioni {
                    margin-bottom: 20px;
                    }
                    #voto-recensione-input{
                        WIDTH: 50%;
                    }
                    @media screen and (max-width: 800px) {/*se inferiore a 800px, diventa colonna*/
                    #last_row {
                        flex-direction: column;
                    }
                    
                    #colonna_form {
                        width: 100%;
                    }
                    
                    #colonna_recensioni {
                        margin-top: 30px;/*per distanziare dalla colonna form*/
                        width: 100%;
                        height: 300px;
                        overflow-y: scroll;
                    }
                    }
                    /**togliere shadown a input e textarea*/
                    input{
                        border: none;
                        box-shadow: none !important;
                        outline: none;
                    }
                    input:focus{
                        box-shadow: none !important;
                        outline: none;
                    }
                    textarea{
                        border: none;
                        box-shadow: none !important;
                        outline: none;
                    }
                    textarea:focus{
                        box-shadow: none !important;
                        outline: none;
                    }
                    select{
                        border: none;
                        box-shadow: none !important;
                        outline: none;
                    }
                    select:focus{
                        box-shadow: none !important;
                        outline: none;
                    }

                </style>
                <br>
                <script>
                $(document).ready(function() {
                    var form = $('form[name="form_recensioni"]');

                    form.submit(function(e) {
                        e.preventDefault();
                        var formData = form.serialize();

                        $.ajax({
                            type: form.attr('method'),
                            url: "recensioni.php",
                            data: formData,
                            success: function(response) {
                                 // Ricarica la sezione della barra di navigazione, quella con le stelline
                                $("#sotto_barra_navi").load(location.href + " #sotto_barra_navi > *");
                                // Ricarica la sezione delle recensioni con i dati appena inseriti
                                $("#colonna_recensioni").load(location.href + " #recensioni_pr");
                                $("#form_rece")[0].reset();
                                // Mostra il messaggio di successo o di errore
                                var result = JSON.parse(response);
                                if (result.giarecensito) {
                                    $("#risultato-recensione").text("Utente già recensito!");
                                } else {
                                    $("#risultato-recensione").text("Recensione inserita con successo!");
                                }
                                // Resetta il form
                                $("#form_rece")[0].reset();
                            },
                            error: function() {
                                console.log("Si è verificato un errore nella richiesta Ajax.");
                            }
                        });
                    });
                });
                </script>

                <h2 style="color:#459f68;text-align:left;margin-left:8px;" >Recensioni</h2><hr><!-- linea divisoria-->
                <div id="last_row" >
                    
                    <!--parte destra è rettangolo con form per inserire recensione, parte sinistra è rettangolo con recensioni-->
                    <div id="colonna_form" style="text-align:left;">

                        <h4 style="text-align:center;">Hai viaggiato con <?php
                            $EMAIL = $email_utente;//ottenuta con get
                            $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                            $q = "SELECT username FROM Utente WHERE email = '$EMAIL'";
                            $result = pg_query($dbconn, $q);
                            if($result){
                                $row = pg_fetch_assoc($result);
                                echo $row["username"];
                            }
                            else{
                                echo "errore query";
                            }
                        ?>? Lascia una recensione!</h4>
                        <form name="form_recensioni" action="recensioni.php" method="POST" id="form_rece">
                            <input type="hidden" name="email_utente_recensito" value="<?php echo $email_utente; ?>">
                            <?php
                                if(isset($_SESSION['username']) || isset($_SESSION['loggato'])){
                                    echo '<input type="hidden" name="email_utente_recensore" value="'.$_SESSION["email"].'">';
                                    echo '<input type="hidden" name="username_recensore" value="'.$_SESSION["username"].'">';
                                }
                                //se non sei loggato non visualizzi bottone
                            ?>
                            <label >Titolo</label>
                            <input type="text" class="form-control" id="titolo-recensione-input" name="titolo_recensione_input" placeholder="Inserisci titolo" required>
                            <label style="text-align:left;">Valutazione</label>
                            <!-- drop down menu per voto-->
                            <select class="form-control" id="voto-recensione-input" name="voto_recensione_input" required>
                                <option></option>
                                <option value="5" style="color:#c7c53e">★★★★★</option>
                                <option value="4" style="color:#c7c53e">★★★★☆</option>
                                <option value="3" style="color:#c7c53e">★★★☆☆</option>
                                <option value="2" style="color:#c7c53e">★★☆☆☆</option>
                                <option value="1" style="color:#c7c53e">★☆☆☆☆</option>
                            </select>
                            <!-- text area per testo recensione-->
                            <label style="text-align:left;">Testo</label>
                            <textarea class="form-control" id="testo-recensione-input" name="testo_recensione_input" rows="3" placeholder="Inserisci testo" required ></textarea>
                            <br>
                            <h5 style="color:green;" id="risultato-recensione"></h5>
                            <?php
                                if(isset($_SESSION['username']) || isset($_SESSION['loggato'])){
                                    if($_SESSION['email'] == $email_utente){//se sei tu stesso non puoi lasciare recensione
                                        echo'<h6>Non puoi lasciare una recensione a te stesso</h6>';
                                    }
                                    else{
                                        echo'<button type="submit" class="btn btn-outline-dark">Invia</button>';
                                    }
                                }
                                else{   //nel caso in cui tu non sia loggato:
                                    echo'<h6 style="color:green;"><a style="color:green;" href="../signUp/index.php">Registrati</a> o <a style="color:green; text-decoration:underline" onclick="openPopup()">accedi</a> per lasciare una recensione</h6>';
                                }
                            ?>
                        </form>
                    </div>
                    <style>
                        #colonna_recensioni{
                            padding: 10px;
                        }
                    </style>
                    <div id="colonna_recensioni">
                            <?php               
                            echo'<div id="recensioni_pr">';
                                $EMAIL = $email_utente;//ottenuta con get
                                $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                                $sql = "SELECT * FROM recensioni WHERE email_utente_recensito = '$EMAIL'";
                                $res = pg_query($dbconn, $sql);
                                if($res){
                                    //numero di tuple trovate
                                    $num_tupla = pg_num_rows($res);
                                    if($num_tupla == 0){
                                        echo "<h3 style='text-align:center;'>Non sono ancora presenti recensioni su questo profilo</h3>";
                                    }
                                    else{
                                        //scandisci le tuple che trovi
                                        while( $tupla = pg_fetch_assoc($res) ){ 
                                            echo "<h6 style='text-align:left;'>Recensore: <a href='Altro_Utente.php?email=".$tupla["email_utente_recensore"]."'>".$tupla["username_recensore"]."</a></h6>";
                                            $string = "";
                                            for ($i = 0; $i < $tupla["voto"]; $i++) {
                                                $string .= "<i class='fas fa-star' style='color:#c7c53e;'></i>";
                                            }
                                            echo "<h6 style='text-align:left;'>".$tupla["titolo"]." ".$string."</h6>";
                                            echo "<textarea class='form-control' id='testo-recensione-input' name='testo_recensione_input' rows='2' disabled>".$tupla["descrizione_recensione"]."</textarea>";
                                            echo"<hr>";
                                        }
                                    }
                                }
                                else{
                                    echo "errore query";
                                }
                            echo'</div>';
                            ?>
                            
                    </div>
                </div>
            </div>
            <div id="third_col"></div>
        </div>  
    </div> 

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
         /*parte login popup*/
         .container {
            padding: 2rem 0rem;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 400px;
            }
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
            

    </style>
    <div id="overlay" class="overlay blur"></div>
    <!--log in PopUp-->
    <div class="modal" id="loginPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-image: url(../img/15226638_v660-mon-04-travelbadge.jpg);background-position: center;background-size: cover;z-index:1032;">
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
                        <form name="myForm" action="login_from_altro_utente.php" method="POST" class="form-signin">
                            <input type="hidden" name="email_utente_profilo" value="<?php echo $EMAIL; ?>">
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