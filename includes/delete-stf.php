<?php
session_start();

if (isset($_POST['delete-stf'])){

  require 'dbh.inc.php';

  $delstf = $_POST['del-stf'];
  foreach($delstf as $id){
    mysqli_query($conn,"DELETE FROM staff WHERE staff.Admin_ID=".$id);
  }
header("Location:../pages/allstaff.php?delete=success");
} else if(isset($_POST['edit-stf']) || isset($_POST['chg-pwd-stf'])) {
  if (count($_POST['del-stf']) == 0) {
    header("Location: ../pages/allstaff.php?error=nousers");
  } else if (count($_POST['del-stf']) > 1) {
    header("Location: ../pages/allstaff.php?error=toomany");
  } else {
  require 'dbh.inc.php';
  $editStf = implode($_POST['del-stf']);
  $sql = 'SELECT * FROM staff
          INNER JOIN departments on departments.Department_ID = staff.Department_ID
          WHERE staff.Admin_ID ='.$editStf.';';
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $_SESSION['id'] = $row['Admin_ID'];
  $_SESSION['department'] = $row['Department_ID'];
  $_SESSION['departmentName'] = $row['Department_Name'];
  $_SESSION['fname'] = $row['First_Name'];
  $_SESSION['lname'] = $row['Last_Name'];
  $_SESSION['idNum'] = $row['ID_Number'];
  $_SESSION['mail'] = $row['Email'];
  $_SESSION['phone'] = $row['Phone'];
  $_SESSION['username'] = $row['Username'];
  $_SESSION['pwd'] = $row['Password'];


  if (isset($_POST['edit-stf'])) {
    header("Location: ../pages/editstf.php");
  } else if (isset($_POST['chg-pwd-stf'])) {
    header("Location: ../pages/pwdchangestf.php");
  }
  }
} else if (isset($_POST['show-login'])) {
  header("Location: ../pages/showlogin.php");
} else {
  header("Location: ../pages/allstaff.php");
}
