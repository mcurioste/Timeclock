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
      <a href="index.php" class="header-brand">Donnelly Library</a>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="stdlogin.php">Student Login</a></li>
          <li><a href="admlogin.php">Admin Login</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <div class="back">
        <section class="info-box">
          <h2>Instruction For Admin</h2>
          <p>
            Please input your username/email and password in the provided input
            area. Please make sure that you are a user in the database. Make sure to
            contact your computer admin to create your account. If you are having
            trouble loging in, please contact your computer admin to make sure
            your account still exists and has not expired.
          </p>
        </section>

          <?php
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            if (empty($selector) || empty($validator)) {
              echo "Could not validate your request!";
            } else {
              if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <section class="login-box">
                  <h2>Reset Password</h2>
                  <form class="login" action="includes/resetpwd.inc.php" method="post">
                    <input type="hidden" name="selector" value="<?php echo $selector;?>">
                    <input type="hidden" name="validator" value="<?php echo $validator;?>">
                    <input type="password" name="pwd" placeholder="Enter a new password...">
                    <input type="password" name="pwd-repeat" placeholder="Re-enter password...">
                    <div class="login-button">
                      <button class="reset-button" type="submit" name="reset-pwd-submit">Reset password</button>
                    </div>
                  </form>
                </section>
                <?php
              }
            }
           ?>
      </div>
    </main>
