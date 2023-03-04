<?php
$jumlahdata = $db->rowCOUNT("SELECT f_id FROM t_buku");
$banyak = 5;
$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT DISTINCT t_buku.f_id as f_id, f_judul, f_kategori, f_pengarang, f_penerbit, f_deskripsi FROM t_buku 
INNER JOIN t_kategori ON t_buku.f_idkategori=t_kategori.f_id 
LEFT JOIN t_detailbuku ON t_buku.f_id=t_detailbuku.f_idbuku ORDER BY f_id ASC LIMIT $mulai, $banyak";
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
        .warna {
            background-color: #fad4ff;
        }

        .warna1 {
            background-color: #fef5ff;
        }
        th{
            background-color: #2596be;
        }
        .nav-link{color: #f9e45b}
        th, td{
            margin: 10px;
            text-align-last: center;
            padding: 10px;
        }
        .pagination{
            justify-content: center;
        }
    </style>
</head>

<body>

    <strong>
        <center>
            <h2 style="font-family: 'Sriracha', cursive;">BUKU</h2>
            <hr>
            <hr>
        </center>
    </strong>
    <div class="mt-5">
        <div class="container">
            <div class="float-left mr-4">
                <a class="btn btn-dark" href="?f=buku&m=insert" role="button">Add Data</a>
            </div><br>
            <table class="">
                <thead>
                    <tr class="warna">
                        <th>No</th>
                        <th>CATEGORY</th>
                        <th>JUDUL</th>
                        <th>PENGARANG</th>
                        <th>PENERBIT</th>
                        <th>DESKRIPSI</th>
                        <th>STOK</th>
                        <th>UPDATE</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody class="warna1">
                    <?php if (isset($_GET['updatestock'])) {
                        $updatestock = $_GET['updatestock'];
                        switch ($updatestock) {
                            case 'kurang':
                                $sql = "SELECT DISTINCT t_detailbuku.f_id as f_iddetailbuku, t_buku.f_id as f_id, f_judul, f_idkategori, f_pengarang, f_penerbit, f_deskripsi FROM t_buku                   
                               INNER JOIN t_kategori ON t_buku.f_idkategori=t_kategori.f_id                    
                               LEFT JOIN t_detailbuku ON t_buku.f_id=t_detailbuku.f_idbuku WHERE f_status='Tersedia' AND t_detailbuku.f_idbuku=" . $_GET['idbuku'] . " ORDER BY t_detailbuku.f_id DESC LIMIT 1";
                                $idDihapus  = $db->getITEM($sql);
                                $sql = "DELETE FROM t_detailbuku WHERE f_id=" . $idDihapus['f_iddetailbuku'];
                                $db->runSQL($sql);
                                break;
                            case 'tambah':
                                $sql = "INSERT INTO t_detailbuku VALUES (NULL, " . $_GET['idbuku'] . ",'Tersedia')";
                                $db->runSQL($sql);
                                break;
                            default:
                                break;
                        }
                    }
                    ?>
                    <?php if (!empty($row)) { ?> <?php foreach ($row as $r) : ?> <tr>
                                <td bgcolor="#2596be"><?php echo $no++ ?></td>
                                <td><?php echo $r['f_kategori'] ?></td>
                                <td><?php echo $r['f_judul'] ?></td>
                                <td><?php echo $r['f_pengarang'] ?></td>
                                <td><?php echo $r['f_penerbit'] ?></td>
                                <td><?php echo $r['f_deskripsi'] ?></td>
                                <td><?php $eksemplar = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_status='Tersedia' AND f_idbuku = " . $r['f_id'] . ""); ?>
                                    <nav aria-label="stock">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="?f=buku&m=select&idbuku=<?php echo $r['f_id'] ?>&updatestock=kurang">-</a></li>
                                            <li class="page-item"><a class="page-link" href="#"><?php echo $eksemplar; ?></a></li>
                                            <li class="page-item"><a class="page-link" href="?f=buku&m=select&idbuku=<?php echo $r['f_id'] ?>&updatestock=tambah">+</a></li>
                                        </ul>
                                    </nav>
                                </td>
                                <td><a style="color:;" type="button" class="btn btn-outline-success" href="?f=buku&m=update&id=<?php echo $r['f_id'] ?>">Update</a></td>
                                <td><a style="color:;" type="button" class="btn btn-outline-danger" href="?f=buku&m=delete&id=<?php echo $r['f_id'] ?>">Delete</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php } ?>
                </tbody>
            </table>

</body>

</html>

<nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination my-4">
        <?php

        for ($i = 1; $i <= $halaman; $i++) {
            echo '<li class="page-item"><a class="page-link" style="color:black;" href="?f=buku&m=select&p=' . $i . '">' . $i . '</a></li>';
        }

        ?>
    </ul>
</nav>