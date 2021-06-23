<?php

  session_start();

  $uuid = $_GET['id'];

  if ($_SESSION['type'] == 1)
  {
    $bool = true;
  } else
  {
    $bool = false;
  }

  include "includes/html.php";
  include "includes/opleidingen.php";
  include "php/config.php";

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  //query om gegevens te krijgen van beide bedrijven en studenten
  $query = "SELECT media.Type, media.Name, media.Project_ID, project.ID, project.Titel,
  project.Omschrijving, project.Datum, project.User_ID FROM `media`, `project` WHERE `Project_ID` = project.`ID`
  AND project.`ID` = ? AND media.`Project_ID` = ?";

  if($stmt = mysqli_prepare($mysqli, $query))
  {
    mysqli_stmt_bind_param($stmt, "ss", $uuid, $uuid);

    if(!mysqli_stmt_execute($stmt))
    {
      error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
    } else
    {
      $result = mysqli_stmt_get_result($stmt);

      $rij = mysqli_fetch_array($result, MYSQLI_BOTH);
    }
  }

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], $rij['Titel'], true, false, $bool, $_SESSION['uuid']);

  ?>
    <main>
      <div class="project_info">
        <a href="javascript:history.back()">> Terug</a>
        <h2>><?php echo " ".$rij['Titel'] ?></h2>
        <div class="omschrijving">
          <p><?php echo $rij['Omschrijving'] ?></p>
        </div>
        <a class="bestand" href="media.php?name=<?php echo $rij['Name'] ?>">Bestand</a><br>
        <?php if ($uuid == $_SESSION['uuid'] || $rij['User_ID'] == $_SESSION['uuid']): ?>
          <a class="bestand" style="color: #8fe507;" href="project_aanpassen.php?id=<?php echo $rij['Project_ID'] ?>">Aanpassen</a><br>
          <a class="bestand" style="color: rgba(228, 004, 040);" href="project_verwijderen.php?id=<?php echo $rij['Project_ID'] ?>">Verwijderen</a>
        <?php endif; ?>
      </div>
    </main>
  <?php

  display_footer();

 ?>
