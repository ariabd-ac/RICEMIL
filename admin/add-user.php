<?php
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'admin') {
  header("location: 404.php");
}
?>





<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <?php
  include './_partials/head.php';
  ?>
</head>

<body>
  <?php
  include './_partials/preloader.php';
  ?>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php
    include './_partials/header.php';
    ?>
    <?php
    include './_partials/aside.php';
    ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
          <!-- Column -->
          <div class="col-lg-8">
            <div class="card">

              <div class="card-body">
                <form action="" method="post">
                  <div class="row">
                    <h3>Tambah user</h3>
                    <hr>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Username</span>
                      <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon3">Frist Name</span>
                      <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter frist name" aria-label="Username">
                      <span class="input-group-text" id="basic-addon3">Last Name</span>
                      <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter last name" aria-label="Server">
                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon3">Email</span>
                      <input type="text" name="email" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <span class="input-group-text" id="basic-addon2">Status user</span>
                      <select class="form-select" aria-label="Default select example" name="level">
                        <option selected>Status</option>
                        <option value="gudang">Gudang</option>
                        <option value="suplier">Suplier</option>
                        <option value="admin">Admin</option>
                        <option value="reseller">Reseller</option>
                      </select>
                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text">Password</span>
                      <input type="password" name="password" id="password" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>

                    <div class="input-group">
                      <span class="input-group-text">Alamat</span>
                      <textarea name="alamat" class="form-control" aria-label="With textarea"></textarea>
                    </div>

                    <div class="col-12 pt-4">
                      <div class="col-6">
                        <button type="submit" name="simpan-users" class="btn btn-warning">Simpan</button>

                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include './_partials/footer.php';
      ?>
    </div>

  </div>
  <?php
  include './_partials/script.php';
  ?>
</body>

</html>

<?php
if (isset($_POST['simpan-users'])) {
  include_once "../config/koneksi.php";

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $level = $_POST['level'];
  $password = $_POST['password'];
  $alamat = $_POST['alamat'];

  // var_dump($username);
  // die;

  if (!empty($username) && !empty($fname) && !empty($lname) && !empty($email) && !empty($level)  && !empty($password) && !empty($alamat)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
      if (mysqli_num_rows($sql) > 0) {
        echo "$email - This email already exist!";
      } else {
        $ran_id = rand(time(), 100000000);
        $encrypt_pass = md5($password);
        $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, username, fname, lname, email, password, alamat, level)
                              VALUES ({$ran_id}, '{$username}', '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$alamat}', '{$level}')");
      }
    }
  } else {
    echo "$email is not a valid email!";
  }
  if ($insert_query) { ?>
    <script>
      Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
      )
    </script>
<?php
    // header('location: managament-user.php');
  } else {
    die('err :' . mysqli_error($conn));
  }
}
?>