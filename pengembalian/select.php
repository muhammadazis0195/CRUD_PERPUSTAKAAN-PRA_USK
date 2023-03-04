<?php

$jumlahdata = $db->rowCOUNT("SELECT f_id FROM t_detailpeminjaman");
$banyak = 5;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = ("SELECT t_anggota.f_nama AS namaanggota, t_peminjaman.f_id, t_detailpeminjaman.f_tanggalkembali, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS namaadmin,t_detailpeminjaman.f_id as idpengembalian, t_detailbuku.f_id as iddetailbuku
FROM t_peminjaman
INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id ORDER BY idpengembalian ASC LIMIT  $mulai,$banyak");
$row = $db->getALL($sql);
$no = 1 + $mulai;
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
        .nav-link{color: #f9e45b}
    body{
        font-family: 'Sriracha', cursive;
    }
    .warna {
        background-color: #fad4ff;
    }

    .warna1 {
        background-color: #fef5ff;
    }
    .del{
        color: red;
    }
    .del:hover{
        background-color: red;
        color: white;
    }
    .pagination{
        justify-content: center;
    }
</style>

<strong>
    <center>
        <h2 style="font-family: 'Sriracha', cursive;">PENGEMBALIAN</h2>
        <hr>
        <hr>
    </center>
</strong>

<table class='table mt-5'>
    <thead class="warna" style="background-color: #2596be;">
        <tr>
            <th>NO</th>
            <th>ANGGOTA</th>
            <th>JUDUL BUKU</th>
            <th>TANGGAL PEMINJAMAN</th>
            <th>TANGGAL PENGEMBALIAN</th>
            <th>ADMIN</th>
            <th>KEMBALIKAN</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <tbody class="warna1">
        <?php
        if (!empty($row)) { ?>
            <?php foreach ($row as $r) : ?>
                <tr>
                    <td style="background-color: #2596be;"> <?php echo $no++ ?> </td>
                    <td> <?php echo $r['namaanggota'] ?> </td>
                    <td> <?php echo $r['f_judul'] ?> </td>
                    <td> <?php echo $r['f_tanggalpeminjaman'] ?> </td>
                    <td> <?php
                            if ($r['f_tanggalkembali'] == '0000-00-00') {
                                echo "Belum Kembali";
                            } else {
                                echo $r['f_tanggalkembali'];
                            } ?> 
                    </td>
                    <td> <?php echo $r['namaadmin'] ?> </td>
                    <td>
                        <?php
                        if ($r['f_tanggalkembali'] == '0000-00-00') {
                            echo "<a href=?f=pengembalian&m=update&id=";
                            echo $r['idpengembalian'];
                            echo "&iddetailbuku=";
                            echo $r['iddetailbuku'];
                            echo "><button type='button' class='btn btn-outline-danger'>Kembalikan</button></a>";
                        } else {
                            echo "<button type='button' class='btn btn-outline-success'>Sudah Kembali</button>";
                        } ?> </td>
                    <td><a href="?f=pengembalian&m=delete&id=<?php echo $r['idpengembalian'] ?>"><button type="button" class="btn btn-outline-dark del" style="border: 1px solid red; color: ;">Delete</button></a></td>
                </tr>
            <?php endforeach ?>
        <?php } ?>
    </tbody>
</table>
<nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination  my-4">
        <?php

        for ($i = 1; $i <= $halaman; $i++) {
            echo '<li class="page-item"><a class="page-link" style="color:black;" href="?f=pengembalian&m=select&p=' . $i . '">' . $i . '</a></li>';
        }

        ?>
    </ul>
</nav>