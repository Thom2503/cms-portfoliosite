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

display_header($_SESSION['voornaam'] . " " . $_SESSION['achternaam'], "Projecten verwerken...", true, true, false, $_SESSION['uuid']); //functie voor de rand html, is simpel for mooiheid

?>
<main>
    <?php
    if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
    {
        if (isset($_POST['aanpassen']))
        {
            $titel = htmlspecialchars($_POST['titel'], ENT_QUOTES);
            $omschrijving = htmlspecialchars($_POST['omschrijving'], ENT_QUOTES);
            $userid = htmlspecialchars($_POST['userid'], ENT_QUOTES);
            $uuid = htmlspecialchars($_POST['uuid'], ENT_QUOTES);
            $oldFile = htmlspecialchars($_POST['old'], ENT_QUOTES);
            $oldFilePath = "../uploads/".$oldFile;
            //alle file dingetjes
            $fileTmpPath = $_FILES['bestand']['tmp_name'];
            //naam om verschillen van elkaar te houden
            $fileName = $titel . "-" . $_SESSION['achternaam'] . $_SESSION['achternaam'] . $_FILES['bestand']['name'];
            $filePath = "../uploads/" . $fileName;
            $fileType = $_FILES['bestand']['type'];

            if (!empty($titel) || !empty($omschrijving) || !empty($fileName) || !empty($userid) || !empty($uuid) || !empty($oldFile))
            {
                if (
                    $fileType == 'image/jpg' ||
                    $fileType == 'image/jpeg' ||
                    $fileType == 'image/png' ||
                    $fileType == 'image/gif' ||
                    $fileType == 'video/mp4' ||
                    $fileType == 'application/pdf'
                )
                {
                    //stmt is for updating to the project table.
                    //stmt2 is for updating the media into the media table.
                    $date = date("Y-m-d");

                    $stmt = mysqli_prepare($mysqli, 'UPDATE `project`
                    SET `Titel` = ?,`Omschrijving` = ?,`Datum` = ? WHERE `User_ID` = ? AND `ID` = ?');

                    mysqli_stmt_bind_param($stmt, 'sssss', $titel, $omschrijving, $date, $userid, $uuid);

                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    mysqli_stmt_execute($stmt);

                    // ------------=Dit hier is allemaal stmt2=------------------
                    $stmt2 = mysqli_prepare($mysqli, 'UPDATE `media` SET `Type` = ?,`Name` = ? WHERE `Project_ID` = ?');

                    mysqli_stmt_bind_param($stmt2, 'sss', $fileType, $fileName, $uuid);

                    mysqli_stmt_execute($stmt2);

                    $result2 = mysqli_stmt_get_result($stmt2);

                    mysqli_stmt_execute($stmt2);

                    $uploaded = move_uploaded_file($fileTmpPath, $filePath);
                    $deleted = unlink($oldFilePath);

                    try
                    {
                        if (!$result && !$result2 && $uploaded && $deleted)
                        {

                            mysqli_stmt_close($stmt);

                            mysqli_stmt_close($stmt2);

                            header("location: ../user.php?id=" . $userid);
                        } else
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
                    error("Het bestand wat je probeerde te uploaden word niet geaccepteerd!");
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
