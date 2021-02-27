<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Donnelly Library</title>
    <meta name="viewport" contect="width-device-width, initial scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylelogin.css">
  </head>

  <body>
    <header>
      <div class="first-time-header">
        <h2>NMHU Donnelly Library Timeclock</h2>
      </div>
    </header>

    <main>
      <div class="back">
        <section class="first-time">
          <h2>First time setup</h2>
          <form class="newstf" action="includes/admsignup.inc.php" method="post">
            <input type="text" name="fname" placeholder="First Name">
            <input type="text" name="lname" placeholder="Last Name">
            <select class="department-stf" name="department">
              <option default>Department...</option>
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
            <input type="text" name="idnum" placeholder="ID Number">
            <input type="text" name="mail" placeholder="E-mail">
            <input type="text" name="phone" placeholder="Phone Number">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Re-enter Password">
            <button type="submit" name="newstf-submit">submit</button>
        </section>
      </div>
    </main>
