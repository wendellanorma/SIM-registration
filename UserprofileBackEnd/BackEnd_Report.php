<?php
include_once "../dbh/EndUser.inc.php";

if(isset($_POST['reportbutton'])){

  $Reported_Num   = mysqli_real_escape_string($conn, $_POST['ReportedNumber']);
  $Message        = mysqli_real_escape_string($conn, $_POST['Remarks']);  
  $ImageFullName  = mysqli_real_escape_string($conn, $_POST['ImageUrl']);  

  ///////////////////////////////// GETTING END USER INFORMATION USING SESSION /////////////////////////////////
  session_start();
  $SimCardNumber = $_SESSION['UserNumber'] ;
  $LastName      = $_SESSION['UserLast']  ;
  $FirstName     = $_SESSION['UserFirst']  ;
  $Gender        = $_SESSION['UserGender']  ;
  $Birthdate     = $_SESSION['UserBirthdate'];
  $Address       = $_SESSION['UserAddress']  ;
  $Nationality   = $_SESSION['UserNationality'];
  $TypeofUser    = $_SESSION['UserType'] ;
  $DateofRegist  = $_SESSION['UserDatReg'];
  $TimeofReg     = $_SESSION['UserTimeReg'];
  $RegSite       = $_SESSION['UserRegSite'] ;
  $SimCard       = $_SESSION['UserSimCard']  ;
  $UserMiddlename    = $_SESSION['UserMiddleName'];
  $UserSuffix        = $_SESSION['UserSuffix'];
  $UserSuffix_B      = ", ".$UserSuffix;
  $Middle            = substr($UserMiddlename,0,1);
  $Victim_Name       = $LastName.", ".$FirstName." ".$Middle." ".$UserSuffix_B;
  $Victim_Name_B     = $LastName.", ".$FirstName." ".$Middle." ".$UserSuffix;
  $Victim_Image_Name = $LastName."-".$FirstName."_".$Middle;
  $Victim_Num        = $SimCardNumber;
   ///////////////////////////////// GETTING IMAGE DETAILS  /////////////////////////////////
  //getting the file information into $file Array
  $file = $_FILES['file'];
  //getting file details
  $fileName =$file["name"];
  $fileType =$file["type"];
  $fileTempName =$file["tmp_name"]; //temporary name = current name of the file when uploaded to a website
  $fileError =$file["error"]; //if the file is working or not
  $fileSize =$file["size"];

  $allowed = array("jpg","jpeg","png","bmp");
  $fileExt = explode(".",$fileName); //getting file Extension and saving to $fileExt Array. file extension name is at the end of array
  $fileActualExt = strtolower(end($fileExt)); ////changing file extension name at the end of array, to lower case


 /////////////////////////////////////////////////// ERROR HANDLERS ////////////////////////////////////////
                             //////////////////////  TEXT ERRORS   /////////////////////

          if(empty($Reported_Num)){
            header("Location: ../profile-user.php?reportPage&ReportStatus=empty");
            exit();
          }else{
              if(!preg_match('/^[0-9]*$/',$Reported_Num)){ //ERROR HANDLERS FOR NOT INTEGER/NUMBER
                header("Location:../profile-user.php?reportPage&ReportStatus=InvalidFormat");
                exit();
              }else{
                if(empty($Message)){
                  header("Location: ../profile-user.php?reportPage&ReportStatus=NoMessage");
                }else{
                $numbercount = strlen($Reported_Num);
                if($numbercount == 10){  //ERROR HANDLERS FOR INCORRECT DIGITS/CHARACTERS LENGTH


                  //enter image error handlers
                  //////////////////////  IMAGE ERRORS  /////////////////////
                  if(0){   //ERROR 404 for no file added
                    header("Location:../profile-user.php?reportPage&ReportStatus=imageempty");
                    exit();
                  }else{
                    if(1){   //IF FILE IS JPG,PNG,JPEG
                          if(1){                  //IF FILE HAS A PROBLEM
                              if(1){              // IF FILE SIZE IS NOT LARGE
                  //////////////////////////////////////// INITIALIZING THE INPUTS TO DATABASE  ////////////////////////////////////////
                  //Check how many items are there in Database
                              $sql  = "SELECT * FROM report_messages_db;";
                              $stmt = mysqli_stmt_init($conn);
                              if(!mysqli_stmt_prepare($stmt,$sql)){  //ERROR 404 for connection database error
                                  header("Location:../profile-user.php?reportPage&ReportStatus=imagedatabaseerror");
                              }else{
                                  mysqli_stmt_execute($stmt); //execute
                                  $result   = mysqli_stmt_get_result($stmt);

                                    //Getting Database Row Information
                                  $rowCount = mysqli_num_rows($result);
                                  $setImageOrder   = $rowCount + 1;  //getting how many rows and adding +1. that would be the for the image report

                                  //////Reconfiguring Image File and Format////////
                                  $Name_ReportImage = $Victim_Image_Name."."."ReportNumber_".$setImageOrder; //New File Name of the Image - example of format: TanishaBrown.ReportNumber_1
                                  // $ImageFullName    = $Name_ReportImage.".".$fileActualExt;                  //Complete Fille Name of the Image - example of format: TanishaBrown.ReportNumber_1.jpg
                                  // $fileDestination  = "../Image_Report_Database/".$ImageFullName;            //Build up file destination
                                  date_default_timezone_set('Asia/Manila');
                                  $dates = date("Y")."-".date("m")."-".date("j");
                                  $time = date('G').":".date('i').":".date('s');
                                  $DateTime = $dates." ".$time;
                                  //Preparing Query for Inserting Data in the Database
                                  $sql = "INSERT INTO report_messages_db(user_mobile_num, user_name, reported_number, remarks, Report_Screenshot, Report_ScreenshotName,sent_at)
                                          VALUES(?,?,?,?,?,?,?);";

                                  if(!mysqli_stmt_prepare($stmt,$sql)){ //ERROR 404 for unable to upload
                                      header("Location:../profile-user.php?reportPage&ReportStatus=uploaderror");
                                  }else{
                                      $Reported_Num = "+63". $Reported_Num;
                                      //uploading the Data
                                      mysqli_stmt_bind_param($stmt,"sssssss",$Victim_Num,$Victim_Name_B,$Reported_Num,$Message,$ImageFullName,$Name_ReportImage,$DateTime);
                                      mysqli_stmt_execute($stmt); //FILE SENT
                                      // move_uploaded_file($fileTempName,$fileDestination); //moving the file
                                      // UPDATE ID INCREMENT
                                      $update = "SET @num :=0;";
                                      $resultup = mysqli_query($conn, $update);
                                      $update = "UPDATE report_messages_db SET report_id = @num := (@num+1);";
                                      $resultup = mysqli_query($conn, $update);
                                      $update = "ALTER TABLE report_messages_db AUTO_INCREMENT = 1;";
                                      $resultup = mysqli_query($conn, $update);


                                      header("Location:../profile-user.php?reportPage&ReportStatus=success");
                                    }
                                  }
                                }else{
                                  header("Location:../profile-user.php?reportPage&ReportStatus=imagelarge");
                                  exit();
                                }
                              }else{
                                header("Location:../profile-user.php?reportPage&ReportStatus=imageerror");
                                exit();
                              }
                            }else{
                              header("Location:../profile-user.php?reportPage&ReportStatus=imageformaterror");
                              exit();
                            }
                          }
                        }else{
                          header("Location:../profile-user.php?reportPage&ReportStatus=numberlength");
                          exit();
                        } //line 123 end
                      }
                      } //line 62 end
                     // line 58 end
                  } // line 53 end
        }  //line 4 end
?>
