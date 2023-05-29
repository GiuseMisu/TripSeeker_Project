<?php   //se url contiene error=password-sbagliata compare alert con errore
if (isset($_GET["error"]) && $_GET["error"] == "password-sbagliata") {
    echo '<script>alert("Password errata")</script>';
}



?>


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
    <link rel="stylesheet" href="./Lista_Viaggi.css">
    <title>Viaggi</title>
    
    <script>    //controlli vari su partecipazione al viaggio o eliminazione partecipazione
        if (window.location.href.indexOf("error=utente-gia-partecipante") > -1) {
            alert("Utente già partecipante a questo viaggio");
            window.location.href = "index.php";

        }
        if (window.location.href.indexOf("success=partecipazione-registrata") > -1) {
            alert("Partecipazione al viaggio registrata con successo");
            window.location.href = "index.php";
        }
        if(window.location.href.indexOf("success=partecipazione-eliminata") > -1){
            alert("Viaggio abbandonato con successo");
            window.location.href = "index.php";
        }
        if(window.location.href.indexOf("error=utente-non-partecipante") > -1){
            alert("Utente non partecipante a questo viaggio");
            window.location.href = "index.php";
        }
        if(window.location.href.indexOf("error=viaggio-pieno") > -1){
            alert("Numero massimo di partecipanti raggiunto, impossibile partecipare");
            window.location.href = "index.php";
        }
   </script>
   <script> //funzione per mostrare la descrizione del post. Ogni volta che clicco aumento un contatore di pressioni
            //sul post(attributo di tabella viaggi database) così da poter ordinare in base alla tendenza (numero di pressioni)

        function mostraDescrizione(a) {//a è id_viaggio
            //parte per aggiornare il contatore di pressioni sul post
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "trending_trip.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // visualizza la risposta nella console del browser come debug per vedere se funziona
                }
            };
            xhr.send("id_viaggio=" + encodeURIComponent(a));

            //parte per mostrare la descrizione e altre parti del post
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
    <style>
        .fa-angle-double-down {
            position: relative;
            animation-name: moveUpDown_giu;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }
        
        .fa-angle-double-up {
            position: relative;
            animation-name: moveUpDown_su;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }
        /*animazione frecce direzionali*/
        @keyframes moveUpDown_giu {
            from {
            top: 0px;
            }
            to {
            top: 10px;
            }
        }
        
        @keyframes moveUpDown_su {
            from {
            top: 5px;
            }
            to {
            top: 15px;
            }
        }
    </style>
