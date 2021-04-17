<?php
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $dbname = "db_indri_ta";

$hostname = "sql6.freemysqlhosting.net";
$username = "sql6406247";
$password = "6ZE8bMC61g";
$dbname = "sql6406247";



$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  echo "Database connection error" . mysqli_connect_error();
}
