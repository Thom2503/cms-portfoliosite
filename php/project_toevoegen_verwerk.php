<?php
  session_start();

  if ($_SESSION['type'] != 1)
  {
    header("location: user.php?id=".$_SESSION['uuid']);
  }

  // waar is de log file?
	$log_file = "./errors.log";

	//de datum van nu zodat het bij gehouden kan worden in het log
	$date = date('m/d/Y h:i:s a', time());

  include "../includes/email.php";
  include "../includes/uuid.php";
  include "../includes/html.php";
  include "config.php";

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  $uuid = uuidv4(); //uuid voor een unique id. Komt van uuid.php

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Projecten verwerken...", true, true); //functie voor de rand html, is simpel for mooiheid

  ?>
    <main>
      <?php
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
        {
          if (isset($_POST['submit']))
          {

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
