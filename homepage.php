<?php

  session_start();

  if ($_SESSION['type'] == 1)
  {
    $bool = true;
  } else
  {
    $bool = false;
  }

  include "includes/html.php";

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Homepagina", true, false, $bool, $_SESSION['uuid']);

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  ?>
    <main>
      <div class="user_info">

      </div>
    </main>
  <?php

  display_footer();

 ?>
