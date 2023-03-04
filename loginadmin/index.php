<?php

require_once "../dbcontroller.php";
$db = new dbcontroller;

session_start();
if (!isset($_SESSION['admin'])) {
    header("location:index.php");
}

if (isset($_GET['log'])) {
    session_destroy();

    header("location:../index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPENSBAYA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reggae+One&family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style type="text/css">
        
        .nav-item a:hover {
            background-color: #3c8dbc;
            color: #fff;
        }
        .nav-log a:hover {
            background-color: red;
            color: white;
        }
        .nav-link:hover{
            color: white;
        }  
        .nav-link{color: #f9e45b}
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->

    <div class="wrapper">
        <!-- Navbar -->
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside style=" background-color: #1b4d89;" class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
                <span class="brand-text font-weight-light" style="background-color: lightgrey;"><center><img src="logo1.png" style="width: 180px;"></center></span>
            <!-- Sidebar -->
            
            <div class="sidebar">
                <nav class="mt-2">
                    <center>
                    <ul class="nav nav-pills nav-sidebar " data-widget="treeview" role="menu" data-accordion="false" style="margin-left: ;">
                    <li class="nav-item" style="display: flex;font-size: 20px; margin-left: 20px; color: #f9e45b;">
                        <i class="fa-regular fa-user nav-link" style="color: hite;"></i>
                        <p style="font-family: 'Reggae One', cursive;margin-top: 5px;"><?php echo $_SESSION['admin'] ?>
                        </p>
                    </li>
                        <?php
                    $level = $_SESSION['level'];
                    switch ($level) {
                        case 'Admin':
                            echo '
                    <li class="nav-item"><a style="margin-left:50px;" class="hover-overlay nav-link" href="?f=kategori&m=select"><i class="nav-icon bi bi-list-task mx-2"></i>Kategori</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=buku&m=select"><i class="bi bi-journal-bookmark-fill mx-2"></i>Buku</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=admin&m=select"><i class="bi bi-fingerprint mx-2"></i>Admin</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=anggota&m=select"><i class="bi bi-people-fill mx-2"></i>Anggota</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=peminjaman&m=select"><i class="bi bi-folder-plus mx-2"></i>Peminjaman</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=pengembalian&m=select"><i class="bi bi-folder-minus mx-2"></i></i>Pengembalian</a>
                    </li>
                    <li class="nav-item"><a style="" class="nav-link" href="?f=laporan&m=select"><i class="bi bi-folder2-open mx-2"></i>Laporan Pengembalian</a>
                    </li>

                    ';
                            break;
                            case 'Pustakawan':
                            echo '
                            <li class="nav-item"><a style="margin-left:118px;" class="hover-overlay nav-link" href="?f=kategori&m=select"><i class="nav-icon bi bi-list-task mx-2"></i>Kategori</a>
                            </li>
                            <li class="nav-item"><a style="" class="nav-link" href="?f=buku&m=select"><i class="bi bi-journal-bookmark-fill mx-2"></i>Buku</a>
                            </li>
                            <li class="nav-item"><a style="" class="nav-link" href="?f=peminjaman&m=select"><i class="bi bi-folder-plus mx-2"></i>Peminjaman</a>
                            </li>
                            <li class="nav-item"><a style="" class="nav-link" href="?f=pengembalian&m=select"><i class="bi bi-folder-minus mx-2"></i></i>Pengembalian</a>
                            </li>
                            <li class="nav-item" style="margin-right:100px;"><a style="" class="nav-link" href="?f=laporan&m=select"><i class="bi bi-folder2-open mx-2"></i>Laporan Pengembalian</a>
                            </li>
                            <hr>';
                            break;
                    }
                    ?>
                    <li class="nav-log" style="margin-left: 40px;">
                        <a style="" class="nav-link" href="?log=logout">
                            Logout<i class="bi bi-box-arrow-right mx-2"></i>
                        </a>
                    </li>
                      </ul>
                      </center>
                    </nav>
                    <!-- /.sidebar-menu -->
                  </div>
                  <!-- /.sidebar -->
                </aside>
                </center>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                  <!-- Content Header (Page header) -->
                  

                  <!-- Main content -->
                  <section class="content">
                    <!-- Default box -->
                    <div class="card">
                      <div class="card-body">
                        <?php
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    switch ($level) {
                        case 'Admin':
                            $f = $_GET['f'];
                            $m = $_GET['m'];

                            $file = '../' . $f . '/' . $m . '.php';

                            include $file;
                            break;
                        case 'Pustakawan':
                            if ($_GET['f'] == 'kategori' or $_GET['f'] == 'peminjaman' or $_GET['f'] == 'buku' or $_GET['f'] == 'admin' or $_GET['f'] == 'pengembalian' or $_GET['f'] == 'laporan') {
                                $f = $_GET['f'];
                                $m = $_GET['m'];

                                $file = '../' . $f . '/' . $m . '.php';

                                include $file;
                            } else {
                                echo '<center> Anda Tidak Memiliki Hak Akses Halaman Ini </center>';
                            }

                            break;
                        default:
                            echo '<center> Anda Tidak Memiliki Hak Akses Halaman Ini </center>';
                            break;
                    }
                } else {
                    require_once "../peminjaman/select.php";
                }
                ?>
                      </div>
                      <!-- /.card-body -->
                      <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                  </section>
                  <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <br>

                <footer class="main-footer" style="text-align: center;">
                  <b>Muhammad Azis 2023</b> All rights reserved.
                </footer>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                  <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->

                <!-- /.control-sidebar -->
                </div>
                <!-- ./wrapper -->
                <!-- jQuery -->
</body>
</html>