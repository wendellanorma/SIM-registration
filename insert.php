<?php

include_once "dbh.inc.php";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>insert data </title>
    <link rel="stylesheet" href="styles/userlogin1.css">
  </head>
  <body>
<form class="" action="inserNSOBackEnd.php" method="post">
    <table style = "width:100%" class ="input-retail" >
    <h1 class="userlogtext" style="text-align:center">FOR LOCAL NSO/PSA ONLY</h1>
    <tr>
      <th> <input type="text" name="Last" value="" placeholder="LAST NAME"> </th>
      <th> <input type="text" name="First" value="" placeholder="FIRST NAME"> </th>
      <th> <input type="text" name="Mid" value="" placeholder="MIDNAME"> </th>
      <th> <input type="text" name="Suf" value="" placeholder="SUFFIX"> </th>
    </tr>
    <tr>
      <th> <input type="text" name="birth" value="" placeholder="DATE OF BIRTH"> </th>
      <th> <input type="text" name="genr" value="" placeholder="GENDER"> </th>
      <th> <input type="text" name="nso" value="" placeholder="NSONUM"> </th>

    </tr>
    </table>
    <h2 style="text-align:center"><button type="submit" name="SubmitInput" style="">SEND INFORMATION</button></h2>
</form>


<form class="" action="inserNSOBackEnd.php" method="post">
  <table style = "width:100%" class ="input-retail" >
  <h1 class="userlogtext" style="text-align:center">FOR PASSPORTS</h1>
  <tr>
    <th> <input type="text" name="ForLast" value="" placeholder="LAST NAME"> </th>
    <th> <input type="text" name="ForFirst" value="" placeholder="FIRST NAME"> </th>
    <th> <input type="text" name="ForMid" value="" placeholder="MIDNAME"> </th>
    <th> <input type="text" name="ForSuf" value="" placeholder="SUFFIX"> </th>
  </tr>
  <tr>
    <th> <input type="text" name="Forbirth" value="" placeholder="DATE OF BIRTH"> </th>
    <th> <input type="text" name="Forgenr" value="" placeholder="GENDER"> </th>
    <th> <input type="text" name="ForPass" value="" placeholder="PASSNUM"> </th>
    <th> <input type="text" name="Nation" value="" placeholder="NATIONALITY"> </th>

  </tr>
  </table>
  <h2 style="text-align:center"><button type="submit" name="SubmitInputFor" style="">SEND INFORMATION</button></h2>
</form>
  </body>
</html>

<?php


 ?>
