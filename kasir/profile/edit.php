<?php


if (isset($_GET['user_id'])) {
  $id = $_GET['user_id'];
}

if (isset($_POST['update-users'])) {

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $level = $_POST['level'];
  // $password = $_POST['password'];
  $alamat = $_POST['alamat'];


  // $encrypt_pass = md5($password);

  $query = "UPDATE users SET username='$username',fname='$fname', lname = '$lname', email = '$email', phone = '$phone', level = '$level'  , alamat = '$alamat' WHERE user_id='$id'";

  $insert = mysqli_query($conn, $query);
  if ($insert) {
    header('location:/ricemil/kasir/index.php?page=profile');
  } else {
    die('error ' . mysqli_error($conn));
  }
} else {

  $query = "SELECT * FROM users WHERE user_id=$id";

  $insert = mysqli_query($conn, $query);
  if ($insert) {
    $hasil = mysqli_fetch_assoc($insert);
    $username = $hasil['username'];
    $fname = $hasil['fname'];
    $lname = $hasil['lname'];
    $email = $hasil['email'];
    $phone = $hasil['phone'];
    $level = $hasil['level'];
    // $password = $hasil['password'];
    $alamat = $hasil['alamat'];

    // var_dump($password);
    // die;
  } else {
    die('error ' . mysqli_error($conn));
  }
}
?>

<div class="card">
  <div class="card-body">

    <form action="" method="post">
      <div class="row">
        <h3>Edit profile</h3>
        <hr>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Username</span>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-label="Username" value="<?php echo $username ?>" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">Frist Name</span>
          <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter frist name" aria-label="Username" value="<?php echo $fname ?>">
          <span class="input-group-text" id="basic-addon3">Last Name</span>
          <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter last name" aria-label="Server" value="<?php echo $lname ?>">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">Email</span>
          <input type="email" name="email" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo $email ?>">
          <span class="input-group-text" id="basic-addon2">Status user</span>
          <input type="text" name="level" readonly class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo $level ?>">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text">Phone</span>
          <input type="number" name="phone" id="password" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $phone ?>">
        </div>

        <div class="input-group">
          <span class="input-group-text">Alamat</span>
          <textarea name="alamat" class="form-control" aria-label="With textarea" value=""><?php echo $alamat ?></textarea>
        </div>

        <div class="col-12 pt-4">
          <div class="col-6">
            <button type="submit" name="update-users" class="btn btn-warning">Simpan</button>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>