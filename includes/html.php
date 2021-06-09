<?php

  /*
    Header function
  */
  function display_header($name = NULL, $title = NULL, $log = FALSE, $inFolder = false, $uuid = NULL)
  {
    ?>
      <!DOCTYPE html>
      <html lang="nl" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title><?php echo $title ?></title>
          <?php if ($inFolder == true): ?>
            <link rel="stylesheet" href="../css/style.css">
          <?php else: ?>
            <link rel="stylesheet" href="css/style.css">
          <?php endif; ?>
        </head>
        <body>
          <img class="logo" src="https://1190327580.rsc.cdn77.org/sites/bd_glr_nl/themes/glr/images/site-logo-2020-v4.png" alt="Logo van GLR">
          <header>
            <h1>Portfoliosite</h1>
            <?php if ($log == true): ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="logout.php">Loguit</a>  <?php echo "for ".$name ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="student.php?id=<?php echo $uuid ?>"><?php echo $name ?></a>
            <?php else: ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="logout.php">Loguit</a>
            <?php endif; ?>
          </header>
    <?php
  }

  /*
    footer function will include external scripts and such
  */

  function display_footer()
  {
    ?>

        </body>
      </html>
    <?php
  }

 ?>
