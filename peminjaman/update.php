<?php
if (isset($_GET['idpem']) && isset($_GET['idbuku'])) {
    $idborrow = $_GET['idpem'];
    $idbuku = $_GET['idbuku'];
    if ($level == 'Pustakawan') {
        $itema = $db->getAll("SELECT * FROM `t_admin` ORDER BY f_nama ASC");
    } else {
        $itema = $db->getAll("SELECT * FROM `t_admin` ORDER BY f_nama ASC");
    }
    $itemold = $db->getItem("SELECT f_iddetailbuku,  f_idanggota, f_idadmin, f_tanggalpeminjaman, t_peminjaman.f_id 
    FROM `t_peminjaman`
    INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
     WHERE t_peminjaman.f_id = $idborrow");
    $itemm = $db->getAll("SELECT * FROM `t_anggota` ORDER BY f_nama ASC");
    $itemb = $db->getAll("SELECT f_judul, t_detailbuku.f_id AS idbookdetail FROM `t_detailbuku` 
        INNER JOIN t_buku ON t_detailbuku.f_idbuku = t_buku.f_id
        WHERE f_status = 'Tersedia' OR t_detailbuku.f_id = $idbuku
        ORDER BY f_judul ASC");
    $today = date("Y-m-d");
}
?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
        @font-face {
          font-family: 'accelerator';
          src: url('accelerator.otf') format('opentype'),
               url('accelerator.ttf') format('truetype');
        }
        body{
            font-family: 'Sriracha', cursive
        }
        </style>
<div class="container">
    <h4 style="font-family:Georgia, 'Times New Roman', Times, serif;">Edit Peminjaman</h4>
    <div class="form-group">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group w-50">

                <label for="" class="mb-2 mt-2">Anggota</label>
                <select class="form-control" name="member" id="">
                    <?php foreach ($itemm as $c) : ?>
                        <option value="<?= $c['f_id'] ?>" <?php if ($itemold['f_idanggota'] == $c['f_id']) {
                                                                echo "selected";
                                                            } ?>><?= $c['f_nama'] ?></option>
                    <?php endforeach ?>
                </select>

                <label for="" class="mb-2 mt-2">Judul Buku</label>
                <select class="form-control" name="book" id="">
                    <?php foreach ($itemb as $c) : ?>
                        <option value="<?= $c['idbookdetail'] ?>" <?php if ($idbuku == $c['idbookdetail']) {
                                                                        echo "selected";
                                                                    } ?>><?= $c['f_judul'] ?></option>
                    <?php endforeach ?>
                </select>

                <label for="" class="mb-2 mt-2">Admin</label>
                <select class="form-control" name="admin" id="">
                    <?php foreach ($itema as $c) : ?>
                        <option value="<?= $c['f_id'] ?>" <?php if ($itemold['f_idadmin'] == $c['f_id']) {
                                                                echo "selected";
                                                            } ?>><?= $c['f_nama'] ?></option>
                    <?php endforeach ?>
                </select>

                <label for="" class="mb-2 mt-2">Tanggal Peminjaman</label>
                <input type="date" class="form-control" name="borrowdate" value="<?= $itemold['f_tanggalpeminjaman'] ?>" required><br>
                <button type="submit" class="btn btn-outline-dark" name="change">Save</button>
            </div>
    </div>
    </form>
</div>
<?php
if (isset($_POST['change'])) {
    $member = $_POST['member'];
    $book = $_POST['book'];
    $admin = $_POST['admin'];
    $borrowdate = $_POST['borrowdate'];

    $db->runSQL("UPDATE `t_peminjaman` 
        SET `f_idadmin`='$admin',`f_idanggota`='$member',`f_tanggalpeminjaman`='$borrowdate'
        WHERE f_id = $idborrow");

    if ($itemold['f_iddetailbuku'] == $book) {
        echo "<script> window.location.assign('?f=peminjaman&m=select&p=1'); </script>";
    } else {
        $oldidbuku = $itemold['f_iddetailbuku'];
        $db->runSQL("UPDATE `t_detailbuku` 
            SET `f_status`='Tersedia' 
            WHERE f_id = $oldidbuku");
        $db->runSQL("UPDATE `t_detailpeminjaman` 
            SET f_iddetailbuku = $book
            WHERE f_idpeminjaman = $idborrow");
        $itemnew = $db->getItem("SELECT f_iddetailbuku, f_idanggota, f_idadmin, f_tanggalpeminjaman, t_peminjaman.f_id 
        FROM `t_peminjaman`
        INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
         WHERE t_peminjaman.f_id = $idborrow");
        $newidbook = $itemnew['f_iddetailbuku'];
        $db->runSQL("UPDATE `t_detailbuku` 
            SET `f_status`='Tidak Tersedia' 
            WHERE f_id = $newidbook");
        echo "<script> window.location.assign('?f=peminjaman&m=select&p=1'); </script>";
    }
}
?>