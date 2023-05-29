<?php

    use PHPMailer\PHPMailer\PHPMailer;   //Importo PHPMailer nel global namespace
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST["reset_request"])){

        
        $token = bin2hex(random_bytes(4));  //creo un token randomico
        


        $dbconn = pg_connect("host=localhost port=5432 dbname=ltw user=postgres password=biar");

        if (!$dbconn) {
            echo "Errore nella connessione al server";
            exit();
        }
        
        $email = $_POST["email_utente"];

        $q0 = "SELECT email FROM utente WHERE LOWER(email) = LOWER($1)";    //controllo che l'email sia presente nel db
        $result0 = pg_query_params($dbconn, $q0, array($email));
        if (!$result0){
            echo "Errore durante l'esecuzione della query.";
            header("Location: ./password_dimenticata.php?error=email_non_presente");
            exit();
        }



        $q2 = "INSERT INTO reset_password (email_utente, token) VALUES ($1, $2)";  //inserisco email token e scadenza nel db
        $result2 = pg_query_params($dbconn, $q2, array($email, $token));

        if (!$result2) {
            header("Location: ./password_dimenticata.php?error=email_non_presente");
            die("Errore nella query, la registrazione NON è andata a buon fine");

        }

        pg_close($dbconn);
    
       
    
        


        require "PHPMailer/src/Exception.php";
        require "PHPMailer/src/PHPMailer.php";
        require "PHPMailer/src/SMTP.php";
        $mail = new PHPMailer(true);


        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'tripseekerservice@gmail.com';          //SMTP username
            $mail->Password   = 'sqncvqdyiyxtovlu';                         //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'TripSeeker');
            $mail->addAddress($email);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'TripSeeker: password reset';
            $mail->Body    = 'Il tuo token per resettare la password è: '.$token.' <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <h1 style="color:red">Se non hai richiesto tu il reset della password, attenzione che qualcuno sta provando ad accedere al tuo profilo</h1>';
            $mail->AltBody = 'Il tuo token per resettare la password è: '.$token.' <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <h1 style="color:red">Se non hai richiesto tu il reset della password, attenzione che qualcuno sta provando ad accedere al tuo profilo</h1>';    //testo per i client mail che non supportano l'HTML

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        header("Location: ./inserimento_token.php?email=".$email);

    } else {
        header("Location: ../index.php");
        exit();
    }




?>