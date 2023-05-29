<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar")  or die('Could not connect: ' . pg_last_error());
}
?>
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
        if ($dbconn) {
            //vogliamo che a prescindere da maiuscole e minuscole l'email sia sempre diversa da quelle già presenti nel db
            $email = strtolower($_POST['inputEmail']); // Converti l'email in lowercase
            $q1 = "SELECT * FROM utente WHERE LOWER(email) = LOWER($1)"; // Confronta l'email convertita in lowercase
            $result = pg_query_params($dbconn, $q1, array($email));
            if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                header("Location: ./signUp/index.php?error=email-nuova-errore");
                exit();
            }
            else {
                $password = $_POST['inputPassword'];
                $q2 = "select * from utente where email = $1 and pswrd = $2";
                $result = pg_query_params($dbconn, $q2, array($email,$password));
                if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                    
                    header("Location: index.html?error=password-sbagliata");exit();//avendoci questo url in index.html cè funzione che controlla url e in caso manda alert
                }
                else {
                    session_start();
                    $_SESSION['loggato'] = true;
                    $username = $tuple['username'];
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $tuple['email'];
                    $_SESSION['telefono'] = $tuple['telefono'];
                    $_SESSION['nome'] = $tuple['nome'];
                    $_SESSION['cognome'] = $tuple['cognome'];
                    $_SESSION['datan'] = $tuple['datan'];
                    $_SESSION['sesso'] = $tuple['sesso'];
                    $_SESSION['cittan'] = $tuple['cittan'];
                    $_SESSION['nazionalita'] = $tuple['nazionalita'];
                    header("Location: index.php");
                }
            }
        }
        else {
            echo "Errore nella connessione al database";
        }
        pg_close($dbconn);  //chiudi la connesione con dbms
    ?>
</body>
</html>