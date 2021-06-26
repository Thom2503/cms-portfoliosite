<?php

  session_start();

  include "includes/html.php";

  display_header(NULL, "Bedrijf accepteren", false);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  ?>
    <main>
      <form class="form" action="" method="post">
        <div class="centerAlign">
          <h2>> Bedrijf accepteren</h2>
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <h3>> Gebruikersnaam</h3>
          <input style="width: 300px; height: 50px; " type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
          <h3>> Wachtwoord</h3>
          <input style="width: 300px; height: 50px; " type="password" name="wachtwoord" placeholder="Wachtwoord" required>
        </div>
        <br><br>
        <input class="submit" type="Submit" name="submit" value="Inloggen">
      </form>
    </main>
  <?php

  display_footer();

 ?>
