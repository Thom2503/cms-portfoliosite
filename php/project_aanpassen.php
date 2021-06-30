<?php
session_start();

if ($_SESSION['type'] != 1) {
    header("location: user.php?id=" . $_SESSION['uuid']);
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
    echo $message . "<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
}

$uuid = uuidv4(); //uuid voor een unique id. Komt van uuid.php

display_header($_SESSION['voornaam'] . " " . $_SESSION['achternaam'], "Projecten verwerken...", true, true, false, $_SESSION['uuid']); //functie voor de rand html, is simpel for mooiheid

?>
<main>
    <?php
    if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token']) {
        if (isset($_POST['toevoegen'])) {
            $titel = htmlspecialchars($_POST['titel'], ENT_QUOTES);
            $omschrijving = htmlspecialchars($_POST['omschrijving'], ENT_QUOTES);
            $userid = htmlspecialchars($_POST['userid'], ENT_QUOTES);
            //alle file dingetjes
            $fileTmpPath = $_FILES['bestand']['tmp_name'];
            //naam om verschillen van elkaar te houden
            $fileName = $titel . "-" . $_SESSION['achternaam'] . $_SESSION['achternaam'] . $_FILES['bestand']['name'];
            $filePath = "../uploads/" . $fileName;
            $fileType = $_FILES['bestand']['type'];

            if (!empty($titel) || !empty($omschrijving) || !empty($fileName) || !empty($userid)) {
                if (
                    $fileType == 'image/jpg' ||
                    $fileType == 'image/jpeg' ||
                    $fileType == 'image/png' ||
                    $fileType == 'image/gif' ||
                    $fileType == 'video/mp4' ||
                    $fileType == 'application/pdf'
                ) {
                    //stmt is for adding to the project table.
                    //stmt2 is for adding the media into the media table.

                    $stmt = mysqli_prepare($mysqli, 'INSERT INTO `project`(`ID`, `Titel`, `Omschrijving`, `Datum`, `User_ID`)
                VALUES (?,?,?,?,?)');

                    mysqli_stmt_bind_param($stmt, 'sssss', $uuid, $titel, $omschrijving, date("Y-m-d"), $userid);

                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    mysqli_stmt_execute($stmt);

                    // ------------=Dit hier is allemaal stmt2=------------------
                    $stmt2 = mysqli_prepare($mysqli, 'INSERT INTO `media`(`Type`, `Name`, `Project_ID`)
                VALUES (?,?,?)');

                    mysqli_stmt_bind_param($stmt2, 'sss', $fileType, $fileName, $uuid);

                    mysqli_stmt_execute($stmt2);

                    $result2 = mysqli_stmt_get_result($stmt2);

                    mysqli_stmt_execute($stmt2);

                    $uploaded = move_uploaded_file($fileTmpPath, $filePath);

                    try {
                        if (!$result && !$result2 && $uploaded) {

                            mysqli_stmt_close($stmt);

                            mysqli_stmt_close($stmt2);

                            header("location: ../user.php?id=" . $userid);
                        } else {
                            // error message om er in te zetten
                            $error_message = $date . " Fout met het verbinden met de database\n";
                            // de daadwerkelijke error in het log file zetten
                            error_log($error_message, 3, $log_file);
                            throw new Exception(error('Sorry voor het ongemak er kan momenteel geen verbinding met de database gemaakt worden.'));
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    error("Het bestand wat je probeerde te uploaden word niet geaccepteerd!");
                }
            } else {
                error("Sommige velden zijn leeg gelaten!");
            }
        }
    } else {
        error("CRSF Token is incorrect!");
    }
    ?>
</main>
<?php

display_footer();

?>