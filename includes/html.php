<?php

  /*
    Header function
  */
  function display_header($name = NULL, $title = NULL, $log = FALSE)
  {
    ?>
      <!DOCTYPE html>
      <html lang="nl" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title><?php echo $title ?></title>
          <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
          <img class="logo" src="https://1190327580.rsc.cdn77.org/sites/bd_glr_nl/themes/glr/images/site-logo-2020-v4.png" alt="Logo van GLR">
          <header>
            <h1>Portfoliosite</h1>
            <?php if ($log == true): ?>
              <ul style="list-style: none">
                <li> <a href="logout.php">Loguit</a>  <?php echo "for ".$name ?> </li>
              </ul>
            <?php else: ?>
              <ul style="list-style: none">
                <li> <a style="" href="logout.php">Loguit</a> </li>
              </ul>
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
