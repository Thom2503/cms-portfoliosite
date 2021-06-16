<?php

  session_start();

  include "includes/html.php";
  include "includes/opleidingen.php";

  display_header(NULL, "Account aanvragen", false);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  ?>
    <main>
      <form class="form" action="php/account_aanvragen_verwerk.php" method="post">
        <div class="centerAlign" style="width: 400px;">
          <h2>> Account aanvragen</h2>
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <h3>> Bedrijfsnaam</h3>
          <input style="width: 300px; height: 50px; " type="text" name="bedrijfsnaam" placeholder="Bedrijfsnaam" required>
          <h3>> Voornaam</h3>
          <input style="width: 300px; height: 50px; " type="text" name="voornaam" placeholder="Voornaam" required>
          <h3>> Achternaam</h3>
          <input style="width: 300px; height: 50px; " type="text" name="achternaam" placeholder="Achternaam" required>
          <h3>> Email</h3>
          <input style="width: 300px; height: 50px; " type="email" name="email" placeholder="Email" required>
        </div>
        <br><br>
        <input class="submit" type="Submit" name="submit" value="Aanvragen">
      </form>
    </main>
  <?php

  display_footer();

 ?>
