
<?php
    session_start();
    if( !isset($_SESSION['loggato']) ){
        header("Location: index.html");
        exit;
    }
?>
    <?php
    
    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
    $email = $_SESSION["email"];
    $titolo = $_POST['titolo_viaggio'];//ci va inserito il nome dell'elemento input di html
    $descrizione = $_POST['descrizione'];
    $data_partenza = $_POST['data_partenza'];
    $data_ritorno = $_POST['data_ritorno'];
    $budget = $_POST['budget'];
    $destinazione = $_POST['destinazione'];
    $num_max_partecipanti = $_POST['max_partecipanti'];
    //al momento della creazione posti disponibili sono uguali a numero massimo di partecipanti
    $posti_disponibili = $num_max_partecipanti;
    $query = "INSERT INTO Viaggio(Email_Utente_Organizzatore, Titolo, Descrizione, Data_Partenza, Data_Ritorno, Budget, Destinazione, Num_Max_Partecipanti, Posti_disponibili) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
    $result = pg_query_params($dbconn, $query, array($email, $titolo, $descrizione, $data_partenza, $data_ritorno, $budget, $destinazione, $num_max_partecipanti, $posti_disponibili));
    $response = array();
    if($result){
        // chi crea il viaggio deve essere anche partecipante
        $query2 = "INSERT INTO partecipazioni( id_viaggio, email_utente_partecipante) VALUES ((SELECT id_viaggio FROM viaggio WHERE email_utente_organizzatore = '$email' AND titolo = '$titolo' AND descrizione = '$descrizione' and data_partenza = '$data_partenza' AND Data_Ritorno = '$data_ritorno' AND Budget = $budget AND  Destinazione = '$destinazione' AND Num_Max_Partecipanti = $num_max_partecipanti ), '$email')";
        
        $result = pg_query($dbconn, $query2);
        if(!$result){
            $response ['successo'] = false;
           // header("Location: ../index.php?error=creazione-trip-error");
        }else{$response ['successo'] = true;}
       // header("Location: ../index.php?success=creazione-trip-avvenuta");
    }
    
    pg_close($dbconn);
    echo json_encode($response);       
    ?>