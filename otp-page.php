<?php
  session_start();
  if (empty($_SESSION['UserNumber'])){
    header("Location: index.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

  <title>SimCardRegistrationSystem</title>
  <!-- LOGO ON TAB -->
  <link rel="icon" href="images/logo.png">
  <!-- GOOGLE FONTS -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- CDN CSS FILE BOOTSTRAP VER 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- CUSTOM CSS FILE  -->
  <link rel="stylesheet" href="styles/otpstyle.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
  <!-- <div class="container-fluid bg"> -->
    <div class="row">
      <div class="col-md-6 firstcol text-center">
        <!--COL 1 LOGO PART-->
        <div class="logo">
          <div class="brand-part">
            <img src="images/logo.png" alt="logo" class="img-fluid logopic">
            <p class="par mt-3">SimCardRegistrationSystem</p>
          </div>

          <img src="images/login.svg" width="300px" class="svg-login">
        </div>
      </div>

      <div class="col-md-6 secondcol">
        <!--COL 2 LOGIN FORM-->
<div class='div-for-retail'>

          <form action='seller-register-local.html' method='post' class='form-retail'>

          <p class='userlogtext'>ENTER OTP</p>
          <input type='text' name='otpName' id='otpnum' class='input-retail' placeholder='Enter the OTP sent to your mobile number' required>
          <button type='Submit' name='button' class='btn'>Submit</button>


<!-- DISREGARD THIS PART , THIS PART IS HIDDEN FOR THIS PAGE -->
          <div class='edit-margin links-users'>
          <a href='login_sections.php' class='aF'>
          <p class='simuser-type'>Sim User</p>
          </a>
          <a href='login_sections.php?simRetailer' class='aF'>
          <p class=''>Sim Retailer</p>
          </a>
          <a href='login_sections.php?adminLogin'>
            <p class=''>Administrator</p>
          </a>

          </div>

          </form>

          </div>
        </div>
      </div>


    </div>

  <script src="./sim-registration-otp/Otp.js"></script>

</body>
</html>
