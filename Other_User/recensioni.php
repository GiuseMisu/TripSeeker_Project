
    <?php
        $titolo = $_POST['titolo_recensione_input'];
        $voto = $_POST['voto_recensione_input']; 
        $testo = $_POST['testo_recensione_input'];
        $email_utente_recensito = $_POST['email_utente_recensito'];
        $email_utente_recensore = $_POST['email_utente_recensore'];
        $username_recensore = $_POST['username_recensore'];
        //se recensore ha già recensito utente, non può recensirlo di nuovo
        $db = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $query = "SELECT * FROM recensioni WHERE email_utente_recensore = '$email_utente_recensore' AND email_utente_recensito = '$email_utente_recensito'";
        $resu = pg_query($db, $query);
        $row = pg_fetch_assoc($resu);
        $response = array();
        if($row['email_utente_recensore'] == $email_utente_recensore){
           $response['giarecensito'] = true;
           
        }
        else{
            $response['giarecensito'] = false;
            $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
            $query = "INSERT INTO recensioni (titolo, voto, descrizione_recensione, email_utente_recensito, email_utente_recensore, username_recensore) VALUES ('$titolo', '$voto', '$testo', '$email_utente_recensito', '$email_utente_recensore', '$username_recensore')";
            $result = pg_query($dbconn, $query);
            if (!$result) {
                echo "An error occurred.\n";
                exit;
            }
            pg_close($dbconn);          
        }   
        echo json_encode($response);            
    ?>