</head>
<style>
     body{
        background-image: url('../img/yannick-apollon-2MjQoZxNOxo-unsplash.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        /* rendi piu trasparente lo sfondo */
        background-color: rgba(255, 255, 255, 0.5);
    }
</style>

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
                        <a class="nav-link"href="index.php">Viaggi</a>                     
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
            .verdi{
                background-color: #51be7b!important;
                border-color: #51be7b!important;
            }
        </style>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group d-flex flex-wrap justify-content-center" role="group" aria-label="Button group" style="margin-bottom: 20px;">
                        <!--bottone che se premi refresha la pagina e quindi resetta i filtri-->
                        <?php
                        // Abbiamo diviso i casi in base alla pagina dalla quale proviene l'utente, questo perchè se proviene dalla home page attraverso la search bar
                        //dobbiamo fare una query dinamica, altrimenti mostriamo i viaggi senza alcun filtraggio

                        if(isset($_POST["from_home"])){            //PARTE FROM SEARCH BAR XL
                                //dobbiamo controllare quali campi ha selezionato l'utente e in base a questi facciamo una query dinamica perchè cambiano i nomi dei campi
                                if(isset($_POST['XL']) && $_POST['XL'] == 'XL'){
                                    $conditions = array();
                                    foreach ($_POST as $key => $value) {
                                        if (!empty($value)) {
                                            switch ($key) {
                                                case 'destinazione':
                                                    $conditions[] = "Destinazione  ILIKE '%{$value}%'";//per rendere query case insensitive
                                                    break;
                                                case 'data-partenza':
                                                    if(isset($_POST['date_precise']) ) {
                                                        $conditions[] = "Data_Partenza = '{$value}'";
                                                    } else {
                                                        //echo "<h1 style='color:white'>{$_POST['data-partenza']}</h1>";
                                                        $data_partenza = $_POST['data-partenza'];
                                                        $n_giorni_da_sottrarre = 5;
                                                        $data_partenza_meno_5_giorni = date('Y-m-d', strtotime("-$n_giorni_da_sottrarre days", strtotime($data_partenza)));
                                                        //echo "<h1 style='color:white'>".$data_partenza_meno_5_giorni."</h1>";
                                                        $data_partenza_piu_5_giorni = date('Y-m-d', strtotime("+$n_giorni_da_sottrarre days", strtotime($data_partenza)));
                                                        //echo "<h1 style='color:white'>'".$data_partenza_piu_5_giorni."'</h1>";
                                                        $conditions[] = "(Data_Partenza >= '".$data_partenza_meno_5_giorni."'::date AND Data_Partenza <= '".$data_partenza_piu_5_giorni."'::date)";
                                                    }
                                                    break;
                                                case 'data-ritorno':
                                                    $conditions[] = "Data_Ritorno = '{$value}'";
                                                    break;
                                                case 'n-viaggiatori':
                                                    if ($value == '10+') {
                                                        $conditions[] = "Num_Max_Partecipanti > 10";
                                                    } 
                                                    else {
                                                        $conditions[] = "Num_Max_Partecipanti = '{$value}'";
                                                    }
                                                    break;
                                            }
                                        }
                                    }
                                }
                                else{       //PARTE FROM SEARCH BAR XS
                                    $conditions = array();
                                    foreach ($_POST as $key => $value) {
                                        if (!empty($value)) {
                                            switch ($key) {
                                                case 'destinazione_xs':
                                                    $conditions[] = "Destinazione  ILIKE '%{$value}%'";//per rendere query case insensitive
                                                    break;
                                                case 'data_partenza_xs':
                                                    if(isset($_POST['date_precise_xs']) ) {
                                                        $conditions[] = "Data_Partenza = '{$value}'";
                                                    } else {
                                                        $data_partenze = $_POST['data_partenza_xs'];
                                                        $n_giorni_da_sottrarre = 5;
                                                        $data_partenza_meno_5_giorni = date('Y-m-d', strtotime("-$n_giorni_da_sottrarre days", strtotime($data_partenze)));
                                                        //echo "<h1 style='color:white'>".$data_partenza_meno_5_giorni."</h1>";
                                                        $data_partenza_piu_5_giorni = date('Y-m-d', strtotime("+$n_giorni_da_sottrarre days", strtotime($data_partenze)));
                                                        //echo "<h1 style='color:white'>'".$data_partenza_piu_5_giorni."'</h1>";
                                                        $conditions[] = "(Data_Partenza >= '".$data_partenza_meno_5_giorni."'::date AND Data_Partenza <= '".$data_partenza_piu_5_giorni."'::date)";
                                                    }
                                                    break;
                                                case 'data_ritorno_xs':
                                                    $conditions[] = "Data_Ritorno = '{$value}'";
                                                    break;
                                                case 'n_viaggiatori_xs':
                                                    if ($value == '10+') {
                                                        $conditions[] = "Num_Max_Partecipanti > 10";
                                                    } 
                                                    else {
                                                        $conditions[] = "Num_Max_Partecipanti = '{$value}'";
                                                    }
                                                    break;
                                            }
                                        }
                                    }
                                }
                                echo'<br>';
                                if (!empty($conditions)) {
                                    $query = "SELECT * FROM Viaggio WHERE " . implode(" AND ", $conditions) . "";// query dinamica, attraverso implode concateniamo i vari elementi dall'array condition tramite una and
                                }
                                else{ //se conditions vuoto allora non ha selezionato nessun campo quindi mostro tutti i viaggi
                                    $query = "SELECT * FROM Viaggio";
                                }  
//IMP: abbiamo inserito tre diverse tipologie di bottoni: se provengo dalla pagina con la search bar (home page), se non provengo dalla home page(qundi ho cliccato su viaggi dalla nav bar),
//infine se provengo dalla home page ma ho cliccato un bottone di ordinamento su /lista_viaggi/index.
// questa distinzione è stata fatta per evitare di perdere la query dei i campi inseriti dalla search bar , a cui in caso gli va aggiunto l'ordinamento
                            echo '
                            <button class="verdi btn btn-primary mx-1 my-1" onclick="window.location.href=\'index.php\'" style="border-radius:7px;"><i class="fas fa-sync-alt black-text"></i></button>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="destinazione ASC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione ASC" value="destinazione ASC">Destinazione&nbsp;<i class="fas fa-sort-alpha-down" style="vertical-align: middle;"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="destinazione DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione DESC" value="destinazione DESC">Destinazione&nbsp;<i class="fas fa-sort-alpha-up" ></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="data_partenza">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_partenza" value="data_partenza">Data partenza&nbsp;<i class="fas fa-plane-departure"></i></button>
                        </form>
                        <form method="POST">
                        <input type="hidden" name="from_home_&_button" value="'.$query.'">
                        <input type="hidden" name="ordinamento" value="data_ritorno">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_ritorno" value="data_ritorno">Data ritorno&nbsp;<i class="fas fa-plane-arrival"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="budget ASC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget ASC" value="budget ASC">Prezzo&nbsp;<i class="fas fa-sort-amount-up"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="budget DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget DESC" value="budget DESC">Prezzo&nbsp;<i class="fas fa-sort-amount-down"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="posti_disponibili ASC">
                            <button type="submit" class="verdi  btn btn-primary mx-1 my-1" name="posti_disponibili ASC" value="posti_disponibili ASC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-up"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="posti_disponibili DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="posti_disponibili DESC" value="posti_disponibili DESC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-down"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$query.'">
                            <input type="hidden" name="ordinamento" value="trending_index DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="trending_index" value="trending_index DESC">Tendenza&nbsp;<i class="fas fa-chart-line"></i></button>
                        </form>';
                        }
                        else if( isset($_POST["from_home_&_button"])){
                            $sql = $_POST["from_home_&_button"];
                            echo '
                            <button class="verdi btn btn-primary mx-1 my-1" onclick="window.location.href=\'index.php\'" style="border-radius:7px;"><i class="fas fa-sync-alt black-text"></i></button>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="destinazione ASC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione ASC" value="destinazione ASC">Destinazione&nbsp;<i class="fas fa-sort-alpha-down" style="vertical-align: middle;"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="destinazione DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="destinazione DESC" value="destinazione DESC">Destinazione&nbsp;<i class="fas fa-sort-alpha-up" ></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="data_partenza">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_partenza" value="data_partenza">Data partenza&nbsp;<i class="fas fa-plane-departure"></i></button>
                        </form>
                        <form method="POST">
                        <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                        <input type="hidden" name="ordinamento" value="data_ritorno">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="data_ritorno" value="data_ritorno">Data ritorno&nbsp;<i class="fas fa-plane-arrival"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="budget ASC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget ASC" value="budget ASC">Prezzo&nbsp;<i class="fas fa-sort-amount-up"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="budget DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="budget DESC" value="budget DESC">Prezzo&nbsp;<i class="fas fa-sort-amount-down"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="posti_disponibili ASC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="posti_disponibili ASC" value="posti_disponibili ASC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-up"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="posti_disponibili DESC">
                            <button type="submit" class="verdi  btn btn-primary mx-1 my-1" name="posti_disponibili DESC" value="posti_disponibili DESC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-down"></i></button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="from_home_&_button" value="'.$sql.'">
                            <input type="hidden" name="ordinamento" value="trending_index DESC">
                            <button type="submit" class="verdi btn btn-primary mx-1 my-1" name="trending_index" value="trending_index DESC">Tendenza&nbsp;<i class="fas fa-chart-line"></i></button>
                        </form>';
                        }
                        else{
                            echo '
                            <button class="verdi btn btn-primary mx-1 my-1" onclick="window.location.href=\'index.php\'" style="border-radius:7px;"><i class="fas fa-sync-alt black-text"></i></button>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="destinazione ASC" value="destinazione ASC">Destinazione&nbsp;<i class="fas fa-sort-alpha-down" style="vertical-align: middle;"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="destinazione DESC" value="destinazione DESC">Destinazione&nbsp;<i class="fas fa-sort-alpha-up" ></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="data_partenza" value="data_partenza">Data partenza&nbsp;<i class="fas fa-plane-departure"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="data_ritorno" value="data_ritorno">Data ritorno&nbsp;<i class="fas fa-plane-arrival"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="budget ASC" value="budget ASC">Prezzo&nbsp;<i class="fas fa-sort-amount-up"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="budget DESC" value="budget DESC">Prezzo&nbsp;<i class="fas fa-sort-amount-down"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="posti_disponibili ASC" value="posti_disponibili ASC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-up"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="posti_disponibili DESC" value="posti_disponibili DESC">Posti liberi&nbsp;<i class="fas fa-long-arrow-alt-down"></i></button>
                        </form>
                        <form method="POST">
                            <button type="submit" class=" verdi btn btn-primary mx-1 my-1" name="trending_index" value="trending_index DESC">Tendenza&nbsp;<i class="fas fa-chart-line"></i></button>
                        </form>'; 
                        }
                    ?>
                       <?php
                        if(! isset($_POST['from_home'])){
                            echo'
                        <!--barra di ricerca quello che scrivi qui viene cercato nella descrizione del viaggio-->
                        <form class="form-inline my-1 my-lg-0 d-flex align-items-center" method="GET">    
                            <input class="form-control mr-2" type="search" placeholder="Cerca per parole chiavi" aria-label="Search" name="search-bar">
                            <button  type="submit" name="search" style="background-color: transparent; border: none;"><i class="fas fa-search"></i></button>
                            <style>
                                input[type="search"]:focus {/*tolgo bordo quando premo sulla barra*/
                                    box-shadow: none;
                                }
                            </style>
                        </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--parte sotto barra è griglia-->
        <div class="container-fluid" id="griglia1x3">
            <div id="first_col" ></div>
            <div id="second_col" >
            
                <?php   //parte per mostrare le immagini degli utenti che hanno partecipato al viaggio
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


                    function get_travel_offers_get($search, $sort_by) {
                        $sql = "SELECT * FROM Viaggio WHERE LOWER(descrizione) LIKE LOWER('%$search%') OR LOWER(destinazione) LIKE LOWER('%$search%') ORDER BY $sort_by";
                        return $sql;
                    }
                    function get_travel_offers_post($sort_by) {
                        $sql = "SELECT * FROM Viaggio ORDER BY $sort_by";
                        return $sql;
                    }
                    function stampa_viaggio($row){   
                        //fai una query che dato email utente organizzatore prende username da utente avente stessa email
                        $email = $row["email_utente_organizzatore"];
                        $sql = "SELECT username FROM Utente WHERE email = $1";
                        $result = pg_query_params($GLOBALS['dbconn'], $sql, array($email));
                        $row2 = pg_fetch_assoc($result);
                        $username = $row2["username"];
                        if( isset($_SESSION['loggato']) ){//questa cosa vale solo se sei loggato
                            if($row["email_utente_organizzatore"] != $_SESSION['email']){ //se sei il creatore di un viaggio, non farlo apparire questo
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
                                                                    //non serve piu il nome abbiamo messo le immagini echo'&nbsp<a href="../Other_User/Altro_Utente.php?email='.$row3["email_utente_partecipante"].'">'.$username_user.',</a>';
                                                                    propic($row3["email_utente_partecipante"],2); //funzione che stampa la propic, divisione di casi se sei tu o meno
                                                                }
                                                                else{
                                                                    //non serve piu il nome abbiamo messo le immagini echo'&nbsp<a href="../User/index.php">Tu,</a>';
                                                                    propic($row3["email_utente_partecipante"],1); //funzione che stampa la propic
                                                                }
                                                            }
                                                            else{
                                                                //non serve piu il nome abbiamo messo le immagini echo'&nbsp<a href="../Other_User/Altro_Utente.php?email='.$row3["email_utente_partecipante"].'">'.$username_user.',</a>';
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
                                                                <form action="join.php" method="POST">
                                                                    <style>
                                                                    #bottone_join{
                                                                        background-color: #4CAF50; /* Green */
                                                                        border: none;
                                                                        color: white; 
                                                                        margin-bottom: 10px;
                                                                    }
                                                                    </style>
                                                                    <button id="bottone_join" type="submit" class="btn btn-primary btn-round d-flex justify-content-center align-items-center mx-1" name="join_button_id_viaggio" value='.$row["id_viaggio"].'>Partecipa&nbsp <i class="fas fa-handshake fa-lg"></i></button>
                                                                </form>
                                                                <form action="dismiss.php" method="POST">
                                                                    <style>
                                                                    #bottone_dismiss{
                                                                        background-color: #f44336; /* Red */
                                                                        border: none;
                                                                        color: white; 
                                                                        margin-bottom: 10px;
                                                                    }
                                                                    </style>
                                                                    <button id="bottone_dismiss" type="submit" class="btn btn-danger btn-round d-flex justify-content-center align-items-center mx-1" name="dismiss_button_id_viaggio" value='.$row["id_viaggio"].'>Rinuncia&nbsp <i class="fas fa-backspace"></i></button>
                                                                </form>
                                                                <form><!-- form messa solamente per le sue proprietà css che si allinea a tutti gli altri bottoni-->';
                                                                        //se email NON TERMINA CON .COM ALLORA NON TI INSERISCE DA SOLO LA MAIL DENTRO IL CAMPO DESTINATARIO
                                                                        $A = $row["email_utente_organizzatore"];
                                                                        $b = "https://mail.google.com/mail/?view=cm&to=";
                                                                        $c = $b.$A;
                                                                        
                                                                        echo'
                                                                        <style>
                                                                        #bottone_mail_to{
                                                                            background-color: #2196F3; /* Blue */
                                                                            border: none;
                                                                            color: white; 
                                                                            margin-bottom: 10px;
                                                                        }
                                                                        </style>
                                                                        <a target="_blank" id="bottone_mail_to" href='.$c.' class="btn  btn-round d-flex justify-content-center align-items-center mx-1"><i class="far fa-envelope"></i>&nbsp;Organizzatore</a>';                                                                                                                                
                                                                echo'</form>
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
                        }
                        else{//se non sei loggato mostra comunque i viaggi ma senza i bottoni partecipa e rinuncia che sono sostituiti da un link di log in o sign up
                            echo'<div class="container-fluid" style="padding: 12px;"><!--con style messo cosi compaiono i bordi anche laterali-->
                                    <div class="row">
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
                                            <input type="text" class = "campo_testo" disabled value='.($row["num_max_partecipanti"] + 1).' size="1"><!--tieni da conto organizzatore quindi + 1-->
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
                                                                                                                
                                                        propic($row3["email_utente_partecipante"],2); //funzione che stampa la propic, divisione di casi se sei tu o meno//CASO 2 PERCHE NON ESSENDO LOGGATO LA TUA EMAIL NON COINCIDE CON QUELLO E QUINDI NON TI RIMANDA AL TUO PROFILO
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
                                            <i id="freccia_animata_giu'.$row["id_viaggio"].'" class="fas fa-angle-double-down"></i>
                                            <i id="freccia_animata_su'.$row["id_viaggio"].'" style="display: none;" class="fas fa-angle-double-up"></i>
                                            <br>
                                            <label id="etichetta-textarea'.$row["id_viaggio"].'" style="display: none;"><b>Descrizione</b></label>
                                            <textarea id="descrizione-textarea'.$row["id_viaggio"].'" class="form-control form-control-lg" rows="3" style="display: none;" disabled>'.$row["descrizione"].'</textarea> 
                                            <br>
                                            <h3 style="color: green;"><a style="color:green;" href="../signUp/index.php">Registrati</a> o <a style="color:green; text-decoration: underline" onclick="openPopup()">accedi</a> per poter partecipare ai viaggi!</h3>
                                        </div>
                                    </div>
                                </div>
                            <br>';
                        }
                    }
                 ?>
                <?php
