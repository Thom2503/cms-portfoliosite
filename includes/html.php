<?php

  /*
    Header function
  */
  function display_header($name = NULL, $title = NULL, $log = FALSE, $inFolder = false, $isStudent = false, $uuid = NULL)
  {
    ?>
      <!DOCTYPE html>
      <html lang="nl" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title><?php echo $title ?></title>
          <?php if ($inFolder == true): ?>
            <link rel="stylesheet" href="../css/style.css">
            <script src="../js/toUppercase.js" charset="utf-8"></script>
          <?php else: ?>
            <link rel="stylesheet" href="css/style.css">
            <script src="js/toUppercase.js" charset="utf-8"></script>
          <?php endif; ?>
        </head>
        <body>
          <img class="logo" src="https://1190327580.rsc.cdn77.org/sites/bd_glr_nl/themes/glr/images/site-logo-2020-v4.png" alt="Logo van GLR">
          <header>
            <h1>Portfoliosite</h1>
            <?php if ($log == true): ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="logout.php">> Loguit</a>  <?php echo "for ".$name ?> |
                <?php if ($inFolder == true): ?>
                  <a style="position: relative; font-size: 18px; line-height: 8px;" href="../user.php?id=<?php echo $uuid ?>">> Mijn pagina</a> |
                <?php else: ?>
                  <a style="position: relative; font-size: 18px; line-height: 8px;" href="user.php?id=<?php echo $uuid ?>">> Mijn pagina</a> |
                <?php endif; ?>
                <?php if ($isStudent == true): ?>
                  <a style="position: relative; font-size: 18px; line-height: 8px;" href="project_toevoegen.php?id=<?php echo $uuid ?>">> Project toevoegen</a> |
                <?php endif; ?>
            <?php else: ?>
              <?php if ($inFolder == true): ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="../logout.php">> Loguit</a>
              <?php else: ?>
                <a style="position: relative; font-size: 18px; line-height: 8px;" href="logout.php">> Loguit</a>
              <?php endif; ?>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"
                integrity="sha512-SG4yH2eYtAR5eK4/VL0bhqOsIb6AZSWAJjHOCmfhcaqTkDviJFoar/VYdG96iY7ouGhKQpAg3CMJ22BrZvhOUA=="
                crossorigin="anonymous"
                referrerpolicy="no-referrer"></script>
      </html>
    <?php
  }

 ?>
