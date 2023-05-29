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
    <link rel="stylesheet" href="./index.css">
    <title>Profilo Utente</title>
    
</head>


<body class="text-center">
    <div class="container-fluid">
        <nav id="barra_nav" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.php" ><img src="../img/logo3.0.png" id="logo"></a>
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
                <a class="nav-link" href="../index.php#section_2" aria-disabled="true">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Contact_Us/contact.html">Contattaci</a>
                </li>
                <li class="nav-item" id="lente" > 
                    <a class="nav-link" href="../index.php#central_section"><i class="fas fa-search">&nbsp;&nbsp;</i></a>
                </li>
            </ul>
            </div>

            <button id="TastoLogOut" type="button" class="btn btn-info btn-round d-flex justify-content-center align-items-center" onclick="window.location.href='../logout.php'">Logout<i class="fas fa-sign-out-alt"></i></button>
        </nav>
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
                <div class="row" id="first_row">
                    <div id="profpic" class="col-lg-3 col-sm-3">
                        <div id="img_prof" class="profile-pic" >
                        <?php
                            $EMAIL = $_SESSION['email'];
                            $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                            $query = "SELECT profile_pic FROM utente WHERE email = '$EMAIL'";
                            $result = pg_query($dbconn, $query);
                            if($result){//se query che deve trovare la tupla avente email uguale a quella di utente loggato va  a buon fine
                                $row = pg_fetch_assoc($result);
                                $path = $row['profile_pic'];
                                if($path != null){
                                    if (isset($_POST['submit'])) {//se ricevi una post stampa la foto caricata
                                        // image e sue prop
                                        $image = $_FILES['image']['tmp_name'];
                                        $image_name = $_FILES['image']['name'];
                                        $image_size = $_FILES['image']['size'];
                                        
                                        if ($image_size > 0) {// Check se imagine_size è maggiore di 0
                                            
                                            // imposto dove salvare la foto caricata
                                            move_uploaded_file($image, "../foto_profilo/" . $image_name);
                                            
                                            // inserisco il nome della foto nel db
                                            $query = "UPDATE utente SET profile_pic = '$image_name' WHERE email = '$EMAIL'";

                                            pg_query($dbconn, $query);

                                            $query = "SELECT profile_pic FROM utente WHERE email = '$EMAIL'";
                                            $result = pg_query($dbconn, $query);
                                            $row = pg_fetch_assoc($result);
                                            $path = $row['profile_pic'];

                                            // faccio apparire foto nel div
                                            echo "<img src=../foto_profilo/$path width='100px' height='100px'>";      
                                        }
                                    }
                                    else{//se non ricevi nessuna post stampa la foto gia presente
                                        echo "<img src=../foto_profilo/$path width='100px' height='100px'>";
                                    }
                                }
                                else{//se utente non ha caricato nessuna immagine profilo stampa quella di default se non c'è nessuna post ricevuta
                                    if(!isset($_POST['submit'])){
                                        echo "<img src='../img/Default_profilepicture.svg.png' width='100px' height='100px' >";
                                    }
                                    else {//se ricevi una post stampa la foto caricata
                                          // image e sue prop
                                        $image = $_FILES['image']['tmp_name'];
                                        $image_name = $_FILES['image']['name'];
                                        $image_size = $_FILES['image']['size'];

                                        if ($image_size > 0) {
                                            //cosi imposto dove salvare la foto caricata
                                            move_uploaded_file($image, "../foto_profilo/" . $image_name);
                                            
                                            $query = "UPDATE utente SET profile_pic = '$image_name' WHERE email = '$EMAIL'";

                                            pg_query($dbconn, $query);

                                            $query = "SELECT profile_pic FROM utente WHERE email = '$EMAIL'";
                                            $result = pg_query($dbconn, $query);
                                            $row = pg_fetch_assoc($result);
                                            $path = $row['profile_pic'];

                                            echo "<img src=../foto_profilo/$path width='100px' height='100px'>";      
                                        }
                                    }
                                }
                            }
                            else{//se query non va a buon fine
                                echo "errore query";
                            }
                        ?>
                        </div>
                        <br>
                        <style>/*style per il tasto input type=file */
                            .input-file{
                                border: 1px solid #ccc;
                                display: inline-block;
                                padding: 6px 12px;
                                cursor: pointer;
                                background-color: #4bc279ca;
                            }
                            input[type="file"] {
                                display: none;
                            }
                        </style>
                        <script>
                            //script affinchè il bottone upload sia disabilitato all'inizio e abilitato quando viene selezionato un file

                            // Attendi che la pagina sia completamente caricata
                            window.addEventListener("DOMContentLoaded", function() {
                                // Disabilita il pulsante "Carica" all'inizio
                                document.getElementById("uploadButton").disabled = true;
                                document.getElementById("fileInput").addEventListener("change", function() {
                                    // Abilita il pulsante "Carica" quando viene selezionato un file
                                    if (this.files.length > 0) {
                                        document.getElementById("uploadButton").disabled = false;
                                    } else {
                                        document.getElementById("uploadButton").disabled = true;

                                    }
                                });
                            });
                        </script>
                            
                        <form method="post" enctype="multipart/form-data">
                            <label class="input-file" >
                                <input type="file" id="fileInput" name="image" accept="image/*" >
                                Scegli
                            </label>
                            <input class="input-file" id="uploadButton" type="submit" name="submit" value="Carica">
                        </form>
                        <form name="remove_pro_pic" method="POST" action="remove_pro_pic.php">
                            <button name="remove_propic" type="submit" id="remove_propic" style="background-color: transparent; border: none;"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>

                    <div id="dx_profpic" class="col-lg-9 col-sm-9" style=" background-color: #ffffff00; display: flex; justify-content: center;  align-items: center; padding: 50px;"><!--proprieta per centrare sia su y che x -->
                        <div class="row">
                            <?php 
                                echo'<div class="form-group col-lg-3 col-sm-5"><label for="nome-input">Nome:</label> <input type="text" class="form-control" id="nome" name="nome" value="'.$_SESSION["nome"].'"readonly></div>';
                                echo'<div class="form-group col-lg-3 col-sm-5"><label for="surname-input">Cognome:</label> <input type="text" class="form-control" id="cognome" name="cognome" value="'.$_SESSION["cognome"].'"readonly></div>';
                                echo'<div class="form-group col-lg-3 col-sm-5"><label for="username-input">Username:</label> <input type="text" class="form-control" id="username-input" name="username" value="'.$_SESSION["username"].'"readonly></div>';
                                echo'<div class="form-group col-lg-4 col-sm-5"><label for="nazionalità-input">Nazionalità:</label><input type="text" class="form-control" name="nazionalita" value="'.$_SESSION["nazionalita"].'"readonly></div>';
                                //email è un campo obbligatorio, telefono no//se uno nella registrazione ha messo pure il telefono comparirà anche nel profilo, altrimenti no
                                if(isset($_SESSION['email']) && $_SESSION['telefono'] != ""){ 
                                    echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Email:</label><input type="text" class="form-control" name="email" value="'.$_SESSION["email"].'" readonly></div> '; 
                                    echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Telefono:</label><input type="text" class="form-control" name="telefono" value="'.$_SESSION["telefono"].'" readonly></div>'; 
                                } 
                                elseif(isset($_SESSION['email']) && $_SESSION['telefono'] == ""){ 
                                    echo '<div class="form-group col-lg-3 col-sm-5"><label for="recapito-input">Email:</label><input type="text" class="form-control" name="email" value="'.$_SESSION["email"].'" readonly></div> '; 
                                } 
                            ?>  
                              
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    //distinzione avviene in base al nome del bottone di submit
                                    if (isset($_POST['submit_bio']) && strlen($_POST["input_biografia"]) < 150) {//bio deve essere settata e deve essere minore di 150 caratteri
                                        // codice per gestire il submit della prima form
                                        $biografia = $_POST["input_biografia"];
                                        $_SESSION["biografia"] = $biografia;
                                        $email = $_SESSION["email"];
                                        $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                                        $query = "SELECT * FROM utente WHERE email = '$email'";
                                        $result = pg_query($dbconn, $query);
                                        if (pg_num_rows($result) > 0) {
                                            $query2 = "UPDATE utente SET biografia = $1 WHERE email = '$email'";
                                            pg_query_params($dbconn, $query2, array($biografia));
                                        }
                                    } 
                                } 
                            ?>
                            <script>
                                function caratteri_max_bio(){
                                    var bio = document.getElementById("input_biografia").value;
                                    if(bio.length > 150){
                                        alert("Hai superato il limite di 150 caratteri");
                                        return false;
                                    }
                                    else{
                                        return true;
                                    }
                                }
                            </script>
                            
                            <form method="POST">
                                <div class="form-group">
                                    <label id="label_bio" for="biografia">Biografia:</label>
                                    <button name="submit_bio" type="submit" id="refresh_bio" onclick="return caratteri_max_bio()" style="background-color: transparent; border: none;"><i class="fas fa-save"></i></button>
                                    <?php
                                        if( isset($_SESSION["biografia"]) && $_SESSION["biografia"] != ""){
                                            echo'<textarea class="form-control" id="input_biografia" name="input_biografia" rows="4" >'.$_SESSION["biografia"].'</textarea>';
                                        }
                                        else{//se nel database non trovi una bio inserita fai apparire la seguente scritta nella text area
                                            echo '<textarea class="form-control" id="input_biografia" name="input_biografia" rows="4" placeholder="inserire qui la tua bio..."></textarea>';
                                        }
                                    ?>      
                                </div>
                            </form>  
                                             
                        </div>  
                    </div>
                </div>
                <style>
       
                /* Stile per il div checkbox_scroll */
                .checkbox_scroll {
                    max-height: 150px;
                    max-width: 250px;
                    width : 250px;
                    height: 180px;
                    border-radius: 0.25rem;
                    background-color: #4bc2797a;
                    border: 1px solid #4bc279;
                    padding: 5px;
                    overflow-y: auto;
                    scrollbar-width: thin;
                    scrollbar-color: #6c757d #f8f9fa;
                    margin-bottom: 10px;
                }
                
                /* Stile per la scrollbar */
                .checkbox_scroll::-webkit-scrollbar {
                    width: 8px;
                }
                
                .checkbox_scroll::-webkit-scrollbar-thumb {
                    background-color: #6c757d;
                    border-radius: 6px;
                }
                
                .checkbox_scroll::-webkit-scrollbar-thumb:hover {
                    background-color: #5a6268;
                }
                
                .checkbox_scroll::-webkit-scrollbar-track {
                    background-color: #f8f9fa;
                    border-radius: 6px;
                }
                #bottone_delete{
                    padding: 0px;
                    text-decoration: underline;
                }
                        
                </style>
                <script>
                    function modifica_interessi(){
                        var x = document.getElementById("modifica_gli_interessi");
                        var y = document.getElementById("guarda_interessi");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                            y.style.display = "none";
                        } else {
                            x.style.display = "none";
                            y.style.display = "block";
                        }
                    }
                </script>

                
    
                <div id="second_row" style= " background-color: #ffffff00; padding:10px; text-align: left;">
                    <h3>Caratteristiche profilo<button id="modifica_interessi" onclick="modifica_interessi()" style="background-color: transparent; border: none;"><i class="fas fa-edit"></i></button></h3>
                    <h6>completamento profilo:</h6>
                    <div class="progress" role="progressbar" id="progressBar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" id="progressBar2" style="width: 0%">0%</div>
                    </div>

                    


                    <hr><!-- linea divisoria-->
                    
                    <div id="guarda_interessi" style="display:block; justify-contente:center;" >
                        <form action="delete_interessi.php" method="post" id="delete-interest-form">
                            <input type="hidden" name="email" value="<?php echo $_SESSION["email"];?>">
                            <button id="bottone_delete" type="submit" class="btn " >Cancella i tuoi interessi&nbsp;<i class="fas fa-redo-alt"></i></button>
                        </form>
                        <?php   
                           $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                           $email = $_SESSION["email"];
                           $query = "SELECT * FROM interessiutente WHERE email = '$email'";
                           $result = pg_query($dbconn, $query);
                           $num_rows = pg_num_rows($result);
                           $num_interessi = 0;


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
                                                $num_interessi++;
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
                                                $num_interessi++;
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
                                                $num_interessi++;
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
                                                $num_interessi++;
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
                                        $num_interessi++;
                                    }
                                    echo'
                                </div>
                                <div class="col-lg-3 col-sm-4">
                                    <label for="b_input">Budget medio per viaggio:</label>';
                                    $budget_medio = $row["budget"];
                                    if($budget_medio == null){
                                        echo' <input type="text" value="ND" class="form-control" disabled>';
                                    }
                                    else{
                                        echo'  <input type="text" readonly class="form-control" id="b_input" value="'. $budget_medio .'"readonly>';
                                        $num_interessi++;
                                    }
                                    echo'
                                </div>
                                <div class="col-lg-3 col-sm-4">
                                    <label for="nv_input">Numero di paesi visitati:</label>';
                                    if($count == 0){
                                        echo'<input id="nv_input"  class="form-control" type="text" value="ND"disabled>';
                                    }else{
                                        echo'<input id="nv_input"  class="form-control" type="text" value="'.$count.'"readonly>';
                                        $num_interessi++;
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
                                        $num_interessi++;
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
                                        $num_interessi++;
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
                                        $num_interessi++;
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
                                                $num_interessi++;
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
                                                $num_interessi++;
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
                                                $num_interessi++;
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
                                            $num_interessi++;
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
                                            $num_interessi++;
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
                               echo "Non hai ancora inserito nessun interesse";
                            }
                           

                            echo '<script>';
                            echo 'var numInteressi = ' . $num_interessi . ';'; // Stampa il valore della variabile come parte del codice JavaScript
                            echo '</script>';
                        ?>
                    </div>
                    <style>
                        
                    </style>
                    <div id ="modifica_gli_interessi" style="display:none; justify-contente:center;" >
                        <form method="POST" action="insert_interessi.php" name="modulo_prova" id="form_caratteristiche_user" style="justify-contente:center;">
                           <h4>Viaggi</h4>
                            <div class="row">
                                <input type="hidden" name="email" value="<?php echo $_SESSION["email"];?>">
                                <div class="col">
                                    <label for="paesi_visitati_div">Paesi in cui hai viaggiato:</label>
                                    <div id="paesi_visitati_div" class="checkbox_scroll"> <!--ELENCO DI TUTTI I PAESI CON CHECKBOX-->
                                        <input value="Afghanistan" id="chk1" name="checkbox_paesi[]" type="checkbox">Afghanistan</input><br>
                                        <input value="Aland Islands" id="chk2" name="checkbox_paesi[]" type="checkbox">Isole Aland</input><br>
                                        <input value="Albania" id="chk3" name="checkbox_paesi[]" type="checkbox">Albania</input><br>
                                        <input value="Algeria" id="chk3" name="checkbox_paesi[]" type="checkbox">Algeria</input><br>
                                        <input value="American Samoa" id="chk4" name="checkbox_paesi[]" type="checkbox">Samoa americane</input><br>
                                        <input value="Andorra" id="chk5" name="checkbox_paesi[]" type="checkbox">Andorra</input><br>
                                        <input value="Angola" name="checkbox_paesi[]" type="checkbox">Angola</input><br>
                                        <input value="Anguilla" name="checkbox_paesi[]" type="checkbox">Anguilla</input><br>
                                        <input value="Antarctica" name="checkbox_paesi[]" type="checkbox">Antartide</input><br>
                                        <input value="Antigua and Barbuda" name="checkbox_paesi[]" type="checkbox">Antigua e Barbuda</input><br>
                                        <input value="Argentina" name="checkbox_paesi[]" type="checkbox">Argentina</input><br>
                                        <input value="Armenia" name="checkbox_paesi[]" type="checkbox">Armenia</input><br>
                                        <input value="Aruba" name="checkbox_paesi[]" type="checkbox">Aruba</input><br>
                                        <input value="Australia" name="checkbox_paesi[]" type="checkbox">Australia</input><br>
                                        <input value="Austria" name="checkbox_paesi[]" type="checkbox">Austria</input><br>
                                        <input value="Azerbaijan" name="checkbox_paesi[]" type="checkbox">Azerbaigian</input><br>
                                        <input value="Bahamas" name="checkbox_paesi[]" type="checkbox">Bahamas</input><br>
                                        <input value="Bangladesh" name="checkbox_paesi[]" type="checkbox">Bangladesh</input><br>
                                        <input value="Barbados" name="checkbox_paesi[]" type="checkbox">Barbados</input><br>
                                        <input value="Belarus" name="checkbox_paesi[]" type="checkbox">Bielorussia</input><br>
                                        <input value="Belgium" name="checkbox_paesi[]" type="checkbox">Belgio</input><br>
                                        <input value="Belize" name="checkbox_paesi[]" type="checkbox">Belize</input><br>
                                        <input value="Benin" name="checkbox_paesi[]" type="checkbox">Benin</input><br>
                                        <input value="Bermuda" name="checkbox_paesi[]" type="checkbox">Bermuda</input><br>
                                        <input value="Bhutan" name="checkbox_paesi[]" type="checkbox">Bhutan</input><br>
                                        <input value="Bolivia" name="checkbox_paesi[]" type="checkbox">Bolivia</input><br>
                                        <input value="Bosnia and Herzegovina" name="checkbox_paesi[]" type="checkbox">Bosnia Erzegovina</input><br>
                                        <input value="Botswana" name="checkbox_paesi[]" type="checkbox">Botswana</input><br>
                                        <input value="Brazil" name="checkbox_paesi[]" type="checkbox">Brasile</input><br>
                                        <input value="Brunei Darussalam" name="checkbox_paesi[]" type="checkbox">Brunei Darussalam</input><br>
                                        <input value="Bulgaria" name="checkbox_paesi[]" type="checkbox">Bulgaria</input><br>
                                        <input value="Burkina Faso" name="checkbox_paesi[]" type="checkbox">Burkina Faso</input><br>
                                        <input value="Burundi" name="checkbox_paesi[]" type="checkbox">Burundi</input><br>
                                        <input value="Cambodia" name="checkbox_paesi[]" type="checkbox">Cambogia</input><br>
                                        <input value="Cameroon" name="checkbox_paesi[]" type="checkbox">Camerun</input><br>
                                        <input value="Canada" name="checkbox_paesi[]" type="checkbox">Canada</input><br>
                                        <input value="Cape Verde" name="checkbox_paesi[]" type="checkbox">capo Verde</input><br>
                                        <input value="Cayman Islands" name="checkbox_paesi[]" type="checkbox">Isole Cayman</input><br>
                                        <input value="Central African Republic" name="checkbox_paesi[]" type="checkbox">Repubblica Centrafricana</input><br>
                                        <input value="Chad" name="checkbox_paesi[]" type="checkbox">Chad</input><br>
                                        <input value="Chile" name="checkbox_paesi[]" type="checkbox">Chile</input><br>
                                        <input value="China" name="checkbox_paesi[]" type="checkbox">Cina</input><br>
                                        <input value="Colombia" name="checkbox_paesi[]" type="checkbox">Colombia</input><br>
                                        <input value="Comoros" name="checkbox_paesi[]" type="checkbox">Comore</input><br>
                                        <input value="Congo" name="checkbox_paesi[]" type="checkbox">Congo</input><br>
                                        <input value="Democratic Republic of the Congo" name="checkbox_paesi[]" type="checkbox">Repubblica Democratica del Congo</input><br>
                                        <input value="Costa Rica" name="checkbox_paesi[]" type="checkbox">Costa Rica</input><br>
                                        <input value="Cote D Ivoire" name="checkbox_paesi[]" type="checkbox">Costa d'Avorio</input><br>
                                        <input value="Croatia" name="checkbox_paesi[]" type="checkbox">Croazia</input><br>
                                        <input value="Cuba" name="checkbox_paesi[]" type="checkbox">Cuba</input><br>
                                        <input value="Curacao" name="checkbox_paesi[]" type="checkbox">Curacao</input><br>
                                        <input value="Cyprus" name="checkbox_paesi[]" type="checkbox">Cipro</input><br>
                                        <input value="Czech Republic" name="checkbox_paesi[]" type="checkbox">Repubblica Ceca</input><br>
                                        <input value="Denmark" name="checkbox_paesi[]" type="checkbox">Danimarca</input><br>
                                        <input value="Djibouti" name="checkbox_paesi[]" type="checkbox">Gibuti</input><br>
                                        <input value="Dominica" name="checkbox_paesi[]" type="checkbox">Dominica</input><br>
                                        <input value="Dominican Republic" name="checkbox_paesi[]" type="checkbox">Repubblica Dominicana</input><br>
                                        <input value="Ecuador" name="checkbox_paesi[]" type="checkbox">Ecuador</input><br>
                                        <input value="Egypt" name="checkbox_paesi[]" type="checkbox">Egitto</input><br>
                                        <input value="El Salvador" name="checkbox_paesi[]" type="checkbox">El Salvador</input><br>
                                        <input value="Equatorial Guinea" name="checkbox_paesi[]" type="checkbox">Guinea Equatoriale</input><br>
                                        <input value="Eritrea" name="checkbox_paesi[]" type="checkbox">Eritrea</input><br>
                                        <input value="Estonia" name="checkbox_paesi[]" type="checkbox">Estonia</input><br>
                                        <input value="Ethiopia" name="checkbox_paesi[]" type="checkbox">Etiopia</input><br>
                                        <input value="Falkland Islands (Malvinas)" name="checkbox_paesi[]" type="checkbox">Isole Falkland (Malvinas)</input><br>
                                        <input value="Faroe Islands" name="checkbox_paesi[]" type="checkbox">Isole Faroe</input><br>
                                        <input value="Fiji" name="checkbox_paesi[]" type="checkbox">Fiji</input><br>
                                        <input value="Finland" name="checkbox_paesi[]" type="checkbox">Finlandia</input><br>
                                        <input value="France" name="checkbox_paesi[]" type="checkbox">Francia</input><br>
                                        <input value="French Guiana" name="checkbox_paesi[]" type="checkbox">Guiana francese</input><br>
                                        <input value="French Polynesia" name="checkbox_paesi[]" type="checkbox">Polinesia francese</input><br>
                                        <input value="Gabon" name="checkbox_paesi[]" type="checkbox">Gabon</input><br>
                                        <input value="Gambia" name="checkbox_paesi[]" type="checkbox">Gambia</input><br>
                                        <input value="Georgia" name="checkbox_paesi[]" type="checkbox">Georgia</input><br>
                                        <input value="Germany" name="checkbox_paesi[]" type="checkbox">Germania</input><br>
                                        <input value="Ghana" name="checkbox_paesi[]" type="checkbox">Ghana</input><br>
                                        <input value="Greece" name="checkbox_paesi[]" type="checkbox">Grecia</input><br>
                                        <input value="Greenland" name="checkbox_paesi[]" type="checkbox">Groenlandia</input><br>
                                        <input value="Guernsey" name="checkbox_paesi[]" type="checkbox">Guernsey</input><br>
                                        <input value="Guinea" name="checkbox_paesi[]" type="checkbox">Guinea</input><br>
                                        <input value="Guyana" name="checkbox_paesi[]" type="checkbox">Guyana</input><br>
                                        <input value="Haiti" name="checkbox_paesi[]" type="checkbox">Haiti</input><br>
                                        <input value="Vatican State" name="checkbox_paesi[]" type="checkbox">Stato del Vaticano</input><br>
                                        <input value="Honduras" name="checkbox_paesi[]" type="checkbox">Honduras</input><br>
                                        <input value="Hong Kong" name="checkbox_paesi[]" type="checkbox">Hong Kong</input><br>
                                        <input value="Hungary" name="checkbox_paesi[]" type="checkbox">Ungheria</input><br>
                                        <input value="Iceland" name="checkbox_paesi[]" type="checkbox">Islanda</input><br>
                                        <input value="India" name="checkbox_paesi[]" type="checkbox">India</input><br>
                                        <input value="Indonesia" name="checkbox_paesi[]" type="checkbox">Indonesia</input><br>
                                        <input value="Iran, Islamic Republic of" name="checkbox_paesi[]" type="checkbox">Iran</input><br>
                                        <input value="Iraq" name="checkbox_paesi[]" type="checkbox">Iraq</input><br>
                                        <input value="Ireland" name="checkbox_paesi[]" type="checkbox">Irlanda</input><br>
                                        <input value="Israel" name="checkbox_paesi[]" type="checkbox">Israele</input><br>
                                        <input value="Italy" name="checkbox_paesi[]" type="checkbox">Italia</input><br>
                                        <input value="Jamaica" name="checkbox_paesi[]" type="checkbox">Giamaica</input><br>
                                        <input value="Japan" name="checkbox_paesi[]" type="checkbox">Giappone</input><br>
                                        <input value="Jersey" name="checkbox_paesi[]" type="checkbox">Jersey</input><br>
                                        <input value="Jordan" name="checkbox_paesi[]" type="checkbox">Giordania</input><br>
                                        <input value="Kazakhstan" name="checkbox_paesi[]" type="checkbox">Kazakistan</input><br>
                                        <input value="Kenya" name="checkbox_paesi[]" type="checkbox">Kenya</input><br>
                                        <input value="Kiribati" name="checkbox_paesi[]" type="checkbox">Kiribati</input><br>
                                        <input value="Korea, Democratic People s Republic of" name="checkbox_paesi[]" type="checkbox">Corea Sud</input><br>
                                        <input value="Korea, Republic of" name="checkbox_paesi[]" type="checkbox">Corea Nord</input><br>
                                        <input value="Kosovo" name="checkbox_paesi[]" type="checkbox">Kosovo</input><br>
                                        <input value="Kuwait" name="checkbox_paesi[]" type="checkbox">Kuwait</input><br>
                                        <input value="Kyrgyzstan" name="checkbox_paesi[]" type="checkbox">Kirghizistan</input><br>
                                        <input value="Lao People s Democratic Republic" name="checkbox_paesi[]" type="checkbox">Laos</input><br>
                                        <input value="Latvia" name="checkbox_paesi[]" type="checkbox">Lettonia</input><br>
                                        <input value="Lebanon" name="checkbox_paesi[]" type="checkbox">Libano</input><br>
                                        <input value="Lesotho" name="checkbox_paesi[]" type="checkbox">Lesotho</input><br>
                                        <input value="Liberia" name="checkbox_paesi[]" type="checkbox">Liberia</input><br>
                                        <input value="Liechtenstein" name="checkbox_paesi[]" type="checkbox">Liechtenstein</input><br>
                                        <input value="Lithuania" name="checkbox_paesi[]" type="checkbox">Lituania</input><br>
                                        <input value="Luxembourg" name="checkbox_paesi[]" type="checkbox">Lussemburgo</input><br>
                                        <input value="Macedonia, the Former Yugoslav Republic of" name="checkbox_paesi[]" type="checkbox">Macedonia</input><br>
                                        <input value="Madagascar" name="checkbox_paesi[]" type="checkbox">Madagascar</input><br>
                                        <input value="Malawi" name="checkbox_paesi[]" type="checkbox">Malawi</input><br>
                                        <input value="Malaysia" name="checkbox_paesi[]" type="checkbox">Malaysia</input><br>
                                        <input value="Maldives" name="checkbox_paesi[]" type="checkbox">Maldive</input><br>
                                        <input value="Mali" name="checkbox_paesi[]" type="checkbox">Mali</input><br>
                                        <input value="Malta" name="checkbox_paesi[]" type="checkbox">Malta</input><br>
                                        <input value="Mauritania" name="checkbox_paesi[]" type="checkbox">Mauritania</input><br>
                                        <input value="Mauritius" name="checkbox_paesi[]" type="checkbox">Mauritius</input><br>
                                        <input value="Mexico" name="checkbox_paesi[]" type="checkbox">Messico</input><br>
                                        <input value="Monaco" name="checkbox_paesi[]" type="checkbox">Monaco</input><br>
                                        <input value="Mongolia" name="checkbox_paesi[]" type="checkbox">Mongolia</input><br>
                                        <input value="Montenegro" name="checkbox_paesi[]" type="checkbox">Montenegro</input><br>
                                        <input value="Morocco" name="checkbox_paesi[]" type="checkbox">Marocco</input><br>
                                        <input value="Mozambique" name="checkbox_paesi[]" type="checkbox">Mozambico</input><br>
                                        <input value="Myanmar" name="checkbox_paesi[]" type="checkbox">Myanmar</input><br>
                                        <input value="Namibia" name="checkbox_paesi[]" type="checkbox">Namibia</input><br>
                                        <input value="Nepal" name="checkbox_paesi[]" type="checkbox">Nepal</input><br>
                                        <input value="Netherlands" name="checkbox_paesi[]" type="checkbox">Olanda</input><br>
                                        <input value="New Zealand" name="checkbox_paesi[]" type="checkbox">Nuova Zelanda</input><br>
                                        <input value="Nigeria" name="checkbox_paesi[]" type="checkbox">Nigeria</input><br>
                                        <input value="Norway" name="checkbox_paesi[]" type="checkbox">Norvegia</input><br>
                                        <input value="Oman" name="checkbox_paesi[]" type="checkbox">Oman</input><br>
                                        <input value="Pakistan" name="checkbox_paesi[]" type="checkbox">Pakistan</input><br>
                                        <input value="Panama" name="checkbox_paesi[]" type="checkbox">Panama</input><br>
                                        <input value="Paraguay" name="checkbox_paesi[]" type="checkbox">Paraguay</input><br>
                                        <input value="Peru" name="checkbox_paesi[]" type="checkbox">Perù</input><br>
                                        <input value="Philippines" name="checkbox_paesi[]" type="checkbox">Filippine</input><br>
                                        <input value="Poland" name="checkbox_paesi[]" type="checkbox">Polonia</input><br>
                                        <input value="Portugal" name="checkbox_paesi[]" type="checkbox">Portogallo</input><br>
                                        <input value="Puerto Rico" name="checkbox_paesi[]" type="checkbox">Porto Rico</input><br>
                                        <input value="Qatar" name="checkbox_paesi[]" type="checkbox">Qatar</input><br>
                                        <input value="Romania" name="checkbox_paesi[]" type="checkbox">Romania</input><br>
                                        <input value="Russian Federation" name="checkbox_paesi[]" type="checkbox">Russia</input><br>
                                        <input value="Rwanda" name="checkbox_paesi[]" type="checkbox">Ruanda</input><br>
                                        <input value="Samoa" name="checkbox_paesi[]" type="checkbox">Samoa</input><br>
                                        <input value="San Marino" name="checkbox_paesi[]" type="checkbox">San Marino</input><br>
                                        <input value="Saudi Arabia" name="checkbox_paesi[]" type="checkbox">Arabia Saudita</input><br>
                                        <input value="Senegal" name="checkbox_paesi[]" type="checkbox">Senegal</input><br>
                                        <input value="Serbia" name="checkbox_paesi[]" type="checkbox">Serbia</input><br>
                                        <input value="Seychelles" name="checkbox_paesi[]" type="checkbox">Seychelles</input><br>
                                        <input value="Sierra Leone" name="checkbox_paesi[]" type="checkbox">Sierra Leone</input><br>
                                        <input value="Singapore" name="checkbox_paesi[]" type="checkbox">Singapore</input><br>
                                        <input value="Slovakia" name="checkbox_paesi[]" type="checkbox">Slovacchia</input><br>
                                        <input value="Slovenia" name="checkbox_paesi[]" type="checkbox">Slovenia</input><br>
                                        <input value="Somalia" name="checkbox_paesi[]" type="checkbox">Somalia</input><br>
                                        <input value="South Africa" name="checkbox_paesi[]" type="checkbox">Sud Africa</input><br>
                                        <input value="South Sudan" name="checkbox_paesi[]" type="checkbox">Sudan del Sud</input><br>
                                        <input value="Spain" name="checkbox_paesi[]" type="checkbox">Spagna</input><br>
                                        <input value="Sri Lanka" name="checkbox_paesi[]" type="checkbox">Sri Lanka</input><br>
                                        <input value="Sudan" name="checkbox_paesi[]" type="checkbox">Sudan</input><br>
                                        <input value="Suriname" name="checkbox_paesi[]" type="checkbox">Suriname</input><br>
                                        <input value="Sweden" name="checkbox_paesi[]" type="checkbox">Svezia</input><br>
                                        <input value="Switzerland" name="checkbox_paesi[]" type="checkbox">Svizzera</input><br>
                                        <input value="Syrian Arab Republic" name="checkbox_paesi[]" type="checkbox">Siria</input><br>
                                        <input value="Tajikistan" name="checkbox_paesi[]" type="checkbox">Tagikistan</input><br>
                                        <input value="Tanzania, United Republic of" name="checkbox_paesi[]" type="checkbox">Tanzania</input><br>
                                        <input value="Thailand" name="checkbox_paesi[]" type="checkbox">Tailandia</input><br>
                                        <input value="Tunisia" name="checkbox_paesi[]" type="checkbox">Tunisia</input><br>
                                        <input value="Turkey" name="checkbox_paesi[]" type="checkbox">Turchia</input><br>
                                        <input value="Turkmenistan" name="checkbox_paesi[]" type="checkbox">Turkmenistan</input><br>
                                        <input value="Turks and Caicos Islands" name="checkbox_paesi[]" type="checkbox">Isole Turks e Caicos</input><br>
                                        <input value="Tuvalu" name="checkbox_paesi[]" type="checkbox">Tuvalu</input><br>
                                        <input value="Uganda" name="checkbox_paesi[]" type="checkbox">Uganda</input><br>
                                        <input value="Ukraine" name="checkbox_paesi[]" type="checkbox">Ucraina</input><br>
                                        <input value="United Arab Emirates" name="checkbox_paesi[]" type="checkbox">Emirati Arabi Uniti</input><br>
                                        <input value="United Kingdom" name="checkbox_paesi[]" type="checkbox">Regno Unito</input><br>
                                        <input value="United States" name="checkbox_paesi[]" type="checkbox">stati Uniti</input><br>
                                        <input value="Uruguay" name="checkbox_paesi[]" type="checkbox">Uruguay</input><br>
                                        <input value="Uzbekistan" name="checkbox_paesi[]" type="checkbox">Uzbekistan</input><br>
                                        <input value="Vanuatu" name="checkbox_paesi[]" type="checkbox">Vanuatu</input><br>
                                        <input value="Venezuela" name="checkbox_paesi[]" type="checkbox">Venezuela</input><br>
                                        <input value="Viet Nam" name="checkbox_paesi[]" type="checkbox">Viet Nam</input><br>
                                        <input value="Yemen" name="checkbox_paesi[]" type="checkbox">Yemen</input><br>
                                        <input value="Zambia" name="checkbox_paesi[]" type="checkbox">Zambia</input><br>
                                        <input value="Zimbabwe" name="checkbox_paesi[]" type="checkbox">Zimbabwe</input><br>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="lingue_parlate_div">Lingue parlate:</label>
                                    <div id="lingue_parlate_div" class="checkbox_scroll"> 
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="italiano" type="checkbox">Italiano</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="inglese" type="checkbox">Inglese</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="francese" type="checkbox">Francese</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="tedesco" type="checkbox">Tedesco</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="spagnolo" type="checkbox">Spagnolo</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="portoghese" type="checkbox">Portoghese</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="russo" type="checkbox">Russo</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="arabo" type="checkbox">Arabo</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="cinese" type="checkbox">Cinese</input><br>
                                        <input  name="Lingue_parlate_checkbox_scroll[]" value="giapponese" type="checkbox">Giapponese</input><br> 
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="attivita_preferite_div">Attività preferite in viaggio:</label>
                                    <div id="attivita_preferite_div" class=checkbox_scroll >
                                        <input  name="Gusto_attivita[]" value="Arrampicata" type="checkbox">Arrampicata</input><br>
                                        <input  name="Gusto_attivita[]" value="Bicicletta" type="checkbox">Bicicletta</input><br>
                                        <input  name="Gusto_attivita[]" value="Canoa" type="checkbox">Canoa</input><br>
                                        <input  name="Gusto_attivita[]" value="Giri turistici" type="checkbox">Giri turistici</input><br>
                                        <input  name="Gusto_attivita[]" value="Gite in barca" type="checkbox">Gite in barca</input><br>
                                        <input  name="Gusto_attivita[]" value="Gite in mongolfiera" type="checkbox">Gite in mongolfiera</input><br>
                                        <input  name="Gusto_attivita[]" value="Gite in treno" type="checkbox">Gite in treno</input><br>
                                        <input  name="Gusto_attivita[]" value="Gite in traghetto" type="checkbox">Gite in traghetto</input><br>
                                        <input  name="Gusto_attivita[]" value="sport acquatici" type="checkbox">Sport acquatici</input><br>
                                        <input  name="Gusto_attivita[]"  value="Trekking" type="checkbox">Trekking</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a musei" type="checkbox">Visite a musei</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a parchi" type="checkbox">Visite a parchi</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a siti archeologici" type="checkbox">Visite a siti archeologici</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a siti religiosi" type="checkbox">Visite a siti religiosi</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a siti storici" type="checkbox">Visite a siti storici</input><br>
                                        <input name="Gusto_attivita[]"  value="Visite a siti UNESCO" type="checkbox">Visite a siti UNESCO</input><br>
                                        <input name="Gusto_attivita[]" value="Visite a siti naturali" type="checkbox">Visite a siti naturali</input><br>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="mezzi_preferiti_div">Mezzi di trasporto più usati:</label>
                                    <div id="mezzi_preferiti_div" class=checkbox_scroll  >
                                        <input  name="Gusto_mezzi_trasporto[]" value="Treno" type="checkbox">Treno</input><br>
                                        <input  name="Gusto_mezzi_trasporto[]" value="Aereo" type="checkbox">Aereo</input><br>
                                        <input  name="Gusto_mezzi_trasporto[]" value="Mezzi pubblici" type="checkbox">Mezzi pubblici</input><br>
                                        <input  name="Gusto_mezzi_trasporto[]" value="A piedi" type="checkbox">A piedi</input><br>
                                        <input  name="Gusto_mezzi_trasporto[]" value="Bicicletta" type="checkbox">Bicicletta</input><br>
                                        <input  name="Gusto_mezzi_trasporto[]" value="Auto" type="checkbox">Auto</input><br>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <label for="select-stile-viaggio">Stile di viaggio ideale:</label><!--la label volante da porblemi-->
                                    <select name="stile_viaggio_input" class="form-select"  id="select-stile-viaggio" >
                                        <option value="" selected>Apri menù</option>
                                        <option value="Avventuroso">Avventuroso</option>
                                        <option value="Campeggio">Campeggio</option>
                                        <option value="Città d arte">Città d'arte</option>
                                        <option value="Comfort">Comfort</option>
                                        <option value="Lussuoso">Lussuoso</option>
                                        <option value="Natura">Natura</option>
                                        <option value="Parchi a tema">Parchi a tema</option>
                                        <option value="Per famiglie">Per famiglie</option>
                                        <option value="Road trip">Road trip</option>
                                        <option value="Viaggio gastronomico">Viaggio gastronomico</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <label for="select-budget">Budget medio per viaggio:</label>
                                    <select name="budget_viaggio_input" class="form-select" id="select-budget" >
                                        <option value="" selected>Apri menù</option>
                                        <option value="Molto basso">Molto basso</option>
                                        <option value="Basso">Basso</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Alto">Alto</option>
                                        <option value="Molto alto">Molto alto</option>
                                    </select>
                                </div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                            </div>
                            <br>
                            <h4>Vita privata</h4>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <label for="sel_lavoro">Lavoro</label>
                                    <select id="sel_lavoro" name="professione_input" class="form-select"  >
                                        <option value="" selected>Apri menù</option>
                                        <option value="Agricoltore">Agricoltore</option>
                                        <option value="Artigiano">Artigiano</option>
                                        <option value="Commerciante">Commerciante</option>
                                        <option value="Impiegato">Impiegato</option>
                                        <option value="Imprenditore">Imprenditore</option>
                                        <option value="Libero professionista">Libero professionista</option>
                                        <option value="Operaio">Operaio</option>
                                        <option value="Pensionato">Pensionato</option>
                                        <option value="Studente">Studente</option>
                                        <option value="Altro">Altro</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <label for="sel_studi">Studi: </label>
                                    <select id="sel_studi" name="studi_input" class="form-select" >
                                        <option value="" selected>Apri menù</option>
                                        <option value="Licenza elementare">Licenza elementare</option>
                                        <option value="Licenza media">Licenza media</option>
                                        <option value="Diploma di scuola superiore">Diploma di scuola superiore</option>
                                        <option value="Laurea triennale">Laurea triennale</option>
                                        <option value="Laurea specialistica">Laurea specialistica</option>
                                        <option value="Laurea magistrale">Laurea magistrale</option>
                                        <option value="Dottorato di ricerca">Dottorato di ricerca</option>
                                        <option value="Altro">Altro</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <script>
                                        $(document).ready(function(){
                                            $('input[name="stato_civile_input"]').click(function(){
                                                if($(this).prop("checked") == true){
                                                    $('input[name="stato_civile_input"]').prop('checked', false);
                                                    $(this).prop('checked', true);
                                                }
                                                else if($(this).prop("checked") == false){
                                                    $('input[name="stato_civile_input"]').prop('checked', false);
                                                }
                                            });
                                        });
                                    </script>
                                   
                                    <label for="sel_stato_civile" class=" align-middle">Stato civile: </label><br>
                                    <div id="sel_stato_civile" class="form-check-inline">
                                        <input name="stato_civile_input" value="Single" type="checkbox" class="form-check-input">Single &nbsp;
                                        <input name="stato_civile_input" value="Sposato/a" type="checkbox" class="form-check-input">Sposato/a &nbsp;                                     
                                        <input name="stato_civile_input" value="Divorziato/a" type="checkbox" class="form-check-input">Divorziato/a &nbsp;                                   
                                        <input name="stato_civile_input" value="Separato/a" type="checkbox" class="form-check-input">Separato/a &nbsp;                                       
                                        <input name="stato_civile_input" value="Vedovo/a" type="checkbox" class="form-check-input">Vedovo/a                                       
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4>Gusti</h4>
                            <div class="row">
                                <div class="col">
                                    <label for="gm_div">Genere musicale preferito:</label>
                                    <div class="checkbox_scroll"> 
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Classica" type="checkbox">Classica</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Jazz" type="checkbox">Jazz</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Pop" type="checkbox">Pop</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Rock" type="checkbox">Rock</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Metal" type="checkbox">Metal</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Rap" type="checkbox">Rap</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Reggae" type="checkbox">Reggae</input><br>
                                        <input  name="Gusto_Musicale_checkbox_scroll[]" value="Altro" type="checkbox">Altro</input><br>
                                    </div>
                                </div>
                                <div class="col">   
                                    <label for="gc_div">Tipologia di film preferita:</label>  
                                    <div class="checkbox_scroll" name="Gusto_Cinematografico_checkbox_scroll[]" > 
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Azione" type="checkbox">Azione</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Avventura" type="checkbox">Avventura</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Commedia" type="checkbox">Commedia</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Drammatico" type="checkbox">Drammatico</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Fantascienza" type="checkbox">Fantascienza</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Fantasy" type="checkbox">Fantasy</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Horror" type="checkbox">Horror</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Thriller" type="checkbox">Thriller</input><br>
                                        <input  name="Gusto_Cinematografico_checkbox_scroll[]" value="Altro" type="checkbox">Altro</input><br>
                                    </div>
                                </div>
                                <div class="col"> 
                                    <label for="gs_div">Sport seguiti:</label>                                           
                                    <div class="checkbox_scroll" name="Gusto_Sportivo_checkbox_scroll[]"> 
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Atletica" type="checkbox">Atletica</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Calcio" type="checkbox">Calcio</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Ciclismo" type="checkbox">Ciclismo</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Equitazione" type="checkbox">Equitazione</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Fitness" type="checkbox">Fitness</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Ginnastica" type="checkbox">Ginnastica</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Motociclismo" type="checkbox">Motociclismo</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Mma" type="checkbox">Mma</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Nuoto" type="checkbox">Nuoto</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Pallacanestro" type="checkbox">Pallacanestro</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Pallamano" type="checkbox">Pallamano</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Pallavolo" type="checkbox">Pallavolo</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Pugilato" type="checkbox">Pugilato</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Sci" type="checkbox">Sci</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Snowboard" type="checkbox">Snowboard</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Tennis" type="checkbox">Tennis</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Vela" type="checkbox">Vela</input><br>
                                        <input name="Gusto_Sportivo_checkbox_scroll[]" value="Altro" type="checkbox">Altro</input><br>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            <br>
                            <h4>Altro</h4>
                            <div class="row">
                                <div class="col">
                                    <label for="rs_div">Restrizioni alimentari:</label>         
                                    <div class="checkbox_scroll"> <!--ELENCO DI TUTTI I PAESI CON CHECKBOX-->
                                        <input value="Allergico" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Allergico</input><br>
                                        <input value="Celiaco" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Celiaco</input><br>
                                        <input value="Diabetico" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Diabetico</input><br>
                                        <input value="Intollerante ai crostacei" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante ai crostacei</input><br>
                                        <input value="Intollerante alle arachidi" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante alle arachidi</input><br>
                                        <input value="Intollerante al fruttosio" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante al fruttosio</input><br>
                                        <input value="Intollerante al glutine" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante al glutine</input><br>
                                        <input value="Intollerante al lattosio" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante al lattosio</input><br>
                                        <input value="Intollerante alle noci" type="checkbox" name="Restrizioni_alimentari_checkbox_scroll[]">Intollerante
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="tp_div">Patenti:</label>
                                    <div class="checkbox_scroll"> 
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="A" type="checkbox">A</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="AM" type="checkbox">AM</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="A1" type="checkbox">A1</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="A2" type="checkbox">A2</input><br>                                        
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="B" type="checkbox">B</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="BE" type="checkbox">BE</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="B1" type="checkbox">B1</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="C" type="checkbox">C</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="CE" type="checkbox">CE</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="C1" type="checkbox">C1</input><br>                                       
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="C1E" type="checkbox">C1E</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="D" type="checkbox">D</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="DE" type="checkbox">DE</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="D1" type="checkbox">D1</input><br>
                                        <input  name="Patente_Guida_checkbox_scroll[]" value="D1E" type="checkbox">D1E</input><br>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                            <br>   
                            <button type="submit" id=bottone_invio_interessi class="btn btn-outline-success">Invia</button>
                        </form>
                    </div>
                </div>
                <style>
                    #last_row {
                        display: flex;
                        flex-direction: row;
                        padding: 10px;
                    }

                   

                    #colonna_recensioni {
                    width: 100%;
                    /*background-color: white;*/
                    overflow-y: scroll;
                    max-height: 600px; /* impostare la dimensione massima della colonna */
                    }

                    #rettangolo_recensioni {
                    margin-bottom: 20px;
                    }
                    #voto-recensione-input{
                        WIDTH: 50%;
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
                <h2 style="color:#459f68;text-align:left;margin-left:8px;" >Recensioni</h2><hr><!-- linea divisoria-->
                <div id="last_row">
                    <style>
                        #colonna_recensioni{
                            padding: 10px;
                        }
                    </style>
                    <div id="colonna_recensioni">
                            <?php
                                $EMAIL = $_SESSION['email'];//ottenuta con get
                                $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                                $sql = "SELECT * FROM recensioni WHERE email_utente_recensito = '$EMAIL'";
                                $res = pg_query($dbconn, $sql);
                                if($res){
                                    //scandisci le tuple che trovi
                                    while( $tupla = pg_fetch_assoc($res) ){ 
                                        echo "<h6 style='text-align:left;'>Recensore: <a href='../Other_User/Altro_Utente.php?email=".$tupla["email_utente_recensore"]."'>".$tupla["username_recensore"]."</a></h6>";
                                        $string = "";
                                        for ($i = 0; $i < $tupla["voto"]; $i++) {
                                            $string .= "<i class='fas fa-star' style='color:#c7c53e;'></i>";
                                        }
                                        echo "<h6 style='text-align:left;'>".$tupla["titolo"]." ".$string."</h6>";
                                        echo "<textarea class='form-control' id='testo-recensione-input' name='testo_recensione_input' rows='2' disabled>".$tupla["descrizione_recensione"]."</textarea>";
                                        echo"<hr>";
                                    }
                                    //se non ci sono recensioni
                                    if(pg_num_rows($res) == 0){
                                        echo "<h4 style='text-align:left;'>Non sono ancora presenti recensioni sul tuo profilo!</h4>";
                                    }
                                }
                                else{
                                    echo "errore query";
                                }
                            ?>
                    </div>
                </div>
            </div>
            <div id="third_col"></div>
        </div>
            
        </div> 
    </div>  
    
    <script> //scrivi una funzione js che modifica la progress bar a seconda di quante interessi ho iserito
        
        var campoMassimo = 15; // Numero massimo di campi nel form
        var campiInseriti = numInteressi; // Numero di campi inseriti messo uguale alla variabile contatore dichiarata in php e passata prima con gli echo
    // Funzione per aggiornare la barra di avanzamento
        function updateProgressBar(campiInseriti, campoMassimo) {
        // Calcola la percentuale completata
        var percentualeCompletata = (campiInseriti / campoMassimo)  * 100;
        
        // Aggiorna la larghezza della barra e il testo
        var progressBar = document.getElementById("progressBar2");
        progressBar.style.width = percentualeCompletata + "%";
        progressBar.innerHTML = percentualeCompletata.toFixed() + "%";

        
        
        // Aggiorna l'attributo aria-valuenow per l'accessibilità
        var progressBarParent = document.getElementById("progressBar");
        progressBarParent.setAttribute("aria-valuenow", percentualeCompletata);
        }

        // Aggiorna la barra di avanzamento quando aggiungo gli interessi
        updateProgressBar(campiInseriti, campoMassimo);

        //azzera la barra quando cancello gli interessi
        
    </script>
 
</body>
</html>