<?php

include 'config/koneksi.php';
session_start();

if(isset($_POST['submit'])){
    $to=$_POST['email'];
    // die($to);
    $six_digit_random_number = random_int(100000, 999999);
    $subject = "My subject";
    $txt = "Kode Ganti Email = ".$six_digit_random_number;
    $headers = "From: ameliaricemil@gmail.com" . "\r\n" .
    "CC: rizalazky26@gmail.com";

    $queryCheckIfEmailExist="SELECT email FROM users WHERE email='$to'";
    $exec=mysqli_query($conn,$queryCheckIfEmailExist);
    // die(var_dump($exec));
    if(mysqli_num_rows($exec)>0){
        $send=mail($to,$subject,$txt,$headers);
            // die($send);
        if(!$send){
            die(print_r(error_get_last()));
        }else{
            $queryUpdate="UPDATE users SET kode_change_password='$six_digit_random_number' WHERE email='$to'";
            $exUp=mysqli_query($conn,$queryUpdate);
            if(!$exUp){
                die(mysqli_error($conn));
            }
            header('Location: forget_password_form.php?email='.$to);
        }
    }else{
        echo "<script>alert('Email Belum Terdaftar !!')</script>";
    }



}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

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
                        <h6>Email</h6>
                        <input class="username" name="email" type="email" placeholder="Email" />
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