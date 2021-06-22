<?php
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $dbname = "db_indri_ta";

$hostname = "localhost";
$username = "rizalazky";
$password = "Margasari2021";
$dbname = "db_indri_ta";
$base_url = "http://localhost/ricemil/";


$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  echo "Database connection error" . mysqli_connect_error();
}
