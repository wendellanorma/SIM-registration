<?php
  function CheckAccount($conn,$adminLogin,$adminPass){

    //INITIALIZE COMMANDS
    $sql = "SELECT * FROM admin WHERE admin_email = ? AND admin_pwd = ?;";
    $stmt = mysqli_stmt_init($conn);

    //CHECK CONNECTION IF WORKING
      if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../login_sections.php?adminLogin=Error");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$adminLogin,$adminPass);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
      $password       = $row['admin_pwd'];
      $email          =   $row['admin_email'];
      $AdminFirstName = $row['Admin_First_Name'];
      $AdminLastName  = $row['Admin_Last_Name'];

      //CASE SENSITIVE CHECKING
      if (($adminPass === $password && $adminLogin === $email)){
        session_start();
        $_SESSION['AdminEmail']     = $email;
        $_SESSION['AdminFirstName'] = $AdminFirstName;
        $_SESSION['AdminLastName']  = $AdminLastName;
        $_SESSION['AdminPassword']  = $password;
        header("location:../admininbox.php");
      }else{
        header("location:../login_sections.php?adminLogin=invalidpassoremail");
      }

    }else{
      header("location:../login_sections.php?adminLogin=invalidpassoremail");
    }

  }


?>
