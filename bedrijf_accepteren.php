<?php

  session_start();

  $bedrijf = $_GET['b'];
  $email = $_GET['m'];
  $voornaam = $_GET['v'];
  $achternaam = $_GET['a'];

  include "includes/html.php";
  include "includes/email.php";
  include "includes/send_mail.php";

  display_header(NULL, "Bedrijf accepteren", false);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  ?>
    <main>
      <?php
        if (isset($_POST['submit']))
        {
            $bedrijfNaam = htmlspecialchars($_POST['bedrijf'], ENT_QUOTES);
            $emailAdres = $_POST['email'];

            if(!empty($emailAdres) || !empty($bedrijfNaam))
            {
              if (email_validate($emailAdres))
              {
                send_confirmation($bedrijfNaam, $voornaam, $achternaam, $emailAdres);
              } else
              {
                error("Emailadres klopt niet!");
              }
            } else
            {
              error("Sommige velden zijn leeg gelaten!");
            }
        } else
        {
       ?>
      <form class="form" method="post">
        <h2 align="center">> Bedrijf accepteren</h2>
        <div class="centerAlign">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <input type="hidden" value="<?php echo $bedrijf ?>" name="bedrijf">
          <input type="hidden" value="<?php echo $email ?>" name="email">
          <h3>> Bedrijf</h3>
          <input style="width: 300px; height: 50px; " type="text" value="<?php echo $bedrijf ?>" name="bedrijven" disabled required>
          <h3>> Email</h3>
          <input style="width: 300px; height: 50px; " type="email" value="<?php echo $email ?>" name="mail" disabled required>
        </div>
        <br><br>
        <input class="submit" type="Submit" name="submit" value="Accepteren">
      </form>
      <?php
        }
       ?>
    </main>
  <?php

  display_footer();

 ?>
