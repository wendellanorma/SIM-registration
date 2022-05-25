<?php
  include_once '../dbh/Admin_Seller.inc.php';
  if(isset($_POST['sellerbutton'])){

    $SellerLogin = mysqli_real_escape_string($conn, $_POST['selleremail']);
    $SellerPass = mysqli_real_escape_string($conn,  $_POST['sellerpassword']);

    require_once '../dbh/Admin_Seller.inc.php';
    require_once 'sellerFunction.php';

    //CHECK IF INPUTS ARE EMPTY
    if(empty($SellerLogin)||empty($SellerPass)){
       header("Location: ../login_sections.php?simRetailerempty&selleremail=$SellerLogin");
       echo "error 1";
       exit();
     }else{
    //CHECK EMAIL IF VALID USING FILTER
       if(!filter_var($SellerLogin, FILTER_VALIDATE_EMAIL)){
         echo "error 3";
          header("Location: ../login_sections.php?simRetailer=invalidEmail&selleremail=$SellerLogin");
          exit();
       }else{
         //SENDING DATA
          if(CheckAccount($conn,$SellerLogin,$SellerPass)){
            echo "error5";
              exit();
          }
       }
     }
   }
