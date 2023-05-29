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
        
        $email = $_POST['email'];

        $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");
        if(!$dbconn){
            echo "Error connection";
            exit;
        }

        $sql = "DELETE FROM InteressiUtente WHERE email = '$email'";
        $res = pg_query($dbconn, $sql);
        if(!$res){
            echo "Errore nella cancellazione degli interessi";
            exit;
        }
        header("Location: index.php?email=$email");

        // Indicare che l'operazione è stata completata con successo
        echo "Interessi eliminati correttamente";


    ?>
</body>
</html>