//SE SI E' EFFETTUATO UNA RICERCA da questa pagina o SI ACCEDE A QUESTA PAGINA PREMENDO SU CARD VIAGGIO DA FARE
                if(isset($_GET['search'])){
                    //echo'<h1>get ricevuta</h1>';        
                    $search = $_GET['search-bar'];
                    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
//PER RENDERE LA RICERCA CASE UNSENSITIVE metto lower alla colonna cosicche tutti gli elem sono minuscoli e anche quello che cerco lo metto minuscolo
                    if(reset($_POST) != NULL){
                        $ordinamento = reset($_POST);
                        $sql = get_travel_offers_get($search,$ordinamento);
                    }
                    else{
                        $sql = "SELECT * FROM Viaggio WHERE LOWER(descrizione) LIKE LOWER('%$search%') OR LOWER(destinazione) LIKE LOWER('%$search%') ORDER BY id_viaggio;";
                    }
                    
                    $res= pg_query($dbconn, $sql);
                   
                    if($res){//se sono andate entrambe a buon fine
                        $queryResult1 = pg_num_rows($res);
                        if( $queryResult1 > 0 ){
                            echo'<h1 style="color:white;">Viaggi Disponibili</h1>';
                            while($row1 = pg_fetch_assoc($res)){
                                stampa_viaggio($row1);
                            }                                   
                        }
                        else{ 
                            echo "<h1 style='color:white;'>Non ci sono risultati corrispondenti alla tua ricerca!</h1>";
                            echo'<br>';
                            echo'<h5 style="color:white;">Premi <a style="color:white;" href="index.php">qui</a> per vedere tutti i viaggi disponibili al momento sulla nostra piattaforma</h5>';
                        } 
                    }
                    else{//se una delle due non va bene restituisci errore
                        echo'errore nella query';
                    }  
                }
        
