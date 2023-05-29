<?php
if (!isset($_POST["cambio_password"])){
    header("Location: ../index.php");
    exit();
}

$dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
if (!$dbconn){
    die('Could not connect: ' . pg_last_error());
}

$email = $_POST["email"];                           
$password = $_POST["nuova_password"];
$password_ripetizione = $_POST["nuova_password_ripetizione"];
if ($password != $password_ripetizione){
    echo "<script>alert('Le password non coincidono')</script>";
    echo "<script>setTimeout(function() { window.location.href = './cambio_password.php?pulsante_invio_token=a'; }, 3000);</script>";

}
else{
    $q1 = "UPDATE utente SET pswrd = $1 , confpswrd = $1 WHERE email = $2";
    $result = pg_query_params($dbconn, $q1, array($password, $email));
    if (!$result){
        echo "Errore durante l'esecuzione della query.";
        exit();
    }
    else{
        echo "<script>alert('Password cambiata con successo, ora puoi loggarti!')</script>";
        echo "<script>setTimeout(function() { window.location.href = '../index.php'; }, 2400);</script>";
    }
}

