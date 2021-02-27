<?php
  session_start();
  require 'dbh.inc.php';


  $dateIn = $_POST['dateIn'];
  $timeIn = $_POST['timeIn'];
  $dateOut = $_POST['dateOut'];
  $timeOut = $_POST['timeOut'];


  $ti = $_SESSION['timeIn'];
  $to = $_SESSION['timeOut'];
  $id = $_SESSION['id'];

  echo($dateIn.' '.$timeIn.' '.$id. ' '.$ti);
  $sql = "UPDATE timein SET Date='$dateIn', Time_In='$timeIn' WHERE WS_ID='$id' AND Time_In='$ti';";
  mysqli_query($conn,$sql);

  $sql = "UPDATE timeout SET Date='.$dateOut.', Time_Out='.$timeOut.' WHERE WS_ID=.'$id.' AND Time_Out='.$to.';";
  mysqli_query($conn,$sql);

  header("Location: ../pages/timesheet.php?chg=success");
