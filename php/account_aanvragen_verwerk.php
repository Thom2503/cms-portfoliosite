<?php
  session_start();

  // waar is de log file?
	$log_file = "./errors.log";

	//de datum van nu zodat het bij gehouden kan worden in het log
	$date = date('m/d/Y h:i:s a', time());

  include "../includes/html.php";
  include "../includes/email.php";
  include "../includes/send_mail.php";
  include "config.php";

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  function sendMail($bedrijf, $voornaam, $achternaam, $email)
  {
    $to_email = "thomveldhuis03@gmail.com";
    $subject = "Aanvraag account voor Portfoliosite - $bedrijf";
    $body = "
      Er is een aanvraag gedaan om een account aan te maken:
      Naam bedrijf: $bedrijf
      Naam aanvrager: $voornaam $achternaam
      Email: $email

      Wilt u dit bedrijf toegang geven om een account aan te maken?
      Klik de link:
      http://localhost/cms-portfoliosite/account_maken.php
    ";
    $headers[] = "From: Portfoliosite account vrager";

    if (mail($to_email, $subject, $body, implode('\r\n', $headers))) {
        echo "Email successvol verzonden...<br> <button onclick='history.back(); return false;'>Ga terug</button>";
    } else {
        echo "Email verzenden fout gegaan... <br> <button onclick='history.back(); return false;'>Ga terug</button>";
    }
  }

  display_header($name = NULL, "Account aanvragen verwerken...", $log = false, $inFolder = true); //functie voor de rand html, is simpel for mooiheid

  ?>
    <main>
      <?php
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
        {
          if (isset($_POST['submit']))
          {
            $bedrijf = htmlspecialchars($_POST['bedrijfsnaam'], ENT_QUOTES);
            $voornaam = htmlspecialchars($_POST['voornaam'], ENT_QUOTES);
            $achternaam = htmlspecialchars($_POST['achternaam'], ENT_QUOTES);
            $email = $_POST['email'];
            if(!empty($voornaam) || !empty($achternaam) || !empty($email) || !empty($bedrijf))
            {
              if (email_validate($email))
              {
                send_mail($bedrijf, $voornaam, $achternaam, $email);
              } else
              {
                error("Emailadres klopt niet!");
              }
            } else
            {
              error("Sommige velden zijn leeg gelaten!");
            }
          }
        } else
        {
          error("CRSF Token is incorrect!");
        }
       ?>
    </main>
  <?php

  display_footer();

 ?>
