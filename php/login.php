<?php
session_start();
include_once "../config/koneksi.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($username) && !empty($password)) {
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $user_pass = md5($password);
    $enc_pass = $row['password'];
    if ($user_pass === $enc_pass) {
      $_SESSION['level'] = $row['level'];
      if ($_SESSION['level'] == 'reseller') {
        $_SESSION['unique_id'] = $row['unique_id'];
        echo "reseller";
      } else if ($_SESSION['level'] == 'admin') {
        $_SESSION['unique_id'] = $row['unique_id'];
        echo "admin";
      } else if ($_SESSION['level'] == 'gudang') {
        $_SESSION['unique_id'] = $row['unique_id'];
        echo "gudang";
      } else if ($_SESSION['level'] == 'supplier') {
        $_SESSION['unique_id'] = $row['unique_id'];
        echo "supplier";
      }
    } else {
      echo "Email or Password is Incorrect!";
    }
  } else {
    echo "$username - This email not Exist!";
  }
} else {
  echo "All input fields are required!";
}
