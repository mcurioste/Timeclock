<?php

if (isset($_POST['editstf-submit'])) {
  session_start();
  require 'dbh.inc.php';

  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $department = $_POST['department'];
  $userID = $_POST['idnum'];
  $email = $_POST['mail'];
  $phone = $_POST['phone'];
  $username = $_POST['uid'];

  if (empty($firstName) || empty($lastName) || empty($department) || empty($userID) || empty($email) || empty($phone) || empty($username)) {
    header("Location: ../pages/editstf.php?error=emptyfields");
    exit();
  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../pages/editstf.php?error=invaliduid");
    exit();
  }  else {
        $sql = "UPDATE staff SET Department_ID=?, First_Name=?, Last_Name=?,
                ID_Number=?, Phone=?, Email=?, Username=? WHERE Admin_ID=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../pages/editstf.php?error=sqlerror");
          exit();
        } else {
          $user = $_SESSION['id'];
          mysqli_stmt_bind_param($stmt, "isssssss", $department, $firstName, $lastName, $userID, $phone, $email, $username, $user);
          mysqli_stmt_execute($stmt);
          unset ($_SESSION['fname']);
          unset ($_SESSION['lname']);
          unset ($_SESSION['department']);
          unset ($_SESSION['departmentName']);
          unset ($_SESSION['idNum']);
          unset ($_SESSION['mail']);
          unset ($_SESSION['phone']);
          unset ($_SESSION['username']);
          header("Location: ../pages/allstaff.php?edit=success");
          exit();
        }
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }else {
      header("Location: ../pages/editstf.php");
      exit();
    }


  // This create more security but not needed for my project. It checks for valid email
  // else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
  //   header("Location: ../newstaff.php?error=invalidmail")
  //   exit();
  // }
