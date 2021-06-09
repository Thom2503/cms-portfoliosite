<?php

  $db_host = 'localhost';
  $db_naam = 'root';
  $db_pass = '';
  $db_db = 'cms';

  //login gegevens


  error_reporting(E_ERROR | E_PARSE );

  $mysqli = mysqli_connect($db_host, $db_naam, $db_pass, $db_db);

?>
