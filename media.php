<?php

  session_start();

  $name = $_GET['name'];

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
  $query = "SELECT * FROM `media` WHERE `Name` = ?";

  if($stmt = mysqli_prepare($mysqli, $query))
  {
    mysqli_stmt_bind_param($stmt, "s", $name);

    if(!mysqli_stmt_execute($stmt))
    {
      error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
    } else
    {
      $result = mysqli_stmt_get_result($stmt);

      $rij = mysqli_fetch_array($result, MYSQLI_BOTH);
    }

    $fileType = $rij['Type']; // om de filetype te vinden zodat de media goed getoont kan worden.
  }

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Bestand bekijken", true, false, $bool, $_SESSION['uuid']);

  ?>
    <main>
      <div class="project_info">
        <a href="javascript:history.back()">> Terug</a>
        <?php
          if ($fileType == "application/pdf")
          {
            ?>
              <div style="height: 30em;">
                <embed src="uploads/<?php echo $rij['Name'] ?>" type="application/pdf" id="pdf" position="center" width="100%" height="100%">
              </div>
            <?php
          } elseif ($fileType == 'image/jpg' ||
                    $fileType == 'image/jpeg'||
                    $fileType == 'image/png' ||
                    $fileType == 'image/gif')
          {
            ?>
              <br>
              <img style="display: block; margin: 0 auto; width: 30em;" src="uploads/<?php echo $rij['Name'] ?>" alt="Bestand van <?php echo $_SESSION['voornaam'] ?>">
            <?php
          } else
          {
            ?>
              <video src="uploads/<?php echo $rij['Name'] ?>" autoplay>
                Your browser can't support videos
              </video>
            <?php
          }
         ?>
      </div>
    </main>
  <?php

  display_footer();

 ?>
