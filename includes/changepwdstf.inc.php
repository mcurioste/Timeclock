<?php
session_start();

if (isset($_POST['chgpwdstf-submit'])) {

  require 'dbh.inc.php';

  $user = $_SESSION['id'];
  $passwordCheck = $_SESSION['pwd'];
  $oldPassword = $_POST['oldpwd'];
  $newPassword = $_POST['newpwd'];
  $passwordRepeat = $_POST['newpwd-repeat'];

  if (empty($oldPassword) || empty($newPassword) || empty($passwordRepeat)) {
    header("Location: ../pages/pwdchangestf.php?error=emptyfields");
    exit();
  } else if ($newPassword !== $passwordRepeat) {
    header("Location: ../pages/pwdchangestf.php?error=passwordcheck");
    exit();
  } else {
      $sql = "SELECT Password FROM student_employee WHERE WS_ID=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../pages/pwdchangestf.php?error=sqlerror");
        exit();
      } else {
        $pwdCheck = password_verify($oldPassword, $passwordCheck);
        if ($pwdCheck == false) {
          header("Location: ../pages/pwdchangestf.php?error=pwdwrong");
        } else {
        $sql = "UPDATE staff SET Password=? WHERE Admin_ID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../pages/pwdchangestf.php?error=sqlerror");
          exit();
        } else {
          $hashedPwd = password_hash($newPassword,PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $user);
          mysqli_stmt_execute($stmt);
          unset ($_SESSION['fname']);
          unset ($_SESSION['lname']);
          unset ($_SESSION['department']);
          unset ($_SESSION['departmentName']);
          unset ($_SESSION['idNum']);
          unset ($_SESSION['mail']);
          unset ($_SESSION['phone']);
          unset ($_SESSION['username']);
          unset ($_SESSION['pwd']);
          header("Location: ../pages/allstaff.php?pwdchange=success");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../pages/pwdchangestf.php");
  exit();
}
