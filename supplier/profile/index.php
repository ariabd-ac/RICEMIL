<?php
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

if (mysqli_num_rows($sql) > 0) {

  $row = mysqli_fetch_assoc($sql);
  // var_dump($row);
  // die;
}

?>


<!-- <form action="" method="post"> -->
<div class="row">
  <h3>Detail Users</h3>
  <hr>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Username</span>
    <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-label="Username" value="<?php echo $row['username'] ?>" aria-describedby="basic-addon1" readonly>
  </div>

  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">Frist Name</span>
    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter frist name" aria-label="Username" value="<?php echo $row['fname']  ?>" readonly>
    <span class="input-group-text" id="basic-addon3">Last Name</span>
    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter last name" aria-label="Server" value="<?php echo $row['lname']; ?>" ? readonly>
  </div>

  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">Email</span>
    <input type="email" name="email" class="form-control" readonly placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $row['email']  ?>">
    <span class="input-group-text" id="basic-addon2">Status user</span>
    <input type="email" name="level" class="form-control" readonly placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $row['level'] ?>">

  </div>


  <div class="input-group">
    <span class="input-group-text">Phone</span>
    <input name="alamat" class="form-control" aria-label="With textarea" value="<?php echo $row['phone']  ?>" readonly></input>
    <span class="input-group-text">Alamat</span>
    <input name="alamat" class="form-control" aria-label="With textarea" value="<?php echo $row['alamat']  ?>" readonly></input>
  </div>

  <div class="col-12 pt-4">
    <div class="col-6">
      <a class='btn btn-info' href="/ricemil/supplier/index.php?page=profile&modul=edit&user_id=<?php echo $row['user_id']; ?>">Edit</a>
    </div>
  </div>
</div>
<!-- </form> -->