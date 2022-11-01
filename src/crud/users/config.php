<?php
  $conn = mysqli_connect('MYSQL', 'user', 'password', 'dataDB');

  if ($conn === false) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
?>