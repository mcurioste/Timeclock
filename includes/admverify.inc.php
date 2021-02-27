<?php
session_start();

if(isset($_POST['admverify-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['adm-uid'];
  $password = $_POST['adm-pwd'];

  if (empty($username) || empty($password)) {
    header("Location: ../pages/admverify.php?error=emptyfields");
    exit();
  } else {
    $sql = "SELECT * FROM staff WHERE Username=? OR Email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../pages/admverify.php?error=sqlerror");
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, "ss", $username, $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['Password']);
        if ($pwdCheck == false) {
          header("Location: ../pagesadmverify.php?error=wrongpwd");
          exit();
        } else if ($pwdCheck == true) {
          header("Location: ../pages/forgotstdpwdchange.php?login=success");
          exit();

        } else {
          header("Location: ../pages/admverify.php?error=wrongpwd");
          exit();
        }
      } else {
        header("Location: ../admlogin.php?error=nouser");
        exit();
      }
    }
  }



} else {
  header("Location: ../pages/admverify.php");
  exit();
}
