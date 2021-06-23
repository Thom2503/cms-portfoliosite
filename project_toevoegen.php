<?php

  session_start();

  $uuid = $_GET['id'];

  if ($_SESSION['type'] == 1)
  {
    $bool = true;
  } else
  {
    $bool = false;
    header("location: user.php?id=".$uuid);
  }

  include "includes/html.php";
  include "php/config.php";

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

  display_header($rij['Naam']." ".$rij['Achternaam'], "Project Toevoegen", true, false, $bool, $rij['UserID']);

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  ?>
    <main>
      <form class="form" action="php/project_toevoegen_verwerk.php" enctype="multipart/form-data" method="post">
        <a href="javascript:history.back()">> TERUG</a>
        <h2>> Project toevoegen</h2>
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
        <input type="hidden" name="userid" value="<?php echo $rij['UserID']; ?>"/>
        <h3>> Titel</h3>
        <input style="width: 300px; height: 50px;" type="text" name="titel" placeholder="Titel" required>
        <h3>> Omschrijving</h3>
        <textarea name="omschrijving" rows="8" cols="80" placeholder="Omschrijving" required></textarea>
        <h3>> Bestand</h3>
        <input class="bestanden" style="width: 300px; height: 50px;" type="file" name="bestand" required>
        <div class="hide">Je kan alleen; PNG, JPG, JPEG, GIF, MP4 en PDF toevoegen.</div>
        <input class="submit" type="Submit" name="toevoegen" value="Project toevoegen">
      </form>
    </main>
  <?php

  display_footer();

 ?>
