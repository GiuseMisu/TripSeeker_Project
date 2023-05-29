<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert interessi</title>
</head>
<body>

<?php
    //scrivi su console il valore di ogni campo
    if(isset($_POST['Restrizioni_alimentari_checkbox_scroll'])) {
        $checkbox_RS_stringa = implode(",", $_POST['Restrizioni_alimentari_checkbox_scroll']);
    }
    else{
        $checkbox_RS_stringa = "";
    }
    if(isset($_POST['professione_input']) && $_POST['professione_input'] != "") {
        $professione = $_POST['professione_input'];
    }
    else{
        $professione = "";
    }
    if(isset($_POST['stato_civile_input']) && $_POST['stato_civile_input'] != "") {
        $stato_civile = $_POST['stato_civile_input'];
    }
    else{
        $stato_civile = "";
    }
    if(isset($_POST['Lingue_parlate_checkbox_scroll'])) {
        $checkbox_LP_stringa = implode(",", $_POST['Lingue_parlate_checkbox_scroll']);
    }
    else{
        $checkbox_LP_stringa = "";
    }
    if(isset($_POST['studi_input'])){
        $studi = $_POST['studi_input'];
    }
    else{
        $studi = "";
    }
    if(isset($_POST['Patente_Guida_checkbox_scroll']) ){
        $checkbox_PG_stringa = implode(",", $_POST['Patente_Guida_checkbox_scroll']);
    }
    else{
        $checkbox_PG_stringa = "";
    }
    if(isset($_POST['Gusto_Musicale_checkbox_scroll'])) {
        $checkbox_GM_stringa = implode(",", $_POST['Gusto_Musicale_checkbox_scroll']);
    }
    else{
        $checkbox_GM_stringa = "";
    }
    if(isset($_POST['Gusto_Cinematografico_checkbox_scroll'])) {
        $checkbox_GC_stringa = implode(",", $_POST['Gusto_Cinematografico_checkbox_scroll']);
    }
    else{
        $checkbox_GC_stringa = "";
    }
    if(isset($_POST['Gusto_Sportivo_checkbox_scroll'])) {
        $checkbox_GS_stringa = implode(",", $_POST['Gusto_Sportivo_checkbox_scroll']);
    }
    else{
        $checkbox_GS_stringa = "";
    }
    if(isset($_POST['checkbox_paesi'])) {
        $checkbox_paesi_stringa = implode(",", $_POST['checkbox_paesi']);
    }
    else{
        $checkbox_paesi_stringa = "";
    }
    if(isset($_POST['Gusto_attivita'])) {
        $checkbox_GA_stringa = implode(",", $_POST['Gusto_attivita']);
    }
    else{
        $checkbox_GA_stringa = "";
    }
    if(isset($_POST['Gusto_mezzi_trasporto'])) {
        $checkbox_GME_stringa = implode(",", $_POST['Gusto_mezzi_trasporto']);
    }
    else{
        $checkbox_GME_stringa = "";
    }
    if(isset($_POST['stile_viaggio_input']) ){
        $stile_viaggio = $_POST['stile_viaggio_input'];
    }
    else{
        $stile_viaggio = "";
    }
    if(isset($_POST['budget_viaggio_input']) ){
        $budget = $_POST['budget_viaggio_input'];
    }
    else{
        $budget = "";
    }

    $email = $_POST['email'];
    
    $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
    if(!$dbconn){
        echo "Error connection";
        exit;
    }
    
    $sql = "SELECT * FROM InteressiUtente WHERE email = '$email'";
    $result = pg_query($dbconn, $sql);
    if(!$result){
        echo "Error query";
        exit;
    }
    else{
       
        $row = pg_num_rows($result);
        
        if($row == 0){
           
           $dbconn1= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
            $query = "INSERT INTO InteressiUtente (email, paesi_visitati, attivita_preferite, mezzi_trasporto, stile_viaggio, budget, Restrizioni_alimentari, professione, stato_civile, Lingue_parlate, titolo_studio, tipo_patente, gusto_musicale, gusto_cinematografico, gusto_sportivo)
            VALUES ('$email', '$checkbox_paesi_stringa', '$checkbox_GA_stringa', '$checkbox_GME_stringa', '$stile_viaggio', '$budget', '$checkbox_RS_stringa', '$professione', '$stato_civile', '$checkbox_LP_stringa', '$studi', '$checkbox_PG_stringa', '$checkbox_GM_stringa', '$checkbox_GC_stringa', '$checkbox_GS_stringa');
            ";
            $result = pg_query($dbconn1, $query);
            if(!$result){
                echo "Error query";
                exit;
            }
            pg_close($dbconn1);
            header("Location: index.php?email=$email");
        }
        else if($row == 1){
           //vogliamo passare i dati inseriti nel fomr al db, ma dato che alcuni campi contengono apici bisogna usare i parametri
           //ma dato che non tutti i campi sono obbligatori non puoi sapere a prescindere il numero di parametri che userai in query dinamica 
           //allora devi prima vedere chi è stato settato e chi no
            $dbconn2= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
            $fields = array();
            $params = array();
            $count = 1;

            if (!empty($checkbox_paesi_stringa)) {
                $fields[] = "paesi_visitati = $" . $count . "::text";
                $params[] = $checkbox_paesi_stringa;
                $count++;
            }
            if (!empty($checkbox_GA_stringa)) {
                $fields[] = "attivita_preferite = $" . $count . "::text";
                $params[] = $checkbox_GA_stringa;
                $count++;
            }
            if (!empty($checkbox_GME_stringa)) {
                $fields[] = "mezzi_trasporto = $" . $count . "::text";
                $params[] = $checkbox_GM_stringa;
                $count++;
            }
            if (!empty($stile_viaggio)) {
                $fields[] = "stile_viaggio = $" . $count . "::text";
                $params[] = $stile_viaggio;
                $count++;
            }
            if (!empty($budget)) {
                $fields[] = "budget = $" . $count . "::text";
                $params[] = $budget;
                $count++;
            }
            if (!empty($checkbox_RS_stringa)) {
                $fields[] = "Restrizioni_alimentari = $" . $count . "::text";
                $params[] = $checkbox_RS_stringa;
                $count++;
            }
            if (!empty($professione)) {
                $fields[] = "professione = $" . $count . "::text";
                $params[] = $professione;
                $count++;
            }
            if (!empty($stato_civile)) {
                $fields[] = "stato_civile = $" . $count . "::text";
                $params[] = $stato_civile;
                $count++;
            }
            if (!empty($checkbox_LP_stringa)) {
                $fields[] = "Lingue_parlate = $" . $count . "::text";
                $params[] = $checkbox_LP_stringa;
                $count++;
            }
            if (!empty($studi)) {
                $fields[] = "titolo_studio = $" . $count . "::text";
                $params[] = $studi;
                $count++;
            }
            if (!empty($patente)) {
                $fields[] = "tipo_patente = $" . $count . "::text";
                $params[] = $patente;
                $count++;
            }
            if (!empty($checkbox_GM_stringa)) {
                $fields[] = "gusto_musicale = $" . $count . "::text";
                $params[] = $checkbox_GM_stringa;
                $count++;
            }
            if (!empty($checkbox_GC_stringa)) {
                $fields[] = "gusto_cinematografico = $" . $count . "::text";
                $params[] = $checkbox_GC_stringa;
                $count++;
            }
            if (!empty($checkbox_GS_stringa)) {
                $fields[] = "gusto_sportivo = $" . $count . "::text";
                $params[] = $checkbox_GS_stringa;
                $count++;
            }
            $query1 = "UPDATE InteressiUtente SET " . implode(', ', $fields) . " WHERE email = $" . $count . "::varchar";

            $params[] = $email;

            $result = pg_query_params($dbconn2, $query1, $params);
            pg_close($dbconn2);
            header("Location: index.php?email=$email");

        }
        else{
            echo "NON POSSONO ESSERCI PIU' DI UN UTENTE CON LA STESSA EMAIL";
            exit;
        }
    }

    
                
?>
          
</body>
</html>