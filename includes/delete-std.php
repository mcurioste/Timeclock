<?php
session_start();

if (isset($_POST['delete-std'])){

  require 'dbh.inc.php';

  $delstd = $_POST['del-std'];
  foreach($delstd as $id){
    mysqli_query($conn,"DELETE FROM student_employee WHERE student_employee.WS_ID=".$id);
    mysqli_query($conn,"DELETE FROM timein WHERE timein.WS_ID=".$id);
    mysqli_query($conn,"DELETE FROM timeout WHERE timeout.WS_ID=".$id);
  }
header("Location:../pages/allstudents.php?delete=success");
} else if(isset($_POST['edit-std']) || isset($_POST['chg-pwd-std']) || isset($_POST['forgot-pwd'])) {
  if (count($_POST['del-std']) == 0) {
    header("Location: ../pages/allstudents.php?error=nousers");
  } else if (count($_POST['del-std']) > 1) {
    header("Location: ../pages/allstudents.php?error=toomany");
  } else {
  require 'dbh.inc.php';
  $editStd = implode($_POST['del-std']);
  $sql = 'SELECT * FROM student_employee
          INNER JOIN departments on departments.Department_ID = student_employee.Department_ID
          WHERE student_employee.WS_ID ='.$editStd.';';
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $_SESSION['id'] = $row['WS_ID'];
  $_SESSION['department'] = $row['Department_ID'];
  $_SESSION['departmentName'] = $row['Department_Name'];
  $_SESSION['fname'] = $row['First_Name'];
  $_SESSION['lname'] = $row['Last_Name'];
  $_SESSION['idNum'] = $row['ID_Number'];
  $_SESSION['mail'] = $row['Email'];
  $_SESSION['phone'] = $row['Phone'];
  $_SESSION['username'] = $row['Username'];
  $_SESSION['pwd'] = $row['Password'];
  if (isset($_POST['edit-std'])) {
    header("Location: ../pages/editstd.php");
  } else if (isset($_POST['chg-pwd-std'])) {
    header("Location: ../pages/pwdchangestd.php");
  } else if (isset($_POST['forgot-pwd'])) {
    header("Location: ../pages/admverify.php");
  }
  }
} else {
  header("Location: ../pages/allstudents.php");
}
