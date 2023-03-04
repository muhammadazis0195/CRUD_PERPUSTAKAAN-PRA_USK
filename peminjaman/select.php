<?php

if (isset($_POST['opsi'])) {
     $opsi = $_POST['opsi'];

     $where = "WHERE f_id= $opsi";
} else {
     $opsi = 0;
     $where = "";
}

$jumlahdata = $db->rowCOUNT("SELECT t_anggota.f_nama AS f_namaanggota, t_kategori.f_kategori,t_peminjaman.f_id, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS f_namaadmin, t_detailbuku.f_id as f_iddetb
FROM t_peminjaman
INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id
INNER JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id  ORDER BY t_peminjaman.f_id ASC ");
$banyak = 5;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
     $p = $_GET['p'];
     $mulai = ($p * $banyak) - $banyak;
} else {
     $mulai = 0;
}
$sql = "SELECT t_anggota.f_nama AS f_namaanggota, t_kategori.f_kategori,t_peminjaman.f_id, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS f_namaadmin, t_detailbuku.f_id as f_iddetb
FROM t_peminjaman
INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id
INNER JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id LIMIT $mulai,$banyak;";
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
          .nav-link{color: #f9e45b}
          body{
              font-family: 'Sriracha', cursive
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
          th, td{
               margin: 10px;
               text-align-last: center;
               padding: 10px;
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
</head>

<body>

     <form id="compose" name="compose" method="post" action="" enctype="multipart/form-data">
          <strong>
               <center>
                    <h2>PEMINJAMAN</h2>
                    <hr>
                    <hr>
               </center>
          </strong>
          <div class="mt-5">
               <div class="container">
                    <div class="float-left mr-4">
                         <a class="btn btn-dark" href="?f=peminjaman&m=insert" role="button">Add Data</a>
                    </div><br>
                    <table class="" style="width: 100%;">
                         <thead>
                              <tr class="warna">
                                   <th>NO</th>
                                   <th>ANGGOTA</th>
                                   <th>TANGGAL PEMINJAMAN</th>
                                   <th>KATEGORI</th>
                                   <th>JUDUL BUKU</th>
                                   <th>ADMIN</th>
                                   <th>UPDATE</th>
                                   <!-- <th>Delete</th> -->
                              </tr>

                         </thead>

                         <tbody class="warna1">
                              <?php if (!empty($row)) { ?>
                                   <?php foreach ($row as $r) : ?>
                                        <tr>
                                             <td><?php echo $no++ ?></td>
                                             <td><?php echo $r['f_namaanggota'] ?></td>
                                             <td><?php echo $r['f_tanggalpeminjaman'] ?></td>
                                             <td><?php echo $r['f_kategori'] ?></td>
                                             <td><?php echo $r['f_judul'] ?></td>
                                             <td><?php echo $r['f_namaadmin'] ?></td>
                                             <td><a class="btn btn-outline-success" href="?f=peminjaman&m=update&idpem=<?= $r['f_id'] ?>&idbuku=<?= $r['f_iddetb'] ?>">Update</a><br></td>
                                             <!-- <td><a class="nav-link" href="?f=peminjaman&m=delete&id=<?php echo $r['f_id'] ?>"><button type="button" class="btn btn-outline-dark">Delete</button></a></td> -->
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
<nav aria-label="Pagination">
     <hr class="my-0" />
     <ul class="pagination my-4">
          <?php

          for ($i = 1; $i <= $halaman; $i++) {
               echo '<li class="page-item"><a class="page-link" style="color:black;" href="?f=peminjaman&m=select&p=' . $i . '">' . $i . '</a></li>';
          }

          ?>
     </ul>
</nav>