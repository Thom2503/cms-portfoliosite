<?php
  session_start();

  // waar is de log file?
	$log_file = "./errors.log";

	//de datum van nu zodat het bij gehouden kan worden in het log
	$date = date('m/d/Y h:i:s a', time());

  include "../includes/html.php";
  include "config.php";

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  display_header($name = NULL, "Account aanvragen verwerken...", $log = false, $inFolder = true); //functie voor de rand html, is simpel for mooiheid

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
