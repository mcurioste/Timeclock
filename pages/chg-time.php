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
$select = $_POST['chg-time'];
if (!isset($_SESSION['timeOutRows'][$select][0])){
  $dateIn = $_SESSION['timeInRows'][$select][0];
  $timeIn = $_SESSION['timeInRows'][$select][1];
  $_SESSION['timeIn'] = $_SESSION['timeInRows'][$select][1];
} else {
  $dateIn = $_SESSION['timeInRows'][$select][0];
  $timeIn = $_SESSION['timeInRows'][$select][1];
  $dateOut = $_SESSION['timeOutRows'][$select][0];
  $timeOut = $_SESSION['timeOutRows'][$select][1];
  $_SESSION['timeIn'] = $_SESSION['timeInRows'][$select][1];
  $_SESSION['timeOut'] = $_SESSION['timeOutRows'][$select][1];
}

if (!isset($_SESSION['id'])) {
  header("Location: timesheet.php");
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
      <h2>Edit Time</h2>
      <form class="newstf" action="../includes/chg-time.inc.php" method="post">
        <input type="date" name="dateIn" value="<?php echo($dateIn);?>">
        <input type="time" name="timeIn" value="<?php echo($timeIn);?>">
        <?php
          if (isset($_SESSION['timeOutRows'][$select][0])){
         ?>
        <input type="date" name="dateOut" value="<?php echo($dateOut);?>">
        <input type="time" name="timeOut" value="<?php echo($timeOut);?>">
      <?php } ?>
        <button type="submit" name="editstd-submit">submit</button>
        </div>
      </form>
    </main>
