<?php
 include_once "../dbh/EndUser.inc.php";
  if(isset($_POST['indexButton'])){

    $UserLoginNumberPHP = mysqli_real_escape_string($conn, $_POST['IndexNumber']); //Get input
    require_once '../dbh/EndUser.inc.php';
    require_once 'indexFunction.php';

    //ERROR FOR EMPTY BOX !!!CORRECT!!!!!
    if(EmptyInputIndex($UserLoginNumberPHP)!==false){ //IF TRUE
      header("location: ../login_sections.php?errornumber=empty");
      echo "error1";
      exit();
    }
     if(StringEx($UserLoginNumberPHP)!==false){ // ERROR HANDLERS FOR NOT NUMBERS/INTEGERS
      header("location: ../login_sections.php?errornumber=NotNumbers");
      exit();
    }

    if(WrongLen($UserLoginNumberPHP)!==false){ //ERROR HANDLERS FOR WRONG LENGTH OF NPUTS
      header("location:../login_sections.php?errornumber=wrongLength");
      exit();
    }



    //ERROR FOR INVALID CHARACTERS
    //CHECKING THE DATABASE
    if(CheckNumber($conn,$UserLoginNumberPHP)!== false){ //IF TRUE
      exit();
    }
  echo"stuck";
  };
    //NEED SESSION AND REDIRECT TO OTP-LOGIN
?>
