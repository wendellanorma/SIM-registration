<?php
$url = parse_url("mysql://bb9fcd6313deff:8c9f15bf@us-cdbr-east-05.cleardb.net/heroku_c1df3a5b9bfc854?reconnect=true" ); //getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

if(!$conn){
  die("Connection failed:" . mysqli_connect_error());
}
?>
