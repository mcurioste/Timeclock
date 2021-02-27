<?php

  require 'dbh.inc.php';
  $sql = 'SELECT * FROM staff;';
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if (count($row) == 0){
    header("Location: firsttime.php");
  }
