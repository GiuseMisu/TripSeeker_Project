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
    <title>Document</title>
</head>
<body>
    <?php
        
        $email = $_SESSION['email']; //questo è il nome che elelmento input di html ha
        $id_viaggio = $_POST['join_button_id_viaggio'];
        
        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $query = "SELECT * FROM partecipazioni WHERE email_utente_partecipante = $1 and id_viaggio = $2";
        $result = pg_query_params($dbconn, $query, array($email, $id_viaggio));
        
        if(pg_num_rows($result) > 0){//se trovi già la tupla vuold dire che utente è già partecipante a questo viaggio
           
            header("Location: index.php?error=utente-gia-partecipante");exit();
        }
        else{//altrimenti inserisci la tupla
            $query2 = "INSERT INTO partecipazioni(email_utente_partecipante, id_viaggio) VALUES ($1, $2)";
            $result = pg_query_params($dbconn, $query2, array($email, $id_viaggio));
            if($result){
                $sql = "SELECT Posti_disponibili FROM viaggio WHERE id_viaggio = $1";
                $result = pg_query_params($dbconn, $sql, array($id_viaggio));
                $row = pg_fetch_assoc($result);
                //controlla che il viaggio non sia pieno
                if($row['posti_disponibili'] <= 0){
                    header("Location: index.php?error=viaggio-pieno");
                }else{
                    //se inserimento andato a buon fine devi anche ridurre il campo posti_disponibili di 1
                    $query3 = "UPDATE viaggio SET Posti_disponibili = Posti_disponibili - 1 WHERE id_viaggio = $1";
                    $result = pg_query_params($dbconn, $query3, array($id_viaggio));
                    if(!$result){
                        die("Errore nella query, la registrazione NON è andata a buon fine");
                    }
                    else{
                        header("Location: index.php?success=partecipazione-registrata");
                    }
                }
            }
            else{
                die("Errore nella query, la registrazione NON è andata a buon fine");
            }
        }

    ?>
</body>
</html>