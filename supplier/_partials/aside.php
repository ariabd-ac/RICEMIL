<aside class="left-sidebar" data-sidebarbg="skin6">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <!-- User Profile-->
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/ricemil/supplier/index.php?page=dashboard" aria-expanded="false"><i class="mdi me-2 mdi-gauge"></i><span class="hide-menu">Dashboard</span></a></li>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/ricemil/supplier/index.php?page=profile" aria-expanded="false">
            <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu">Profile</span></a>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/ricemil/supplier/index.php?page=datapesanan" aria-expanded="false"><i class="mdi me-2 mdi-table"></i><span class="hide-menu">Order Masuk</span></a></li>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/ricemil/supplier/index.php?page=transaksi" aria-expanded="false"><i class="mdi me-2 mdi-table"></i><span class="hide-menu">Transaksi</span></a></li>
      </ul>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
  <div class="sidebar-footer">
    <div class="row">
      <div class="col-4 link-wrap">
        <a href="" alt class="link" title="" data-original-title="Logout"><i class="ti-settings"></i></a>
      </div>
      <div class="col-4 link-wrap">
        <a href="" class="link" title="" data-original-title="Email"><i class="mdi mdi-gmail"></i></a>
      </div>
      <div class="col-4 link-wrap">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <a href="../php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="link" title="" data-original-title="Logout"><i class="mdi mdi-power"></i></a>
      </div>

    </div>
  </div>
</aside>