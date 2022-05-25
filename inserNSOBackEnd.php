<?php

include_once "dbh.inc.php";
if(isset($_POST['indexButton'])){
  $LastN = $_POST['Last'];
  $FirstN = $_POST['First'];
  $MidN = $_POST['Mid'];
  $Suf = $_POST['Suf'];
  $DateBirth = $_POST['birth'];
  $gendr = $_POST['genr'];
  $nson = $_POST['nso'];
  if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: insert.php?ERRORCPNNECTION=ERROR");
      exit();
  }
  $sql = "INSERT INTO nso_dummy_db(lastname, firstname, midname, suffix, dateofbirth, gender, nsonum)
  VALUES (?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_bind_param($stmt,"sssssss",$LastN,$FirstN,$MidN,$Suf,$DateBirth,$gendr,$nson);
  mysqli_stmt_execute($stmt);
  header("Location: insert.php?SUCCESS");
  exit();
}


if(isset($_POST['SubmitInputFor'])){
  $FLastN = $_POST['ForLast'];
  $FFirstN = $_POST['ForFirst'];
  $FMidN = $_POST['ForMid'];
  $FSuf = $_POST['ForSuf'];
  $FDateBirth = $_POST['Forbirth'];
  $Fgendr = $_POST['Forgenr'];
  $ForPass = $_POST['ForPass'];
  $ForNation = $_POST['Nation'];
  if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: insert.php?ERRORCPNNECTION=ERROR");
      exit();
  }
  $sql = "INSERT INTO foreign_passport_db(lastname, firstname, midname, suffix, dateofbirth, gender, passnum, nationality)
  VALUES (?,?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_bind_param($stmt,"ssssssss",$FLastN,$FFirstN,$FMidN,$FSuf,$FDateBirth,$Fgendr,$FPass,$ForNation);
  mysqli_stmt_execute($stmt);
  header("Location: insert.php?SUCCESS");
  exit();
}

?>
