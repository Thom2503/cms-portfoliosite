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

  display_header($name = NULL, "Inloggen verwerken...", $log = false, $inFolder = true); //functie voor de rand html, is simpel for mooiheid

  ?>
    <main>
      <?php
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
        {
          if (isset($_POST['submit']))
          {
            $password = htmlspecialchars($_POST['wachtwoord'], ENT_QUOTES); //password_hash is nu de beste manier om passwords in php te encrypten
            $gebruikersnaam = htmlspecialchars($_POST['gebruikersnaam'], ENT_QUOTES);
            if(!empty($password) ||!empty($gebruikersnaam))
            {
              $stmt = mysqli_prepare($mysqli, 'SELECT * FROM `users` WHERE `Username` = ?');

              mysqli_stmt_bind_param($stmt, 's', $gebruikersnaam);

              mysqli_stmt_execute($stmt);

              $result = mysqli_stmt_get_result($stmt);
              $numRows = mysqli_num_rows($result);
              if ($numRows == 1)
              {
                //pakt de user uit de database
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['Password']) || $gebruikersnaam == $row['Username'])
                {
                  //sessions om later te gebruiken.
                  $_SESSION['username'] = $gebruikersnaam;
                  $_SESSION['uuid'] = $row['UserID'];
                  $_SESSION['type'] = $row['Type'];
                  $_SESSION['Opleiding_ID'] = $row['Opleiding_ID'];

                  mysqli_stmt_close($stmt);

                  header("location: ../user.php?id=".$row['UserID']);
                } else
                {
                    error("Je wachtwoord of gebruikersnaam is incorrect probeer het opnieuw!");
                }
              }else
              {
                // error message om er in te zetten
                $error_message = $date . " Fout met het verbinden met de database\n";
                // de daadwerkelijke error in het log file zetten
                error_log($error_message, 3, $log_file);
                error('Sorry voor het ongemak er kan momenteel geen verbinding met de database gemaakt worden.');
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