//CASO IN CUI SI ACCEDA A QUESTA PAGINA DA BARRA HOME TRAMITE SEARCH BAR
                elseif( isset($_POST['from_home']) ){
                   //conditions è variabile per la query dinamica che abbiamo costruito sopra le 3 tipologie di bottoni
                    echo'<br>';
                    if (!empty($conditions)) {                      //costruzione query dinamica in base a cosa ha selezionato l'utente nella search bar      
                        $query = "SELECT * FROM Viaggio WHERE " . implode(" AND ", $conditions) . "";// query dinamica
                        $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                        $res = pg_query($dbconn, $query);
                        if($res){//se a buon fine
                            $queryResult1 = pg_num_rows($res);
                            if( $queryResult1 > 0 ){
                                echo'<h1>Viaggi Disponibili</h1>';
                                while($row1 = pg_fetch_assoc($res)){
                                    stampa_viaggio($row1);
                                }                                   
                            }
                            else{ 
                                echo "<h1 style='color:white;'>Non ci sono risultati corrispondenti alla tua ricerca!</h1>";
                                echo'<br>';
                                echo'<h5 style="color:white;">Premi <a style="color:white;" href="index.php">qui</a> per vedere tutti i viaggi disponibili al momento sulla nostra piattaforma</h5>';
                            } 
                        }
                        else{//se una delle due non va bene restituisci errore
                            echo'errore nella query';
                        }
                    }
                    else{
                        $query = "SELECT * FROM Viaggio Order by id_viaggio DESC ";
                        $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                        $res = pg_query($dbconn, $query);
                        if($res){//se a buon fine
                            $queryResult1 = pg_num_rows($res);
                            if( $queryResult1 > 0 ){
                                echo'<h1>Viaggi Disponibili</h1>';
                                while($row2 = pg_fetch_assoc($res)){
                                    stampa_viaggio($row2);
                                }                                   
                            }
                            else{ 
                                echo "<h1 style='color:white;'>Non ci sono risultati corrispondenti alla tua ricerca!</h1>";
                                echo'<br>';
                                echo'<h5 style="color:white;" >Premi <a style="color:white;" href="index.php">qui</a> per vedere tutti i viaggi disponibili al momento sulla nostra piattaforma</h5>';
                            } 
                        }
                        else{//se una delle due non va bene restituisci errore
                            echo'errore nella query';
                        }
                    }  
                }
                else if(isset($_POST["from_home_&_button"])){
                    //echo'provieni da home e hai cliccato il bottone';
                    // echo'<br>';
                    //echo'la query senza ord è: '.$_POST["from_home_&_button"];'<br>';
                    //echo'<br>';
                    //echo'l\'ordinamento è: '.$_POST["ordinamento"];'<br>';
                    $q = $_POST["from_home_&_button"] . ' order by ' . $_POST["ordinamento"];
                    //echo'la query finale è: '.$q;'<br>';
                    $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                    $res_tmp = pg_query($dbconn, $q);
                    if($res_tmp){//se a buon fine
                        $queryResult1_tmp = pg_num_rows($res_tmp);
                        if( $queryResult1_tmp > 0 ){
                            echo'<h1>Viaggi Disponibili</h1>';
                            while($row2_tmp = pg_fetch_assoc($res_tmp)){
                                stampa_viaggio($row2_tmp);
                            }                                   
                        }
                        else{ 
                            echo "<h1 style='color:white;'>Non ci sono risultati corrispondenti alla tua ricerca!</h1>";
                            echo'<br>';
                            echo'<h5 style="color:white;" >Premi <a style="color:white;"href="index.php">qui</a> per vedere tutti i viaggi disponibili al momento sulla nostra piattaforma</h5>';
                        } 
                    }
                    else{//se una delle due non va bene restituisci errore
                        echo'errore nella query';
                    }

                }
