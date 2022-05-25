<?php
    // require_once('vendor/autoload.php');

    // use Dotenv\Dotenv as DotEnvC;

    // $dotenv = DotEnvC::createImmutable(__DIR__);
    // $dotenv->safeLoad();
    session_start();
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
  <link rel="stylesheet" href="styles/main.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>
</head>

<body>

  <header>
    <!-- NAVBAR -->
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="32" height="30" class="d-inline-block align-top img-logo" alt="SRS logo">
        <span class="ml-3 brand-logo">SimCardRegistrationSystem</span>
      </a>

    </nav>

    <!-- DIVIDER SHAPE -->
    <div class="custom-shape-divider-top-1646463469">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200,0H0V120H281.94C572.9,116.24,602.45,3.86,602.45,3.86h0S632,116.24,923,120h277Z" class="shape-fill"></path>
        </svg>
    </div>
  </header>


<!-- SECOND DIVIDER -->
<div class="custom-shape-divider-bottom-1646463762">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<!-- CONTAINER PART -->
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="head1">
        <h1>View your mobile registration details here.</h1>
      </div>
      <div class="sub-text mt-4">
        <h3>Report anonymous users who are sending harmful and malicious messages.</h3>
      </div>
      <!-- button -->
      <div class="button-div">
        <a class="" href="login_sections.php"><button type="button" name="button" class="btn-verify">LOGIN HERE</button></a>
      </div>
    </div>

    <div class="col-md-6 photo-col">
      <div class="svg-div">
        <img src="images/check-phone.svg" alt="" class="svg-verphone" width="500px">
      </div>

    </div>
  </div>

  </div>

</div>
</body>

</html>
