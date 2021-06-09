<?php

  include "includes/html.php";

  display_header(NULL, "Account maken", False);

  ?>
    <main>
      <form class="form" action="php/account_maken_verwerk.php" method="post">
        <h2>> Account maken</h2>
        <div class="flex-input">
          <div class="flex-left">
            <h3>> Voornaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="voornaam" placeholder="Voornaam">
            <h3>> Email</h3>
            <input style="width: 300px; height: 50px;" type="text" name="email" placeholder="Email">
            <h3>> Wachtwoord</h3>
            <input style="width: 300px; height: 50px;" type="text" name="wachtwoord" placeholder="Wachtwoord">
          </div>
          <div class="flex-right" style="margin-left: 8em;">
            <h3>> Achternaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="achternaam" placeholder="Achternaam">
            <h3>> Gebruikersnaam</h3>
            <input style="width: 300px; height: 50px;" type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
            <h3>> Opleiding</h3>
            <input style="width: 300px; height: 50px;" type="text" name="opleiding" placeholder="Opleiding">
          </div>
        </div>
        <h3>> Over student</h3>
        <textarea name="name" rows="8" cols="80" placeholder="Over student"></textarea>
        <input class="submit" type="Submit" name="submit" value="Account maken">
      </form>
    </main>
  <?php

  display_footer();

 ?>
