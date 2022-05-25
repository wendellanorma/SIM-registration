<?php

if(isset($_POST['button'])){

  require 'dbh.inc.php';

  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $midname = $_POST['midname'];
  $suffix = $_POST['suffix'];
  $dateofbirth = date('Y-m-d', strtotime($_POST['dateofbirth']));
  $gender = $_POST['Gender'];
  $passnum = $_POST['passnum'];
  $nationality = $_POST['nationality'];
  $simnum = $_POST['simnum'];
  $regisite = $_POST['regisite'];
  $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis']));


  $sqlnso = "SELECT simnum FROM registerforeign WHERE simnum = $simnum";
  $result = mysqli_query($conn, $sqlnso);
  $resultsCheck = mysqli_num_rows($result);
  if($resultsCheck == 1){
    header("Location: ../seller-register-foreign.html?error=simnum-already-exist");
  }

  else {
    $sql = "INSERT INTO registerforeign (lastname, firstname, midname, suffix, dateofbirth, gender, passnum, nationality, simnum,regisite,dateofregis)
    VALUES (?,?,?,?,?,?,?,?,?,?,?);";
    // PREPARED STATEMENT
    $stmt = mysqli_stmt_init($conn);

    // PREPARE THE PREPARE STATEMENT
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL statement failed";
    }else{
      // BIND PARAMETER TO THE PLACEHOLDER
      mysqli_stmt_bind_param($stmt,"ssssssisiss",  $lastname, $firstname, $midname, $suffix, $dateofbirth, $gender, $passnum, $nationality, $simnum, $regisite, $dateofregis);

      // RUN PARAMETER INDSIDE DATABASE
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      header("Location: ../seller-register-foreign.html?signup=success");
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}





  /*if (empty($lastname) || empty($firstname) || empty($midname) || empty($suffix) || empty($dateofbirth) || empty($gender)
 || empty($nsonum) ||empty($address)  || empty($simcard) || empty($simnum)  || empty($regisite)){
    header("Location: ../seller-register-local.html?error=emptyfields&lastname=" .$lastname. "&firstname=".$firstname);
    exit();
  }
  // titignan sa database kung may same name
  else {
    $sql = "SELECT lastname FROM register WHERE lastname=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../seller-register-local.html?error=sqlerroe");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt,"ssssssisiis",  $lastname, $firstname, $midname, $suffix, $dateofbirth, $gender, $nsonum, $address, $simcard, $simnum, $regisite );
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0){
        header("Location: ../seller-register-local.html?error=usertaken&lastname=" .$lastname. "&firstname=" .$firstname);
        exit();
      }
      else {
        $sql = "INSERT INTO register (lastname, firstname, midname, suffix, dateofbirth, gender, nsonum, address, simcard, simnum, regisite)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../seller-register-local.html?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt,"ssssssisiis",  $lastname, $firstname, $midname, $suffix, $dateofbirth, $gender, $nsonum, $address, $simcard, $simnum, $regisite );
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          header("Location: ../seller-register-local.html?register=success");
          exit();
        }
      }
    }

  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);*/
