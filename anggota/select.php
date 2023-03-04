<?php

$jumlahdata = $db->rowCOUNT("SELECT f_id FROM t_anggota");
$banyak = 5;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM t_anggota ORDER BY f_id ASC LIMIT  $mulai,$banyak";
$row = $db->getALL($sql);
$no = 1 + $mulai;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERPUSTAKAAN PRA USK</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
        body{
            font-family: 'Sriracha', cursive;
        }
        th{
            background-color: #2596be;
        }
        th, td{
            margin: 10px;
            text-align-last: center;
            padding: 10px;
        }
        .nav-link{color: #f9e45b}

        .pagination{
            justify-content: center;
        }
    </style>
</head>

<body>

    <form id="compose" name="compose" method="post" action="" enctype="multipart/form-data">
        <strong>
            <center>
                <h2 style="font-family: 'Sriracha', cursive;">ANGGOTA</h2>
                <hr>
                <hr>
            </center>
        </strong>
        <div class="mt-5">
            <div class="container">
                <div class="float-left mr-4">
                    <a class="btn btn-dark" href="?f=anggota&m=insert" role="button">Add Data</a>
                </div><br>
                <table class="">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>TEMPAT LAHIR</th>
                            <th>TANGGAL LAHIR</th>
                            <th>KELAS</th>
                            <th>JURUSAN</th>
                            <th>UPDATE</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)) { ?>
                            <?php foreach ($row as $r) : ?>
                                <tr>
                                    <td bgcolor="#2596be"><?php echo $no++ ?></td>
                                    <td><?php echo $r['f_nama'] ?></td>
                                    <td><?php echo $r['f_username'] ?></td>
                                    <td><?php echo $r['f_password'] ?></td>
                                    <td><?php echo $r['f_tempatlahir'] ?></td>
                                    <td><?php echo $r['f_tanggallahir'] ?></td>
                                    <td><?php echo $r['f_kelas'] ?></td>
                                    <td><?php echo $r['f_jurusan'] ?></td>
                                    <td><a style="color:black;" href="?f=anggota&m=update&id=<?php echo $r['f_id'] ?>"><button type="button" class="btn btn-outline-success">Update</button></a></td>
                                    <td><a style="color:black;" href="?f=anggota&m=delete&id=<?php echo $r['f_id'] ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>

</html>

<nav aria-label="Pagination" style="margin-left: auto; margin-right: auto;">
    <hr class="my-0" />
    <ul class="pagination my-4">
        <?php

        for ($i = 1; $i <= $halaman; $i++) {
            echo '<li class="page-item center"><a class="page-link" style="color:black;" href="?f=anggota&m=select&p=' . $i . '">' . $i . '</a></li>';
        }

        ?>
    </ul>
</nav>