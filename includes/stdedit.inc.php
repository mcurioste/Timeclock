<?php

if (isset($_POST['editstd-submit'])) {
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
    header("Location: ../pages/editstd.php?error=emptyfields");
    exit();
  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../pages/editstd.php?error=invaliduid");
    exit();
  }  else {
        $sql = "UPDATE student_employee SET Department_ID=?, First_Name=?, Last_Name=?,
                ID_Number=?, Phone=?, Email=?, Username=? WHERE WS_ID=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../pages/editstd.php?error=sqlerror");
          exit();
        } else {
          $user = $_SESSION['id'];
          echo($_POST['fname']);
          mysqli_stmt_bind_param($stmt, "isssssss", $department, $firstName, $lastName, $userID, $phone, $email, $username, $user);
          mysqli_stmt_execute($stmt);
          unset($_SESSION['id']);
          unset ($_SESSION['fname']);
          unset ($_SESSION['lname']);
          unset ($_SESSION['department']);
          unset ($_SESSION['departmentName']);
          unset ($_SESSION['idNum']);
          unset ($_SESSION['mail']);
          unset ($_SESSION['phone']);
          unset ($_SESSION['username']);
          header("Location: ../pages/allstudents.php?edit=success");
          exit();
        }
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }else {
      header("Location: ../pages/editstd.php");
      exit();
    }


  // This create more security but not needed for my project. It checks for valid email
  // else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
  //   header("Location: ../newstaff.php?error=invalidmail")
  //   exit();
  // }
