<?php
  function CheckAccount($conn,$SellerLogin,$SellerPass){

    //INITIALIZE COMMANDS
    $sql = "SELECT * FROM seller WHERE selleremail = ? AND sellerpassword = ?;";
    $stmt = mysqli_stmt_init($conn);

    //CHECK CONNECTION IF WORKING
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../login_sections.php?simRetailer=Error");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$SellerLogin,$SellerPass);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
      $password        = $row['sellerpassword'];
      $email           = $row['selleremail'];
      $SellerFirstName = $row['Seller_First_Name'];
      $SellerLastName  = $row['Seller_Last_Name'];
      //CASE SENSITIVE CHECKING
      if (($SellerPass === $password && $SellerLogin === $email)){
          session_start();

          $_SESSION['SellerFirstName'] = $SellerFirstName;
          $_SESSION['SellerLastName']  = $SellerLastName;
          $_SESSION['SellerEmail']     = $email;
          $_SESSION['SellerPassword']  = $password;
          header("location:../register-users-local.php");
      }else{
        header("location:../login_sections.php?simRetailer=invalidpassoremail");
      }
    }else{
      header("location:../login_sections.php?simRetailer=invalidpassoremail");
    }

  }


?>
