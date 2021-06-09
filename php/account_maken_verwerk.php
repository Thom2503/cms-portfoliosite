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

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }
  $uuid = uuidv4(); //uuid voor een unique id.

  display_header($name = NULL, "Account maken verwerken...", $log = false, $inFolder = true);

  //alle opleidingen om te zoeken naar
  $opleidingen = array(1 => "Mediavormgeven" ,
	                     2 => "Creative Productie",
	                     3 => "Mediamanagement",
	                     4 => "Redactiemedewerker",
                       5 => "Mediatechnologie",
                       6 => "Audiovisuele Media",
                       7 => "Podium- en evenemententechniek");

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
            $opleiding = htmlspecialchars($_POST['opleiding'], ENT_QUOTES);
            $over = htmlspecialchars($_POST['over'], ENT_QUOTES);

            $type = 1; //types zijn in dit geval om te kijken wat voor gebruiker het is. 1: student, 2: leraar/admin, 3: bedrijf

            if(!empty($voornaam) && !empty($achternaam) && !empty($email) && !empty($password) &&
                !empty($gebruikersnaam) && !empty($opleiding) && !empty($over))
            {
              if (email_validate($email))
              {
                $ID = array_search($opleiding, $opleidingen); //krijg de id van de opleiding
                if(in_array($opleiding, $opleidingen))
                {
                  $stmt = mysqli_prepare($mysqli, 'INSERT INTO `users`
                    (`UserID`, `Type`, `Naam`, `Achternaam`, `Email`, `Username`, `Password`, `Opleiding_ID`)
                    VALUES (?,?,?,?,?,?,?,?)');

									mysqli_stmt_bind_param($stmt, 'sisssssi', $uuid, $type, $voornaam, $achternaam, $email, $gebruikersnaam, $password, $ID);

									mysqli_stmt_execute($stmt);

									$result = mysqli_stmt_get_result($stmt);

                  mysqli_stmt_execute($stmt);
                  try
                  {
                    if (!$result)
                    {
                      $_SESSION['username'] = $gebruikersnaam;
                      $_SESSION['uuid'] = $uuid;
                      $_SESSION['type'] = $type;
                      $_SESSION['Opleiding_ID'] = $ID;

                      header("location: ../user.php?id=".$uuid);

                      mysqli_stmt_close($stmt);

                      

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
                  error("Opleiding is ongeldig!");
                }
              } else
              {
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
