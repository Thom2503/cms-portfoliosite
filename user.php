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
  $query = "SELECT * FROM `users`, `user_info` WHERE `UserID` = ? AND `User_ID` = ?";

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

  //alle opleidingen om te zoeken naar
  $opleidingen = array(1 => "Mediavormgeven" ,
	                     2 => "Creative Productie",
	                     3 => "Mediamanagement",
	                     4 => "Redactiemedewerker",
                       5 => "Mediatechnologie",
                       6 => "Audiovisuele Media",
                       7 => "Podium- en evenemententechniek",
                       8 => "Bedrijf");

  //user opleiding id variable
  $opleiding_id = $rij['Opleiding_ID'];
  //naam van de opleiding met spaties eruit voor css classes
  $opleiding_naam = str_replace(' ', '', $opleidingen[$opleiding_id]);

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], $rij['Naam']." ".$rij['Achternaam'], true, false, $bool, $_SESSION['uuid']);

  ?>
    <main>
      <div class="userinfo">
        <h2>><?php echo " ".$rij['Naam']." ".$rij['Achternaam'] ?></h2>
        <em class="<?php echo $opleiding_naam ?>"><?php echo $opleidingen[$opleiding_id] ?></em>
        <div class="about_text">
          <?php echo $rij['About'] ?>
        </div>
        <?php if ($opleiding_naam != "Bedrijf"): ?>
          <h2>> Projecten</h2>
          <div class="projects">
            <?php
            //query om gegevens te krijgen van beide bedrijven en studenten
            $query1 = "SELECT * FROM `project` WHERE `User_ID` = ?";

            if($stmt1 = mysqli_prepare($mysqli, $query1))
            {
              mysqli_stmt_bind_param($stmt1, "s", $uuid);

              if(!mysqli_stmt_execute($stmt1))
              {
                error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
              } else
              {
                $result1 = mysqli_stmt_get_result($stmt1);

                if (mysqli_num_rows($result1) == 0)
                {
                  ?>
                    <p>Je hebt nog geen projecten toegevoegd dat kan hier: </p>
                    <a href="project_toevoegen.php?id=<?php echo $uuid ?>">Project toevoegen</a>
                  <?php
                } else
                {
                  foreach ($result1 as $row)
                  {
                    ?>
                      <a href="project.php?id=<?php echo $row['ID'] ?>">
                        <div class="project">
                          <h3 class="<?php echo $opleiding_naam ?>"><?php echo $row['Titel'] ?></h3>
                          <p class="Omschrijving"><?php echo substr($row['Omschrijving'], 0, 128)."..." ?></p>
                        </div>
                      </a>
                    <?php
                  }
                }
              }
            }
            ?>
          </div>
        <?php endif; ?>
      </div>
    </main>
  <?php

  display_footer();

 ?>
