<?php
require 'includes/dbh.inc.php';
$sql = "SELECT * FROM report_messages_db";
$result = mysqli_query($conn, $sql);
session_start();
if (empty($_SESSION['AdminEmail'])){
  header("Location: index.php");
  exit();
}
$AdminLName = $_SESSION['AdminLastName'] ;
$AdminFName = $_SESSION['AdminFirstName'];
$AdminEmail = $_SESSION['AdminEmail'];
$AdminPass  = $_SESSION['AdminPassword'];
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
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- CDN CSS FILE BOOTSTRAP VER 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <!-- CUSTOM CSS FILE  -->
  <link rel="stylesheet" href="styles/adminstyle.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>

</head>
  <body>
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="admininbox.php">
            <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
            <span class="brandname">SimCardRegistrationSystem</span>
          </a>

        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


            <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link' href='registered_users_table_admin.php'>Users</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link selected' href='admininbox.php'>Inbox</a>
              </li>

              <li class="nav-item">
                <form class="form-btnn" action="Logout/logoutprocess_Admin.php" method="POST">
                  <button type="submit" name="btn-primary" class="nav-link logbtn">Logout</button>
                </form>
              </li>

              <li class='nav-item'>
                <a class='nav-link selected' style="cursor: context-menu;">Admin: <?php echo "$AdminFName $AdminLName";?></a>
              </li>
            </ul>


        </div>
      </nav>
    </header>

    <div class="row row-table-head" style="padding-bottom: 15px;">
      <div class="col-md-3">
      <p class="header row-head" style="margin-bottom: 0px; align-self: center;">Reported Messages</p>
      </div>

      <div class="col-md-9">
        <form class="form-inline" action="includes/search.php" method="POST">
          <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search" aria-label="Search" name="input-search" >
          <button class="log-button search-btn my-2 my-sm-0" type="submit" name="submit-search">Search</button>
        </form>
      </div>

    </div>


    <table class="table table-striped inboxtable">
      <thead>
        <tr>
          <th class="f-column text-truncate" scope="col">#</th>
          <th class="f-column text-truncate" scope="col">Recipient</th>
          <th class="f-column text-truncate" scope="col">Message</th>
          <th class="f-column text-truncate" scope="col">Date</th>
        </tr>
      </thead>
      <tbody>

        <?php
              while($row = mysqli_fetch_assoc($result)):
        ?>

        <tr class="canHov" onclick="window.location='<?php echo "reported-message-content.php?id=".$row['report_id']."&sent=".$row['sent_at']."&user=".$row['user_name']."";?>';">

          <th scope="row" class="text-truncate"><?php echo $row['report_id']; ?></th>
          <td class="text-truncate"><?php echo $row['user_name']; ?></td>
          <td class="text-truncate"><?php echo $row['remarks']; ?></td>
          <td class="text-truncate"><?php echo $row['sent_at']; ?></td>

        </tr>

      <?php endwhile; ?>


      </tbody>
    </table>
    <!-- </div> -->

    <?php
    // UPDATE ID INCREMENT
  	$update = "SET @num :=0;";
    $resultup = mysqli_query($conn, $update);
    $update = "UPDATE report_messages_db SET report_id = @num := (@num+1);";
    $resultup = mysqli_query($conn, $update);
    $update = "ALTER TABLE report_messages_db AUTO_INCREMENT = 1;";
    $resultup = mysqli_query($conn, $update);


     ?>


</body>

</html>
