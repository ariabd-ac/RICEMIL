<a href="/ricemil/admin/index.php?page=account&modul=add" class="btn btn-danger d-none d-md-inline-block text-white">Tambah Akun</a>
<table class="table user-table">
  <thead>
    <tr>
      <th class="border-top-0">#</th>
      <th class="border-top-0">First Name</th>
      <th class="border-top-0">Last Name</th>
      <th class="border-top-0">Username</th>
      <th class="border-top-0">Email</th>
      <th class="border-top-0">Alamat</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $q = "SELECT * FROM `users` WHERE level = 'supplier'";
    $results = mysqli_query($conn, $q);
    // var_dump($results);
    // die;
    foreach ($results as $res) {
      // var_dump($res);
      // die;
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $res['fname'] ?></td>
        <td><?= $res['lname'] ?></td>
        <td><?= $res['username'] ?></td>
        <td><?= $res['email'] ?></td>
        <td><?= $res['alamat'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>