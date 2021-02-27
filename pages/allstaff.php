<?php
  session_start();
  if (!isset($_SESSION['userId'])){
    header("Location: ../admlogin.php?session=expired");
    unset($_SESSION['id']);
    unset ($_SESSION['fname']);
    unset ($_SESSION['lname']);
    unset ($_SESSION['department']);
    unset ($_SESSION['departmentName']);
    unset ($_SESSION['idNum']);
    unset ($_SESSION['mail']);
    unset ($_SESSION['phone']);
    unset ($_SESSION['username']);
  } else {
    $inactiveTime = 0;
    if(!isset($_SESSION['actionTime'])){
      header("Location: ../admlogin.php?session=expired");
    } else {
      $inactiveTime = time() - $_SESSION['actionTime'];
      $expire = 10 * 60;

      if ($inactiveTime > $expire) {
        session_unset();
        header("Location: ../admlogin.php?session=expired");
      }
    }
  }
$_SESSION['actionTime'] = time();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Donnelly Library</title>
    <meta name="viewport" contect="width-device-width, initial scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleadmin.css">
  </head>

  <body>
    <header>
      <a href="admin.php" class="header-brand">Admin Page</a>
      <nav>
        <ul>
          <li><a href="newstaff.php">New Staff</a></li>
          <li><a href="newstd.php">New Student</a></li>
          <li><a href="allstaff.php">Staff</a></li>
          <li><a href="allstudents.php">Students</a></li>
          <li><a href="timesheet.php">Timesheet</a></li>
        </ul>
        <div class="logout-button">
          <form action="../includes/logout.inc.php" method="post">
            <button class="logout-button" type="submit" name="logout-button">Log Out</button>
          </form>
        </div>
      </nav>
    </header>

    <main>
      <div class="staff-all">
        <form action="../includes/delete-stf.php" method="post">
          <?php
            echo "<h2>Staff Directory</h2>";
            include_once "../includes/allstaff.inc.php";
            if (isset($_GET['error'])){
              if ($_GET['error'] == 'nousers') {
                echo ("<h2>Please select at least one user.</h2>");
              }
            } else if (isset($_GET['edit'])){
              echo ("<h2>Edit Successful!</h2>");
            } else if (isset($_GET['pwdchange'])){
              echo ("<h2>Password change successful!</h2>");
            }
          ?>
        </form>
     </div>
    </main>
