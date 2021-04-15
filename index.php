<?php
    $urlFull=$_SERVER['REQUEST_URI'];
    $urlExplode=explode('/',$urlFull);
   
    include 'config/koneksi.php';
    $page=$_GET['url'];
    $split=explode('/',$page);
    $controller=$split[0];
    $fungsi='home';

    if(!empty($split[1])){
        $fungsi=$split[1];
    }
    switch ($controller) {
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