//SE ACCESSO ALLA PAGINA FATTO ATTRAVERSO TASTO VIAGGIO SENZA AVER EFFETTUATO UNA RICERCA
                else{             
                    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
                    
                    if(reset($_POST) != NULL){
                        $ordinamento = reset($_POST);
                        //echo '<h1>stai eseguendo ordinamento per:'.$ordinamento.'</h1>';//stampa per confermare che stai ordinando per quello che hai scelto
                        $query = get_travel_offers_post($ordinamento);
                    }
                    else{
                        //echo'<h1>stai eseguendo ordinamento per:default</h1>';
                        $query = "SELECT * FROM Viaggio";
                    }
                                   
                    $result = pg_query($dbconn, $query);
                    if($result){//se query che deve trovare la tupla avente email uguale a quella di utente loggato va  a buon fine
                        //stampa ogni tupla che trovi nella tabella viaggio
                        //se la lunghezza di result è 0 allora non ci sono viaggi disponibili
                        if(pg_num_rows($result) == 0){
                            echo'<h1 style="color:white;">Non ci sono viaggi disponibili</h1>';
                        }
                        else{
                            echo'<h1 style="color:white;">Viaggi Disponibili</h1> ';
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
            <div class="modal-content" style="background-image: url(../img/1600806_217886-P0LHA0-902.jpg);background-position: center;background-size: cover;z-index:1032;">
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
                    <button type="button" onclick="closePopup()" aria-label="Close" >
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h3>Per scoprire di più sul tuo prossimo viaggio accedi o registrati!</h3>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form name="myForm" action="login_from_lista_viaggi.php" method="POST" class="form-signin">
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
                    <div class="signup-section">Non hai un account? <a href="../signUp/index.php" class="text-info"> Registrati!</a></div>
                </div>
            </div>
        </div>
    </div> 

    </body>
</html>