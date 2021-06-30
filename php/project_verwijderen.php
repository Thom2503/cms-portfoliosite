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

  include "../includes/uuid.php";
  include "../includes/html.php";
  include "config.php";

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Projecten verwerken...", true, true, false, $_SESSION['uuid']); //functie voor de rand html, is simpel for mooiheid

  ?>
    <main>
      <?php
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
        {
          if (isset($_POST['verwijderen']))
          {
            $titel = htmlspecialchars($_POST['titel'], ENT_QUOTES);
            $omschrijving = htmlspecialchars($_POST['omschrijving'], ENT_QUOTES);
            $userid = htmlspecialchars($_POST['userid'], ENT_QUOTES);
            $uuid = htmlspecialchars($_POST['uuid'], ENT_QUOTES);
            $fileName = htmlspecialchars($_POST['old'], ENT_QUOTES);
            $filePath = "../uploads/".$fileName;

            if(!empty($titel) || !empty($omschrijving) || !empty($fileName) || !empty($userid))
            {
                //DELETE a.*, b.*
//FROM media as a, project as b
//WHERE a.Project_ID = "9292fa80-6f75-4564-9fe9-972b06392d27" and b.ID = "9292fa80-6f75-4564-9fe9-972b06392d27"
                $stmt = mysqli_prepare($mysqli, 'DELETE FROM project
                  WHERE project.ID = ?');

                mysqli_stmt_bind_param($stmt, 's', $uuid);

                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                try
                {
                  if (!$result)
                  {

                    unlink($filePath);

                    mysqli_stmt_close($stmt);

                    header("location: ../user.php?id=".$userid);

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
