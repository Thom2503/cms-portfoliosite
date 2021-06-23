<?php
  session_start();

  // waar is de log file?
	$log_file = "./errors.log";

	//de datum van nu zodat het bij gehouden kan worden in het log
	$date = date('m/d/Y h:i:s a', time());

  include "../includes/email.php";
  include "../includes/uuid.php";
  include "../includes/html.php";
  include "config.php";

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  $uuid = uuidv4(); //uuid voor een unique id. Komt van uuid.php

  display_header(NULL, "Account maken verwerken...", false, true); //functie voor de rand html, is simpel for mooiheid

  ?>
    <main>
      <?php
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
        {
          if (isset($_POST['submit']))
          {
            $voornaam = htmlspecialchars($_POST['voornaam'], ENT_QUOTES);
            $achternaam = htmlspecialchars($_POST['achternaam'], ENT_QUOTES);
            $email = $_POST['email'];
            $password = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT); //password_hash is nu de beste manier om passwords in php te encrypten
            $gebruikersnaam = htmlspecialchars($_POST['gebruikersnaam'], ENT_QUOTES);
            $over = htmlspecialchars($_POST['over'], ENT_QUOTES);

            $type = 3; //types zijn in dit geval om te kijken wat voor gebruiker het is. 1: student, 2: leraar/admin, 3: bedrijf
            $zero = 8;

            if(!empty($voornaam) || !empty($achternaam) || !empty($email) || !empty($password) ||
                !empty($gebruikersnaam) || !empty($opleiding) || !empty($over))
            {
              if (email_validate($email))
              {

                  //stmt is for adding to the user table.
                  //stmt2 is for adding the rest of the info to the user_about table.

                  $stmt = mysqli_prepare($mysqli, 'INSERT INTO `users`
                    (`UserID`, `Type`, `Naam`, `Achternaam`, `Email`, `Username`, `Password`, `Opleiding_ID`)
                    VALUES (?,?,?,?,?,?,?,?)');

									mysqli_stmt_bind_param($stmt, 'sisssssi', $uuid, $type, $voornaam, $achternaam, $email, $gebruikersnaam, $password, $zero);

									mysqli_stmt_execute($stmt);

									$result = mysqli_stmt_get_result($stmt);

                  mysqli_stmt_execute($stmt);

                  // ------------=Dit hier is allemaal stmt2=------------------
                  $stmt2 = mysqli_prepare($mysqli, 'INSERT INTO `user_info`(`User_ID`, `About`)
                    VALUES (?, ?)');

									mysqli_stmt_bind_param($stmt2, 'ss', $uuid, $over);

									mysqli_stmt_execute($stmt2);

									$result2 = mysqli_stmt_get_result($stmt2);

                  mysqli_stmt_execute($stmt2);
                  try
                  {
                    if (!$result && !$result2)
                    {
                      //sessions om later te gebruiken.
                      $_SESSION['username'] = $gebruikersnaam;
                      $_SESSION['voornaam'] = $voornaam;
                      $_SESSION['achternaam'] = $achternaam;
                      $_SESSION['uuid'] = $uuid;
                      $_SESSION['type'] = $type;

                      header("location: ../user.php?id=".$uuid);

                      mysqli_stmt_close($stmt);

                      mysqli_stmt_close($stmt2);

                    }else
										{
										  // error message om er in te zetten
											$error_message = $date . " Fout met het verbinden met de database\n";
											// de daadwerkelijke error in het log file zetten
											error_log($error_message, 3, $log_file);
											throw new Exception(error('Sorry voor het ongemak er kan momenteel geen verbinding met de database gemaakt worden.'));
										}
                  } catch (Exception $e)
                  {
                    echo $e->getMessage();
                  }
              } else
              {
                // error("Emailadres klopt niet!");
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
