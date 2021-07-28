<?php
session_start();

if(isset($_POST['submit'])){
    $to=$_POST['email'];
    // die($to);
    $subject = "My subject";
    $txt = "Verifikasi Email!";
    $headers = "From: rizalazky97@gmail.com" . "\r\n" .
    "CC: rizalazky26@gmail.com";

    $send=mail($to,$subject,$txt,$headers);

    // die($send);
    if(!$send){
        die(print_r(error_get_last()));
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