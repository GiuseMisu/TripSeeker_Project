<!DOCTYPE html>
<?php 
    //va messo senno anche senza essere loggato potresti raggiungere questa pagina
    session_start();
    if( !isset($_SESSION['loggato']) ){
        header("Location: index.html");
        exit;
    }  
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dismiss trip</title>
</head>
<body>
    <?php 
        $email = $_SESSION['email']; //questo è il nome che elelmento input di html ha
        $id_viaggio = $_POST['dismiss_button_id_viaggio'];
        echo "email dell'utente " . $email . "  ";
        echo "id viaggio " . $id_viaggio . "";
        
        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $query = "SELECT * FROM partecipazioni WHERE email_utente_partecipante = $1 and id_viaggio = $2";
        $result = pg_query_params($dbconn, $query, array($email, $id_viaggio));

        if(pg_num_rows($result) > 0){//se trovi già la tupla vuold dire che utente è già partecipante a questo viaggio
            //se email corrispodne a email creatore cancelli il viaaggio a tutti gli utenti che partecipano
            $sql = "SELECT * FROM viaggio WHERE id_viaggio = $1 and email_utente_organizzatore = $2";
            $result1 = pg_query_params($dbconn, $sql, array($id_viaggio, $email));
            if(pg_num_rows($result1) > 0){//se trovi già la tupla vuold dire che utente è già partecipante a questo viaggio
                $query4 = "DELETE FROM partecipazioni WHERE id_viaggio = $id_viaggio";            
                $result4 = pg_query($dbconn, $query4);
                if(!$result4){
                    die("Errore nella query, la cancellazione NON è andata a buon fine");
                }
                else{
                    header("Location: User_Trip.php?success=partecipazione-eliminata");
                }
            }
            else{
                //elimina la tupla per disiscrivere l'utente
                $query2 = "DELETE FROM partecipazioni WHERE email_utente_partecipante = $1 and id_viaggio = $2";            
                $result = pg_query_params($dbconn, $query2, array($email, $id_viaggio));
                if($result){
                    //se eliminazione andata a buon fine devi anche aumentare il campo posti_disponibili di 1
                    $query3 = "UPDATE viaggio SET Posti_disponibili = Posti_disponibili + 1 WHERE id_viaggio = $id_viaggio ";
                    $res = pg_query($dbconn, $query3);
                    if(!$res){
                        die("Errore nella query, la registrazione NON è andata a buon fine");
                    }
                    else{
                        header("Location: User_Trip.php?success=partecipazione-eliminata");
                    }
                }
                else{
                    die("Errore nella query, la registrazione NON è andata a buon fine");
                }
            }
        }
        else{//se non trovi utente non è partecipante a questo viaggio
            header("Location: User_Trip.php?error=utente-non-partecipante");exit();
        }
    ?>
</body>
</html>