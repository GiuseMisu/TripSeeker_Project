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
        $id_viaggio = $_POST["id_viaggio"];
        echo $id_viaggio;
        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        $query = "UPDATE viaggio SET trending_index = trending_index + 1 WHERE id_viaggio = $id_viaggio";  //query che aggiorna valore del campo trending_index della tabella viaggio
        $result = pg_query($dbconn, $query);
        if(!$result){
            die("Errore nella query, la registrazione NON è andata a buon fine");
        }
        else{
            echo "Tutto ok";//debug lo vedo da console
        }
    ?>
</body>
</html>