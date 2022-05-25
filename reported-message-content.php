<?php
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

  <title>Sim Card Registration System</title>
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
  <link rel="stylesheet" href="styles/content-report.css">
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

    <div class="container">
      <div class="row">
        <?php
        require 'includes/dbh.inc.php';

        $repId = $title = mysqli_real_escape_string($conn, $_GET['id']);
        $sentAt = mysqli_real_escape_string($conn, $_GET['sent']);
        $user = mysqli_real_escape_string($conn, $_GET['user']);

        // SELECT STATEMENT
        $sql = "SELECT * FROM report_messages_db WHERE report_id = '$repId' AND sent_at = '$sentAt' AND user_name = '$user';";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);  //checks how many rows are the results


        if($queryResults > 0 ):
          while($row = mysqli_fetch_assoc($result)):
            $repNum = $row['reported_number'];
            $_GET['reportt'] = $repNum;

            // SELECT STATEMENT
            $varReport = $_GET['reportt'];
            // echo $varReport;
            $sqlfind = "SELECT * FROM registered_simusers_db WHERE simnum = '$varReport';";
            $resultfind = mysqli_query($conn, $sqlfind);
            $queryResultsfind = mysqli_num_rows($resultfind);  //checks how many rows are the results

            if($queryResultsfind > 0 ){
              while($rowfind = mysqli_fetch_assoc($resultfind)){
                $repName = $rowfind['lastname'];
                $_GET['repLastname'] = $repName;
                $repFName = $rowfind['firstname'];
                $_GET['repFname'] = $repFName;
                $repgetNum = $rowfind['simnum'];
                $_GET['repNMBR'] = $repgetNum;

                $_GET['repLname'] = $repName.' '.$repFName;


              }
            }else {
              $_GET['repLname']='Nobody. This number is either not registered or does not exist.';

            }


        ?>

        <div class="col-12">
          <div class="infolabels">
            <p class="nameLabel">From: <span class="lightColFont"><?php echo $row['user_name'] ?></span></p>
          </div>
          <div class="infolabels">
            <p class="nameLabel">User's Mobile number: <span class="lightColFont"><?php echo $row['user_mobile_num'] ?></span></p>
          </div>
          <div class="infolabels">
            <p class="nameLabel">Reported Number: <span class="RedColFont"><?php echo $row['reported_number'] ?></span></p>
          </div>
          <div class="infolabels mb-5">
            <p class="nameLabel">According to the database, this reported number belongs to: <span class="RedColFont"> <?php

              echo $_GET['repLname'];

             ?></span></p>
          </div>
          <div class="infolabels">
            <p class="nameLabel">User Remarks</p>
          </div>
          <div class="infolabels mb-5">
            <p class="lighFontOnly"><?php echo $row['remarks'] ?></p>
          </div>
          <div class="infolabels">
            <p class="nameLabel">Sent: <span class="lightColFont"><?php echo $row['sent_at'] ?></span></p>
          </div>


            <div class="row">
              <div class="col-12">
                <button type="button" name="button" class="send-btn replybtn" data-toggle="modal" data-target="#screenshotModal">View Screenshot</button>

                <!-- MODAL PART FOR SCREENSHOT -->
                <div class="modal fade" id="screenshotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reported Message Screenshot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <img class="screenshot-img" src="<?php echo $row['Report_Screenshot'].""    ?>" alt="">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
<?php
endwhile;
else :
  header("Location: Sim_Card_Registration_System_Final_Version/reported-message-content.php?error=noUser");
 endif;
        ?>
      </div>

    </div>

    

</body>
</html>
