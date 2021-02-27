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
  header("Location: allstaff.php");
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
      <h2>Edit Staff</h2>
      <form class="newstf" action="../includes/stfedit.inc.php" method="post">z
        <input type="text" name="fname" value="<?php echo($_SESSION['fname']);?>">
        <input type="text" name="lname" value="<?php echo($_SESSION['lname']);?>">
        <select class="department-stf" name="department">
          <option default value="<?php echo ((int)($_SESSION['department']));?>"><?php echo($_SESSION['departmentName']);?></option>
          <option value="1">Acquisitions</option>
          <option value="2">Administration Office</option>
          <option value="3">Archives</option>
          <option value="4">Cataloging</option>
          <option value="5">Circulation</option>
          <option value="6">External Affairs</option>
          <option value="7">Gallery</option>
          <option value="8">Government Documents</option>
          <option value="9">Interlibrary Loan</option>
          <option value="10">Janitor's office</option>
          <option value="11">Juvinille</option>
          <option value="12">Online</option>
          <option value="13">Periodicals</option>
          <option value="14">Reference</option>
          <option value="15">Technology</option>
        </select>
        <input type="text" name="idnum" value="<?php echo($_SESSION['idNum']);?>">
        <input type="text" name="mail" value="<?php echo($_SESSION['mail']);?>">
        <input type="text" name="phone" value="<?php echo($_SESSION['phone']);?>">
        <input type="text" name="uid" value="<?php echo($_SESSION['username']);?>">
        <button type="submit" name="editstf-submit">submit</button>
        <div class="user-create">
         <?php
           if (isset($_GET['error'])){
             if ($_GET['error'] == 'emptyfields') {
               echo ("<h3>Fields are empty</h3>");
             } else if ($_GET['error'] == 'invaliduid') {
               echo ("<h3>User ID is invalid</h3>");
             } else if ($_GET['error'] == 'passwordcheck') {
               echo ("<h3>Passwords do not match</h3>");
           } else if ($_GET['error'] == 'sqlerror') {
             echo ("<h3>SYSTEM ERROR!</h3>");
           } else if ($_GET['error'] == 'userexists') {
               echo ("<h3>User already exists</h3>");
         }
       }
          ?>
        </div>
      </form>
    </main>
