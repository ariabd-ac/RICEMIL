<?php


if (isset($_GET['user_id'])) {
  $id = $_GET['user_id'];
}

if (isset($_POST['update-pwd'])) {


  $password = md5($_POST['password']);
  $newpwd = md5($_POST['newpwd']);

  $q = "SELECT * FROM users WHERE user_id = '$id' AND password = '$password'";

  $qq = mysqli_query($conn, $q);

  $rs = mysqli_fetch_assoc($qq);

  if ($rs) {

    $query = "UPDATE users SET password='$newpwd' WHERE user_id='$id'";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
      header('location:/ricemil/supplier/index.php?page=profile');
    } else {
      die('error ' . mysqli_error($conn));
    }
  } else {
    echo "
      <script>
      alert('password lama salah');
      window.location.href('http://localhost/ricemil/supplier/index.php?page=profile&modul=changepwd&user_id=" . $id . "')
      </script>
    ";
  }

  // var_dump(mysqli_fetch_assoc($qq));
  // die();
}
?>


<div class="card">
  <div class="card-body">

    <form action="" method="post">
      <div class="row">
        <h3>Change passwrd</h3>
        <hr>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Password sekarang</span>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password now" aria-label="Password now" value="" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Password baru</span>
          <input type="password" name="newpwd" id="newpwd" class="form-control" placeholder="Password new" aria-label="Password new" value="" aria-describedby="basic-addon1">
        </div>

        <div class="col-12 pt-4">
          <div class="col-6">
            <button type="submit" name="update-pwd" class="btn btn-warning">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>