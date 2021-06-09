<?php

  session_start();

  include "includes/html.php";
  include "includes/opleidingen.php";

  display_header(NULL, "Account maken", false);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  ?>
    <main>
      <form class="form" action="php/account_maken_verwerk.php" method="post">
        <h2>> Account maken</h2>
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
        <div class="flex-input">
          <div class="flex-left">
            <h3>> Voornaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="voornaam" placeholder="Voornaam" required>
            <h3>> Email</h3>
            <input style="width: 300px; height: 50px;" type="email" name="email" placeholder="Email" required>
            <h3>> Wachtwoord</h3>
            <input style="width: 300px; height: 50px;" type="password" name="wachtwoord" placeholder="Wachtwoord" required>
          </div>
          <div class="flex-right" style="margin-left: 8em;">
            <h3>> Achternaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="achternaam" placeholder="Achternaam" required>
            <h3>> Gebruikersnaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
            <h3>> Opleiding</h3>
            <select style="width: 300px; height: 50px;" name="opleiding" required>
              <option selected value="0">Kies een opleiding</option>
              <?php getOpleidingen(); ?>
            </select>
          </div>
        </div>
        <h3>> Over student</h3>
        <textarea name="over" rows="8" cols="80" placeholder="Over student" required></textarea>
        <input class="submit" type="Submit" name="submit" value="Account maken">
      </form>
    </main>
  <?php

  display_footer();

 ?>
