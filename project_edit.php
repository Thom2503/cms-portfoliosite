<?php

  session_start();

  $uuid = $_GET['id'];
  $edit = $_GET['e'];

  if ($_SESSION['type'] == 1)
  {
    $bool = true;
  } else
  {
    $bool = false;
    header("location: user.php?id=".$uuid);
  }

  $usage = "";
  //kies wat de actie is die gevoerd gaat worden
  if ($edit == 'edit')
  {
    $usage .= "bewerken";
  } else if($edit == 'delete')
  {
    $usage .= "verwijderen";
  }

  include "includes/html.php";
  include "php/config.php";

  //query om gegevens te krijgen van beide bedrijven en studenten
  $query = "SELECT * FROM `project`, `media` WHERE project.`ID` = ? AND media.`Project_ID` = ?";

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

  display_header($_SESSION['voornaam']." ".$_SESSION['achternaam'], "Bestand ". $usage, true, false, $bool, $_SESSION['uuid']);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  ?>
    <main>
      <?php if ($usage == "bewerken"): ?>
        <form class="form" action="php/project_aanpassen.php" enctype="multipart/form-data" method="post">
          <a href="javascript:history.back()">> Terug</a>
          <h2>> Project aanpassen</h2>
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <input type="hidden" name="userid" value="<?php echo $rij['User_ID']; ?>"/>
          <input type="hidden" name="uuid" value="<?php echo $uuid ?>"/>
          <input type="hidden" name="old" value="<?php echo $rij['Name']; ?>"/>
          <h3>> Titel</h3>
          <input style="width: 300px; height: 50px;" type="text" name="titel" value="<?php echo $rij['Titel'] ?>" required>
          <h3>> Omschrijving</h3>
          <textarea name="omschrijving" rows="8" cols="80" required><?php echo $rij['Omschrijving'] ?></textarea>
          <h3>> Bestand</h3>
          <input class="bestanden" style="width: 300px; height: 50px;" type="file" name="bestand" required/> <span name="old" value="<?=$rij['Name']?>"><?php echo $rij['Name']?></span>
          <div class="hide">Je kan alleen; PNG, JPG, JPEG, GIF, MP4 en PDF toevoegen.</div>
          <input class="submit" type="Submit" name="aanpassen" value="Aanpassen">
        </form>
      <?php else: ?>
        <form class="form" action="php/project_verwijderen.php" enctype="multipart/form-data" method="post">
          <a href="javascript:history.back()">> Terug</a>
          <h2>> Project verwijderen</h2>
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <input type="hidden" name="userid" value="<?php echo $rij['User_ID']; ?>"/>
          <input type="hidden" name="uuid" value="<?php echo $uuid ?>"/>
          <input type="hidden" name="titel" value="<?php echo $rij['Titel']; ?>"/>
          <input type="hidden" name="omschrijving" value="<?php echo $rij['Omschrijving']; ?>"/>
          <input type="hidden" name="old" value="<?php echo $rij['Name']; ?>"/>
          <h3>> Titel</h3>
          <input style="width: 300px; height: 50px;" type="text" name="titel" value="<?php echo $rij['Titel'] ?>" disabled>
          <h3>> Omschrijving</h3>
          <textarea name="omschrijving" rows="8" cols="80" disabled><?php echo $rij['Omschrijving'] ?></textarea>
          <h3>> Bestand</h3>
          <input class="bestanden" style="width: 300px; height: 50px;" type="file" name="bestand" disabled> <span name="old" value="<?=$rij['Name']?>"><?php echo $rij['Name']?></span>
          <div class="hide">Je kan alleen; PNG, JPG, JPEG, GIF, MP4 en PDF toevoegen.</div>
          <input class="submit" type="Submit" name="verwijderen" value="Verwijderen">
        </form>
      <?php endif; ?>
    </main>
  <?php

  display_footer();

 ?>
