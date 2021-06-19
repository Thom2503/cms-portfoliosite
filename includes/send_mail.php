<?php

  function send_mail($bedrijf, $voornaam, $achternaam, $email)
  {

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $fh = fopen('../config.txt','r'); // is for the password it's in a txt file for safety measures
    while ($line = fgets($fh))
    {
      $password = $line;
    }
    fclose($fh);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'toudoukirin7@gmail.com';               //SMTP username
        $mail->Password   = $password;                              //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('toudoukirin7@gmail.com', 'Portfoliosite account vrager');
        $mail->addAddress('thomveldhuis03@gmail.com');     //Add a recipient
        $mail->addReplyTo('toudoukirin7@gmail.com', 'Portfoliosite account vrager');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Aanvraag account voor Portfoliosite - $bedrijf';
        $mail->Body    = "
          Er is een aanvraag gedaan om een account aan te maken:
          Naam bedrijf: $bedrijf <br>
          Naam aanvrager: $voornaam $achternaam <br>
          Email: $email <br>

          Wilt u dit bedrijf toegang geven om een account aan te maken?
          Klik de link:
          <a href='http://localhost/cms-portfoliosite/account_geven.php?mail=$email'>Account toegang geven</a>
        ";

        $mail->send();
        echo "Email successvol verzonden...<br> <button onclick='history.back(); return false;'>Ga terug</button>";
    } catch (Exception $e) {
        echo "Email verzenden fout gegaan... <br> <button onclick='history.back(); return false;'>Ga terug</button> <br> Mailer Error: {$mail->ErrorInfo}";
    }
  }

 ?>
