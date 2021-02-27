<?php
session_start();

if (isset($_POST['chgpwdstd-submit'])) {

  require 'dbh.inc.php';

  $user = $_SESSION['id'];
  $newPassword = $_POST['newpwd'];
  $passwordRepeat = $_POST['newpwd-repeat'];

  if (empty($newPassword) || empty($passwordRepeat)) {
    header("Location: ../pages/forgotstdpwdchange.php?error=emptyfields");
    exit();
  } else if ($newPassword !== $passwordRepeat) {
    header("Location: ../pages/forgotstdpwdchange.php?error=passwordcheck");
    exit();
  } else {
      $sql = "SELECT Password FROM student_employee WHERE WS_ID=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../pages/forgotstdpwdchange.php?error=sqlerror");
        exit();
      } else {
        $sql = "UPDATE student_employee SET Password=? WHERE WS_ID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../pages/forgotstdpwdchange.php?error=sqlerror");
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
          header("Location: ../pages/allstudents.php?pwdchange=success");
          exit();
        }

    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../pages/pwdchangestd.php");
  exit();
}
