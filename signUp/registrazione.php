<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $email = strtolower($_POST['inputEmail']); // Converti l'email in lowercase
        $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $q1 = "SELECT * FROM utente WHERE LOWER(email) = LOWER($1)"; // Confronta l'email convertita in lowercase
        
        $result = pg_query_params($dbconn, $q1, array($email));
        if (($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
            header("Location: index.html?error=email-gia-presente-errore");exit();
        }
        else{
            
            $nome = $_POST['inputNome'];
            $cognome = $_POST['inputCognome'];
            $cittan = $_POST['inputCittaN'];
            $nazionalita = $_POST['inputNazio'];
            $datan = $_POST['inputData_nascita'];
            $sesso = $_POST['inputSesso'];
            $telefono = $_POST['inputTelefono'];
            $username = $_POST['inputUsername'];
            //controlliamo se esiste già un utente con lo stesso username
            $query_username = "SELECT * FROM utente WHERE utente.username = '$username'";//username è case sensitive
            $r = pg_query($dbconn, $query_username);

            if(pg_num_rows($r) > 0){
                header("Location: index.html?error=username-gia-presente-errore");exit();
            }
            
            $Email=$_POST['inputEmail'];
            $pswrd = $_POST['inputPassword'];
            $confpswrd = $_POST['inputConferma_password'];
            
            $query2 = "INSERT INTO utente(nome, cognome, cittan, nazionalita, datan, sesso, telefono, email, username, pswrd, confpswrd ) VALUES ($1,$2, $3, $4, $5, $6, $7, $8, $9, $10, $11 )";
            $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $cittan, $nazionalita, $datan, $sesso, $telefono, $Email, $username, $pswrd, $confpswrd));
            if($result){
                
                // image e sue prop  
                $image = $_FILES['image']['tmp_name'];
                $image_name = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                if ($image_size > 0) {// Check se imagine_size è maggiore di 0
                    // imposto dove salvare la foto caricata
                    move_uploaded_file($image, "../foto_profilo/" . $image_name);
                    // inserisco il nome della foto nel db
                    $query3 = "UPDATE utente SET profile_pic = '$image_name' WHERE email = '$Email'";
                    pg_query($dbconn, $query3);
                    
                }

                header("Location: ../index.html?success=registrazione-avvenuta");

            }
            else{
                die("Errore nella query, la registrazione NON è andata a buon fine");
            }
        }
        pg_close($dbconn);  //chiudi la connesione con dbms
    ?>
      
</body>
</html>