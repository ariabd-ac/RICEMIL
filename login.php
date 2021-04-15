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
      <img src="./assets/img/icLogin.svg" alt="login" class="img-login animate__animated animate__fadeInUp" />
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="content-register animate__animated animate__fadeInLeft">
          <div class="register-row-top">
            <h6>Username</h6>
            <input class="username" name="username" type="text" placeholder="Username" />
          </div>
          <div class="register-row">
            <h6>Password</h6>
            <input class="username" name="password" type="password" placeholder="Masukan password" />
          </div>
        </div>
        <div class="pwd animate__animated animate__fadeInLeft">
          <div class=""></div>
          <a href="#" class="forget-pwd">Fotget password</a>
        </div>
        <div class="content-bottom animate__animated animate__fadeInRight">
          <button type="submit">Sign</button>
          <h4>Not yet signed up?<a href="ricemil/register"> Sign up</a></h4>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="./assets/js/login.js"></script>

</html>