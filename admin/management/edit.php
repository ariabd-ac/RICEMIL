<?php


if (isset($_GET['user_id'])) {
  $id = $_GET['user_id'];
}

if (isset($_POST['update-users'])) {

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $level = $_POST['level'];
  $password = $_POST['password'];
  $alamat = $_POST['alamat'];


  $encrypt_pass = md5($password);

  $query = "UPDATE users SET username='$username',fname='$fname', lname = '$lname', email = '$email', level = '$level' , password = '$encrypt_pass' , alamat = '$alamat' WHERE user_id='$id'";

  $insert = mysqli_query($conn, $query);
  if ($insert) {
    header('location:/ricemil/admin/index.php?page=account');
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
    $level = $hasil['level'];
    $password = $hasil['password'];
    $alamat = $hasil['alamat'];
  } else {
    die('error ' . mysqli_error($conn));
  }
}
?>
<div class="card">
  <div class="card-body">
    <form action="" method="post">
      <div class="row">
        <h3>Tambah user</h3>
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
          <input type="text" name="email" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo $email ?>">
          <span class="input-group-text" id="basic-addon2">Status user</span>
          <select class="form-select" id="level" aria-label="Default select example" name="level" value="<?php echo $level ?>" required>
            <option value>Status</option>
            <option value="gudang">Gudang</option>
            <option value="suplier">Suplier</option>
            <option value="admin">Admin</option>
            <option value="reseller">Reseller</option>
          </select>
        </div>

        <small style="color: red;">Harap masukan password!</small>
        <div class="input-group mb-3">
          <span class="input-group-text">Password</span>
          <input type="password" name="password" id="pwd" class="form-control" aria-label="Amount (to the nearest dollar)" value="">
        </div>

        <div class="input-group">
          <span class="input-group-text">Alamat</span>
          <input name="alamat" class="form-control" aria-label="With textarea" value="<?php echo $alamat ?>"></input>
        </div>

        <div class="col-12 pt-4">
          <div class="col-6">
            <button type="submit" name="update-users" id="submit" class="btn btn-warning">Simpan</button>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  let pwd = document.getElementById('pwd');
  let btnSubmit = document.getElementById('submit');
  let level = document.getElementById('level').value;


  console.log('level: ', level);





  submit.addEventListener('click', (e) => {
    if (pwd.value == '' || pwd.value == null) {
      e.preventDefault();
      // alert('password di isi dong bos');
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Masukan password!',
      })
    }

    if (level == 'Status') {
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Pilih level!',
      })
    }
  })
</script>