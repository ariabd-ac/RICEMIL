<?php
    $urlFull=$_SERVER['REQUEST_URI'];
    $urlExplode=explode('/',$urlFull);
   
    include 'config/koneksi.php';
    $page=$_GET['url'];
    switch ($page) {
        case '':
            require 'login.php';
            break;
        case 'register':
            require 'register.php';
            break;
        case 'admin':
            require 'pages/admin/index.php';
            break;
        case 'reseller':
            require 'pages/reseller/index.php';
            break;
        case 'supplier':
            require 'pages/supplier/index.php';
            break;
        case 'gudang':
            require 'pages/gudang/index.php';
            break;
        default:
            require 'login.php';
            break;
    }

?>