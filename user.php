<?php

  session_start();

  $uuid = $_GET['id'];

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
  $query = "SELECT * FROM `users`, `user_info` WHERE `UserID` = ?";

  if($stmt = mysqli_prepare($mysqli, $query))
  {
    mysqli_stmt_bind_param($stmt, "s", $uuid);

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
                       7 => "Podium- en evenemententechniek");

  //user opleiding id variable
  $opleiding_id = $rij['Opleiding_ID'];
  //naam van de opleiding met spaties eruit voor css classes
  $opleiding_naam = str_replace(' ', '', $opleidingen[$opleiding_id]);

  display_header($rij['Naam']." ".$rij['Achternaam'], $rij['Naam']." ".$rij['Achternaam'], true, false, $rij['UserID']);

  ?>
    <main>
      <div class="userinfo">
        <h2>><?php echo " ".$rij['Naam']." ".$rij['Achternaam'] ?></h2>
        <em class="<?php echo $opleiding_naam ?>"><?php echo $opleidingen[$opleiding_id] ?></em>
        <div class="about_text">
          <?php echo $rij['About'] ?>
        </div>
        <h2>> Projecten</h2>
      </div>
    </main>
  <?php

  display_footer();

 ?>
