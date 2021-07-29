<?php

include 'config/koneksi.php';
session_start();
$email=$_GET['email'];
if(isset($_POST['submit'])){
    $newPassword=md5($_POST['password']);
    $kode=$_POST['kode'];

    $check="SELECT * FROM users WHERE kode_change_password='$kode' AND email='$email'";

    $exec=mysqli_query($conn,$check);

    if(mysqli_num_rows($exec) > 0){
        $qUpdatePw="UPDATE users SET password='$newPassword',kode_change_password=NULL WHERE email='$email'";

        $execUdatePw=mysqli_query($conn,$qUpdatePw);

        die($execUdatePw);
    }else{
        die($email." && ".$kode);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ganti Password</title>

    <link rel="stylesheet" href="./assets/css/login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="">
    <div class="background">
        <div class="content">
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="content-register animate__animated animate__fadeInLeft">
                    <div class="register-row-top">
                        <h6>New Password</h6>
                        <input class="username" name="password" type="password" placeholder="new password" />
                        <h6>Kode</h6>
                        <input class="username" name="kode" type="text" placeholder="kode yang dikirim ke email" />
                    </div>
                </div>
                
                <div class="content-bottom animate__animated animate__fadeInRight">
                    <button type="submit" name="submit">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>