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
if (!isset($_SESSION['id'])) {
  header("Location: allstudents.php");
}
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
      <h2>Change Staff's Password</h2>
      <form class="newstf" action="../includes/changepwdstf.inc.php" method="post">
        <input type="password" name="oldpwd" placeholder="Please enter old password...">
        <input type="password" name="newpwd" placeholder="Please enter new password...">
        <input type="password" name="newpwd-repeat" placeholder="Please enter password again...">
        <button type="submit" name="chgpwdstf-submit">submit</button>
        <div class="user-create">
         <?php
           if (isset($_GET['error'])){
             if ($_GET['error'] == 'emptyfields') {
               echo ("<h3>Fields are empty</h3>");
             } else if ($_GET['error'] == 'passwordcheck') {
               echo ("<h3>Passwords do not match</h3>");
           } else if ($_GET['error'] == 'sqlerror') {
             echo ("<h3>SYSTEM ERROR!</h3>");
           } else if ($_GET['error'] == 'pwdwrong') {
             echo ("<h3>Wrong old password</h3>");
           }
       }

          ?>
        </div>
      </form>
    </main>
