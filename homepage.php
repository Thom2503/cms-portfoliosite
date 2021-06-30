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
  include "php/config.php";

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Homepagina", true, false, $bool, $_SESSION['uuid']);

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  //alle opleidingen om te zoeken naar
  $opleidingen2 = array(1 => "Mediavormgeven" ,
                       2 => "Creative Productie",
                       3 => "Mediamanagement",
                       4 => "Redactiemedewerker",
                       5 => "Mediatechnologie",
                       6 => "Audiovisuele Media",
                       7 => "Podium- en evenemententechniek");

  ?>
    <main>
      <div class="userinfo">
        <h2>> Homepagina</h2>
        <select id="myBtnContainer">
          <option class="btn active" selected onclick="filterSelection('all')">Alle studenten</option>
          <?php foreach ($opleidingen2 as $id): ?>
            <option class="btn" onclick="filterSelection('<?php echo $id ?>')"><?php echo $id ?></option>
          <?php endforeach; ?>
        </select>
        <?php
          //query om gegevens te krijgen van beide bedrijven en studenten
          $query = "SELECT * FROM `users` WHERE `Opleiding_ID` < 8";

          if($stmt = mysqli_prepare($mysqli, $query))
          {

            if(!mysqli_stmt_execute($stmt))
            {
              error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
            } else
            {
              $result = mysqli_stmt_get_result($stmt);

              if ($result)
              {
                foreach ($result as $rij)
                {
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
                  ?>
                  <div class="container">
                    <div class="filterDiv <?php echo $opleiding_naam ?>">
                      <h3><?php echo $rij['Naam']." ".$rij['Achternaam'] ?></h3>
                      <em class="<?php echo $opleiding_naam ?>"><?php echo $opleidingen[$opleiding_id] ?></em>
                    </div>
                  </div>
                  <?php
                }
              } else
              {
                error("Er is iets fout gegaan!");
              }
            }
          }
         ?>
      </div>
    </main>
  <?php

  display_footer();

 ?>
