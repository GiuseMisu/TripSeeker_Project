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
    <title>Document</title>
</head>
<body>
    <?php 
       $EMAIL = $_SESSION['email'];
       // Connect to the database
       $dbconn= pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");

       //se profilo con email ha gia setata una foto di profilo la carico
       $query = "SELECT profile_pic FROM utente WHERE email = '$EMAIL'";
       
       $result = pg_query($dbconn, $query);
       if($result){
            // Create the SQL query to insert the image into the database
            $query2 = "UPDATE utente SET profile_pic = null WHERE email = '$EMAIL'";

            // Execute the query
            pg_query($dbconn, $query2);
            //echo "<img src=../foto_profilo/$image_name width='100px' height='100px'>";    
       }
       
        header("Location: index.php");
        exit;

    ?>
</body>
</html>