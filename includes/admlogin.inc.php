<?php
session_start();

if(isset($_POST['admlogin-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['adm-uid'];
  $password = $_POST['adm-pwd'];

  if (empty($username) || empty($password)) {
    header("Location: ../admlogin.php?error=emptyfields");
    exit();
  } else {
    $sql = "SELECT * FROM staff WHERE Username=? OR Email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../admlogin.php?error=sqlerror");
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, "ss", $username, $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['Password']);
        if ($pwdCheck == false) {
          header("Location: ../admlogin.php?error=wrongpwd");
          exit();
        } else if ($pwdCheck == true) {
          $id = $row['Admin_ID'];
          $fname = $row['First_Name'];
          $lname = $row['Last_Name'];
          date_default_timezone_set('America/Denver');
          $currentDate = date("Y-m-d");
          $currentTime = date("H:i");
          $sql = "INSERT INTO staff_login_track (Admin_ID, First_Name, Last_Name, Time, Date)
                  VALUES ('$id', '$fname', '$lname', '$currentTime', '$currentDate');";

          mysqli_query($conn,$sql);

          $_SESSION['userId'] = $row['Admin_ID'];
          $_SESSION['userUid'] = $row['Username'];
          $_SESSION['actionTime'] = time();

          header("Location: ../pages/admin.php?login=success");
          exit();

        } else {
          header("Location: ../admlogin.php?error=wrongpwd");
          exit();
        }
      } else {
        header("Location: ../admlogin.php?error=nouser");
        exit();
      }
    }
  }



} else {
  header("Location: ../admlogin.php");
  exit();
}
