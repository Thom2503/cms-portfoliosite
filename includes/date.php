<?php

  function validateDate($d, $f = "Y-m-d H:i:s")
  {
    $dt = DateTime::createFormFormat($f, $d);
    return $dt && $dt->format($f) == $d;
  }

?>
