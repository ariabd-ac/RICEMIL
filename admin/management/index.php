<a href="/ricemil/admin/index.php?page=account&modul=add" class="btn btn-danger d-none d-md-inline-block text-white">Tambah Akun</a>
<table class="table user-table">
  <thead>
    <tr>
      <th class="border-top-0">#</th>
      <th class="border-top-0">First Name</th>
      <th class="border-top-0">Last Name</th>
      <th class="border-top-0">Username</th>
      <th class="border-top-0">Email</th>
      <th class="border-top-0">Level</th>
      <th class="border-top-0">Options</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $q = "SELECT * FROM users ";
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
        <td><?= $res['level'] ?></td>
        <td>
          <a class='btn btn-info' href="/ricemil/admin/index.php?page=account&modul=edit&user_id=<?php echo $res['user_id']; ?>">Edit</a>
          <a class='btn btn-danger' href="/ricemil/admin/index.php?page=account&modul=delete&user_id=<?php echo $res['user_id']; ?>">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>