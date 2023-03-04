<?php

session_start();
require_once "dbcontroller.php";
$db = new dbcontroller;

if (isset($_GET['log'])) {
    unset($_SESSION['id']);
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PERPUSTAKAAN PRA USK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body class="bg" style="margin:0;">
    <aside style=" background-color: #1b4d89;" class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
                <span class="brand-text font-weight-light" style="background-color: lightgrey;"><center><img src="loginadmin/logo1.png" style="width: 180px;"></center></span>
                <div style="display: flex; justify-content: center;">
                    <?php
                        if (isset($_SESSION['id'])) {
                            $ida = $_SESSION['id'];
                            $sql = "SELECT f_username FROM t_anggota WHERE f_id=$ida";
                            $row = $db->getITEM($sql);
                            echo '
                            <div style="display:flex; justify-content:center; align-items:center;">
                                <span style="color:white;"> <i class="bi bi-person-fill"></i> ' . $row['f_username'] . '</span>
                                <a style="color: white;" class="nav-link active" href="?log=logout"><i class="bi bi-box-arrow-left mx-2"></i>Logout</a>
                            </div>';
                        } else {
                            echo '<a style="color: white;" class="nav-link active" href="login.php"><i class="bi bi-people mx-2"></i>Login</a></div>';
                            // echo '<a style="color: white;" class="nav-link active" href="loginadmin/loginpus.php"><i class="bi bi-people mx-2"></i>Pustakawan</a>';
                            // echo '<a style="color: white;" class="nav-link active" href="home/login.php"><i class="bi bi-person mx-2"></i>Anggota</a>';
                        }
                        ?>
                </div>
                </aside>

    

    <div class="mt-5">
        <center>
            <div class="col-md-9">
                <?php
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    $f = $_GET['f'];
                    $m = $_GET['m'];

                    $file = $f . '/' . $m . '.php';

                    require_once $file;
                } else {
                    require_once "home/daftarbuku.php";
                }
                ?>
            </div>
        </center>
    </div>

    <div class="mt-5">
        <div class="col">
            <p class="text-center">2023 copyright@muhammadazis</p>
        </div>
    </div>
    </div>
</body>

</html>