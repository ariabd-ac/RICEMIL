<?php
session_start();
include_once "../config/koneksi.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
if (!empty($username) && !empty($fname) && !empty($lname) && !empty($email)  && !empty($password) && !empty($alamat)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
      echo "$email - This email already exist!";
    } else {
      $ran_id = rand(time(), 100000000);
      $lu = "reseller";
      $encrypt_pass = md5($password);
      $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, username, fname, lname, email, password, alamat, level)
                            VALUES ({$ran_id}, '{$username}', '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$alamat}', '{$lu}')");
      // var_dump($insert_query);
      // die;
      if ($insert_query) {
        $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($select_sql2) > 0) {
          $result = mysqli_fetch_assoc($select_sql2);
          $_SESSION['level'] = $result['level'];
          echo "success";
        } else {
          echo "This email address not Exist!";
        }
      } else {
        echo "Something went wrong. Please try again!";
      }
    }
  }
} else {
  echo "$email is not a valid email!";
}
