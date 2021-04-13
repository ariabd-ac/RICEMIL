<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="./assets/css/register.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="background">
    <!-- <h3>Register</h3> -->
    <div class="content">
      <div class="img">
        <div class=""></div>
        <img src="./assets/img/ICRegister.svg" alt="Register" />
      </div>
      <!-- <div class="register-content"> -->
      <!-- <h3>Register</h3> -->
      <div class="card-register">
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
          <div class="card-top">
            <h3>Register</h3>
            <div class="register-row">
              <h6>First Name</h6>
              <input name="fname" type="text" placeholder="Masukan password" />
            </div>
            <div class="register-row">
              <h6>Last Name</h6>
              <input name="lname" type="text" placeholder="Masukan password" />
            </div>
            <div class="register-row">
              <h6>Username</h6>
              <input name="username" type="text" placeholder="Masukan password" />
            </div>
            <div class="register-row">
              <h6>Email</h6>
              <input name="email" type="text" placeholder="Masukan password" />
            </div>
            <div class="register-row">
              <h6>Password</h6>
              <input name="password" type="password" placeholder="Masukan password" />
            </div>
            <div class="register-row">
              <h6>Alamat</h6>
              <!-- <input type="text" placeholder="Masukan password" /> -->
              <textarea name="alamat" id="alamat" placeholder="Masukan alamat" rows="5"></textarea>
            </div>
          </div>
          <div class="card-bottom">
            <button type="submit">Register</button>
            <h4>Not yet signed up?<a href="./index.php"> Sign up</a></h4>
          </div>
          <!-- <div class="field button">
            <input id="submit" type="submit" name="submit" value="Continue to Chat">
          </div> -->
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>

</body>
<script src="./assets/js/signup.js"></script>

</html>
l