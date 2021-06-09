<?php

  function getOpleidingen()
  {
    require "php/config.php";

    $sql = "SELECT * FROM opleiding";

    $result = mysqli_query($mysqli, $sql);

    foreach($result as $rs)
    {
      echo "<option value='".$rs['Naam']."'>".$rs['Naam']."</option>";
    }
  }

 ?>
