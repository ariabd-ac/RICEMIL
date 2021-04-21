<?php
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

if (mysqli_num_rows($sql) > 0) {

  $row = mysqli_fetch_assoc($sql);
  // var_dump($row);
  // die;

  // echo $row['phone'];
  if ($row['phone'] == '') {
    echo '<div class="alert alert-danger" role="alert">
     NT BELUM NGISI NOMOR TELEPON! ISI LAH BIAR DPT NOTIF DARI GUDANG TERCINTA. ISINE NING PROFILE YA
   </div>';
  }
}
