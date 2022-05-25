<?php

 function EmptyInputIndex($UserLoginNumberPHP){ //ERROR IF NO INPUT
   $result;
   if(empty($UserLoginNumberPHP)){
     $result = true;  //CAUSE ERROR
   }else{
     $result = false; //NO ERROR
   }
   return $result;
 };

 function StringEx($UserLoginNumberPHP){  // ERROR HANDLERS FOR NOT NUMBERS/INTEGERS
   $result;
   if (!preg_match('/^[0-9]*$/',$UserLoginNumberPHP)){
     $result = true;
   }else{
     $result = false;
   }
   return $result;
 }

 function WrongLen($UserLoginNumberPHP){ //ERROR HANDLERS FOR WRONG LENGTH OF NPUTS
   $result;
   $length = strlen($UserLoginNumberPHP);
   if(($length)==10){
     $result = false;
   }else{
     $result = true;
   }
   return $result;
 };



//CHECK IF THERE IF THE NUMBER EXIST
 function CheckNumber($conn, $UserLoginNumberPHP){
      $sql = "SELECT*FROM registered_simusers_db WHERE simnum = ?;";
      $stmt = mysqli_stmt_init($conn);
      include_once "../dbh/EndUser.inc.php";
      //CHECK CONNECTION IF WORKING
      if(!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../login_sections.php?errornumber=stmtfailed");
          exit();
      }
      $BUserLoginNumberPHP = "+63". $UserLoginNumberPHP;
      mysqli_stmt_bind_param($stmt,"i", $BUserLoginNumberPHP);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($resultData)){

        //SESSION START FOR USER LOGIN;
          $sql = "SELECT * FROM registered_simusers_db WHERE simnum=?;";
          $stmt              = mysqli_stmt_init($conn);
          if (mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            session_start();
            if($row = mysqli_fetch_assoc($result)){

                $_SESSION['UserLast']        = $row['lastname'];
                $_SESSION['UserFirst']       = $row['firstname'];
                $_SESSION['UserMiddleName']  = $row['midname'];
                $_SESSION['UserSuffix']      = $row['suffix'];
                $_SESSION['UserBirthdate']   = $row['dateofbirth'];
                $_SESSION['UserGender']      = $row['gender'];
                $_SESSION['UserAddress']     = $row['address'];
                $_SESSION['UserNationality'] = $row['nationality'];
                if(($row['nationality']) == 'Filipino'||($row['nationality']) == 'filipino'){
                  $_SESSION['UserType']      = 'Local';
                }else{
                  $_SESSION['UserType']      = 'Foreign';
                }
                $_SESSION['UserSimCard']     = $row['simcard'];
                $_SESSION['UserNumber']      = $row['simnum'];
                $_SESSION['UserRegSite']     = $row['regisite'];
                $_SESSION['UserDatReg']      = $row['dateofregis'];
                $_SESSION['UserTimeReg']     = $row['time'];

            }
            header("location:../profile-user.php");
          }
      }else{
          header("location:../login_sections.php?errornumber=notexist");
      }
  }
?>
