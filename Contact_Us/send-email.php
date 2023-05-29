<?php
// Connessione al database
$dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");

// Verifica la connessione
if (!$dbconn) {
  die("Connessione fallita: " . pg_last_error());
}

// Recupera i dati dal form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepara la query per l'inserimento dei dati nel database
$sql = "INSERT INTO contattaci (nome, email, oggetto, messaggio) VALUES ('$name', '$email', '$subject', '$message')";

// Esegui la query
$result = pg_query($dbconn, $sql);

if ($result) {
  echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false));
}

// Chiudi la connessione
pg_close($dbconn);
?>
