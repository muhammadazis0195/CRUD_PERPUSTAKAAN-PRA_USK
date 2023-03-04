<?php
$jumlahdata = $db->rowCOUNT("SELECT f_nama, COUNT(*) AS kembali FROM t_anggota 
INNER JOIN t_peminjaman ON t_anggota.f_id=t_peminjaman.f_idanggota
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman 
WHERE f_tanggalkembali ='0000-00-00' 
GROUP BY f_nama");
$banyak = 5;
$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$no = 1 + $mulai;

$bukupinjam = $db->rowCOUNT("SELECT f_judul FROM t_buku INNER JOIN t_detailbuku ON 
t_buku.f_id=t_detailbuku.f_idbuku WHERE f_status='Tidak Tersedia'");

$bukutersedia = $db->rowCOUNT("SELECT f_judul FROM t_buku INNER JOIN t_detailbuku ON 
t_buku.f_id=t_detailbuku.f_idbuku WHERE f_status='Tersedia'");

$anggota = $db->getALL("SELECT f_nama, COUNT(*) AS kembali FROM t_anggota 
INNER JOIN t_peminjaman ON t_anggota.f_id=t_peminjaman.f_idanggota
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman 
WHERE f_tanggalkembali ='0000-00-00' 
GROUP BY f_nama ORDER BY COUNT(*) DESC LIMIT $mulai, $banyak
");

$angg = $db->rowCOUNT("SELECT f_nama, COUNT(*) AS kembali FROM t_anggota 
INNER JOIN t_peminjaman ON t_anggota.f_id=t_peminjaman.f_idanggota
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman 
WHERE f_tanggalkembali ='0000-00-00' 
GROUP BY f_nama ORDER BY COUNT(*) DESC LIMIT 100
");
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
        body{
            font-family: 'Sriracha', cursive;
        }
    .warna {
        background-color: #f9e45b ;
    }

    .warna1 {
        background-color: #fbf0fc;
    }
    .plan-card {
      background: #fff;
      width: 15rem;
      padding-left: 2rem;
      padding-right: 2rem;
      padding-top: 10px;
      padding-bottom: 20px;
      border-radius: 10px;
      border-bottom: 4px solid #000446;
      box-shadow: 0 6px 30px rgba(207, 212, 222, 0.3);
      font-family: "Poppins", sans-serif;
    }

    .plan-card h2 {
      margin-bottom: 15px;
      font-size: 27px;
      font-weight: 600;
    }

    .plan-card h2 span {
      display: block;
      margin-top: -4px;
      color: #4d4d4d;
      font-size: 12px;
      font-weight: 400;
    }

    .etiquet-price {
      position: relative;
      background: #fdbd4a;
      width: 14.46rem;
      margin-left: -0.65rem;
      padding: .2rem 1.2rem;
      border-radius: 5px 0 0 5px;
    }

    .etiquet-price p {
      margin: 0;
      padding-top: .4rem;
      display: flex;
      font-size: 1.9rem;
      font-weight: 500;
    }

    .etiquet-price p:before {
      content: "";
      margin-right: 5px;
      font-size: 15px;
      font-weight: 300;
    }

    .etiquet-price p:after {
      content: "";
      margin-left: 5px;
      font-size: 15px;
      font-weight: 300;
    }

    .etiquet-price div {
      position: absolute;
      bottom: -23px;
      right: 0px;
      width: 0;
      height: 0;
      border-top: 13px solid #c58102;
      border-bottom: 10px solid transparent;
      border-right: 13px solid transparent;
      z-index: -6;
    }

    .benefits-list {
      margin-top: 16px;
    }

    .benefits-list ul {
      padding: 0;
      font-size: 14px;
    }

    .benefits-list ul li {
      color: #4d4d4d;
      list-style: none;
      margin-bottom: .2rem;
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .benefits-list ul li svg {
      width: .9rem;
      fill: currentColor;
    }

    .benefits-list ul li span {
      font-weight: 300;
    }

    .button-get-plan {
      display: flex;
      justify-content: center;
      margin-top: 1.2rem;
    }

    .button-get-plan a {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #000446;
      color: #fff;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-size: .8rem;
      letter-spacing: .05rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .button-get-plan a:hover {
      transform: translateY(-3%);
      box-shadow: 0 3px 10px rgba(207, 212, 222, 0.9);
    }

    .button-get-plan .svg-rocket {
      margin-right: 10px;
      width: .9rem;
      fill: currentColor;
    }
    .nav-link{color: #f9e45b}

    .pagination{
        justify-content: center;
    }
</style>

<div class="container">
    <h4 class="text-center mt-4" style="">Laporan Perpustakaan</h4>
    <hr class="mb-4">
    <div class="row mt-4">
        <div style="display: flex; justify-content: center;">
        <div class="plan-card">
            <center><img width="80px" src="../loginadmin/logo1.png"></center>
            <div class="etiquet-price">
                <p><h6>Jumlah Anggota Belum Mengembalikan</h6></p>
                <div></div>
            </div>
            <div class="benefits-list">
                <center><b style="font-size: 20px;"><?= $angg ?></b></center>
            </div>
            <div class="button-get-plan">
                <a href="../laporan/anggotabelumkembali.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-rocket">
                        <path d="M156.6 384.9L125.7 353.1C117.2 345.5 114.2 333.1 117.1 321.8C120.1 312.9 124.1 301.3 129.8 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H200C202.4 124 204.8 120.3 207.2 116.7C289.1-4.07 411.1-8.142 483.9 5.275C495.6 7.414 504.6 16.43 506.7 28.06C520.1 100.9 516.1 222.9 395.3 304.8C391.8 307.2 387.1 309.6 384 311.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V380.8C209.9 385.6 197.6 389.7 188.3 392.7C177.1 396.3 164.9 393.2 156.6 384.9V384.9zM384 167.1C406.1 167.1 424 150.1 424 127.1C424 105.9 406.1 87.1 384 87.1C361.9 87.1 344 105.9 344 127.1C344 150.1 361.9 167.1 384 167.1z"></path>
                    </svg>
                    <span>EXPORT</span>
                </a>
            </div>
        </div>

        <div class="plan-card" style="margin-left: 50px;">
            <center><img width="80px" src="../loginadmin/logo1.png"></center>
            <div class="etiquet-price">
                <p><h6>Jumlah Buku Dipinjam</h6></p>
                <div></div>
            </div>
            <div class="benefits-list">
                <center><b style="font-size: 20px;"><?= $bukupinjam ?></b></center>
            </div>
            <div class="button-get-plan">
                <a href="../laporan/exportbukupinjam.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-rocket">
                        <path d="M156.6 384.9L125.7 353.1C117.2 345.5 114.2 333.1 117.1 321.8C120.1 312.9 124.1 301.3 129.8 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H200C202.4 124 204.8 120.3 207.2 116.7C289.1-4.07 411.1-8.142 483.9 5.275C495.6 7.414 504.6 16.43 506.7 28.06C520.1 100.9 516.1 222.9 395.3 304.8C391.8 307.2 387.1 309.6 384 311.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V380.8C209.9 385.6 197.6 389.7 188.3 392.7C177.1 396.3 164.9 393.2 156.6 384.9V384.9zM384 167.1C406.1 167.1 424 150.1 424 127.1C424 105.9 406.1 87.1 384 87.1C361.9 87.1 344 105.9 344 127.1C344 150.1 361.9 167.1 384 167.1z"></path>
                    </svg>
                    <span>EXPORT</span>
                </a>
            </div>
        </div>
        <div class="plan-card" style="margin-left: 50px;">
            <center><img width="80px" src="../loginadmin/logo1.png"></center>
            <div class="etiquet-price">
                <p><h6>Jumlah Buku Tersedia</h6></p>
                <div></div>
            </div>
            <div class="benefits-list">
                <center><b style="font-size: 20px;"><?= $bukutersedia ?></b></center>
            </div>
            <div class="button-get-plan">
                <a href="../laporan/exportbukutersedia.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-rocket">
                        <path d="M156.6 384.9L125.7 353.1C117.2 345.5 114.2 333.1 117.1 321.8C120.1 312.9 124.1 301.3 129.8 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H200C202.4 124 204.8 120.3 207.2 116.7C289.1-4.07 411.1-8.142 483.9 5.275C495.6 7.414 504.6 16.43 506.7 28.06C520.1 100.9 516.1 222.9 395.3 304.8C391.8 307.2 387.1 309.6 384 311.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V380.8C209.9 385.6 197.6 389.7 188.3 392.7C177.1 396.3 164.9 393.2 156.6 384.9V384.9zM384 167.1C406.1 167.1 424 150.1 424 127.1C424 105.9 406.1 87.1 384 87.1C361.9 87.1 344 105.9 344 127.1C344 150.1 361.9 167.1 384 167.1z"></path>
                    </svg>
                    <span>EXPORT</span>
                </a>
            </div>
        </div>
    </div>

    <table class="table table-bordered w-100">
        <tr class="warna">
            <th>No</th>
            <th>Banyak Anggota Yang Belum Mengembalikan</th>
            <th>Buku</th>
        </tr>

        <?php $no = 1; ?>

            <tbody class="warna1">
                <?php if (!empty($anggota)) { ?>
                    <?php foreach ($anggota as $r) { ?>
                        <tr>
                            <td style="background-color: #f9e45b;"><?= $no++ ?></td>
                            <td><?= $r['f_nama'] ?></td>
                            <td><?= $r['kembali'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
            <div class="button-get-plan">
                <a href="../laporan/anggotabelumkembali.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-rocket">
                        <path d="M156.6 384.9L125.7 353.1C117.2 345.5 114.2 333.1 117.1 321.8C120.1 312.9 124.1 301.3 129.8 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H200C202.4 124 204.8 120.3 207.2 116.7C289.1-4.07 411.1-8.142 483.9 5.275C495.6 7.414 504.6 16.43 506.7 28.06C520.1 100.9 516.1 222.9 395.3 304.8C391.8 307.2 387.1 309.6 384 311.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V380.8C209.9 385.6 197.6 389.7 188.3 392.7C177.1 396.3 164.9 393.2 156.6 384.9V384.9zM384 167.1C406.1 167.1 424 150.1 424 127.1C424 105.9 406.1 87.1 384 87.1C361.9 87.1 344 105.9 344 127.1C344 150.1 361.9 167.1 384 167.1z"></path>
                    </svg>
                <span>EXPORT</span>
            </a>
        </div>
    </table>


    <nav aria-label="Pagination">
    <hr class="my-0" />
        <ul class="pagination my-4">
        <?php

            for ($i = 1; $i <= $halaman; $i++) {
                echo '<li class="page-item"><a class="page-link" style="color:black;" href="?f=laporan&m=select&p=' . $i . '">' . $i . '</a></li>';
            }

            ?>
        </ul>
    </nav>

    </div>
</div>