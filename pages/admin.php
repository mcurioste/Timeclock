<?php
  session_start();
  if (!isset($_SESSION['userId'])){
    header("Location: ../admlogin.php?session=expired");
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
      <h2>Admin Page</h2>
      <p>
        1) This page is for administration use only. To ensure security, the admins is the computer technician, work study supervisors, and head of each department.
      </p>
      <p>
        2) If you see anyone using this website without supervisor permission then contact your computer technician to ensure there is no security breaches.
      </p>
      <p>
        3) When creating a new user, ensure the email that they are using is valid.
      </p>
      <p>
        4) If there are any suspicions that someone unathorized got into the admin page, please contact your computer technician and check the login sheet found in the admin directory.
      </p>
      <p>
        5)Only access this site if necessary and before you walk away from the computer, make sure to logout.
      </p>
    </main>
