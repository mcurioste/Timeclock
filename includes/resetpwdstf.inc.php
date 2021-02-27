<?php

if (isset($_POST['reset-submit'])) {

  //This adds a layer of security against timing attacks using 2 tokens
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  //this is url for website
  $url = "localhost/NMHU%20Timeclock/createnewpassword.php?selector=" . $selector . "&validator=" . bin2hex($token);

  $expires = date("U") + 1800;

  require 'dbh.inc.php';

  $userEmail = $_POST['email'];

  $sql = "DELETE FROM Password_Reset WHERE Password_Reset_Email=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../admpassword.php?error=sql");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s" , $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO password_Reset (Password_Reset_Email, Password_Reset_Selector, Password_Reset_Token, Password_Reset_Expires) Values (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../admpassword.php?error=sql");
    exit();
  } else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss" , $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  $to = $userEmail;

  $subject = 'Reset your password';

  $message = '<p>We recieved a password reset request. The link to reset your passwordis below. If you did not make this request, pleace contact your systems admin</p>';
  $message .= '<p>Here is your password reset link: </br>';
  $message .= '<a href="'. $url .'">Please click here</a></p>';

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $header = "From: mcu <mcurioste1@gmail.com>\r\n";
  $header .= "Reply-To: mcurioste1@gmail.com\r\n";
  $header .= "Content-type: text/html\r\n";

  mail($to, $subject, $message, $header);

  header("Location: ../admpassword.php?reset=success");

} else {
  header("Location: ../admpassword.php");
}
