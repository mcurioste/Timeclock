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
      <h2>Staff Login</h2>
      <div class="staff-all">
      <?php
        require '../includes/dbh.inc.php';
        $sql = "SELECT * FROM staff_login_track;";
        $result = mysqli_query($conn,$sql);
          echo "<table>";
            echo "<tr>";
              echo "<th>Admin ID</th>";
              echo "<th>First Name</th>";
              echo "<th>Last Name</th>";
              echo "<th>Time</th>";
              echo "<th>Date</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($result)){
              printf ("<tr> <td>%s</td> <td>%s</td>
              <td>%s</td> <td>%s</td> <td>%s</td></tr>",
              $row['Admin_ID'],$row['First_Name'],$row['Last_Name'],$row['Time'],
              $row['Date']);
            }
                    echo "</table>";

      ?>
    </div>
    </main>
