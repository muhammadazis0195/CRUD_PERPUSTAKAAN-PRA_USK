<script src="../chosen/docsupport/jquery-1.12.4.min.js"></script>
<script src="../chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="../chosen/chosen.css">

<script type="text/javascript">
     $(function() {
          $(".chzn-select").chosen();
     });
</script>

<?php
$admin = $db->getALL("SELECT * FROM t_admin ORDER BY f_nama ASC");
$anggota = $db->getALL("SELECT * FROM t_anggota ORDER BY f_nama ASC");
$buku = $db->getALL("SELECT t_detailbuku.f_id AS f_iddetailbuku, f_judul, f_deskripsi
    FROM t_buku
    INNER JOIN t_detailbuku ON t_buku.f_id = t_detailbuku.f_idbuku
    WHERE f_status = 'Tersedia'");
?>

     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
     body{
         font-family: 'Sriracha', cursive;
     }
     span {
          padding: 6px 0 0 0;
     }
</style>

<div class="mt-3">
     <div class="container">
          <h3 class="mb-4 mt-4" style="font-family: 'Sriracha', cursive;">Insert Peminjaman</h3>
          <hr>

          <div class="form-group">

               <form action="" method="post">

                    <div class="form-group w-50 mt-3">
                         <label for="">Admin</label><br>
                         <select name="f_idadmin" id="" class=" form-control">
                              <?php foreach ($admin as $r) : ?>
                                   <option value="<?php echo $r['f_id'] ?>"><?php echo $r['f_nama'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>

                    <div class="form-group w-50 mt-3">
                         <label for="">Anggota</label><br>
                         <select name="f_idanggota" id="" class=" form-control">
                              <?php foreach ($anggota as $r) : ?>
                                   <option value="<?php echo $r['f_id'] ?>"><?php echo $r['f_nama'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>

                    <div class="form-group w-50 mt-3">
                         <label for="">Judul Buku</label><br>
                         <select name="judulbuku" id="" class="chzn-select form-control">
                              <?php foreach ($buku as $r) : ?>
                                   <option value="<?php echo $r['f_iddetailbuku'] ?>">
                                        <?php echo $r['f_judul'];
                                        ?>
                                   </option>
                              <?php endforeach ?>
                         </select>
                    </div>

                    <div class="form-group w-50 mt-3">
                         <label for="">Tanggal Peminjam</label>
                         <input class="form-control mb-3" type="date" name="f_tanggalpeminjaman" />
                    </div>

                    <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>

               </form>
          </div>
     </div>
</div>

<?php
if (isset($_POST['simpan'])) {
     $admin = $_POST['f_idadmin'];
     $anggota = $_POST['f_idanggota'];
     $judulbuku = $_POST['judulbuku'];
     $tgl = $_POST['f_tanggalpeminjaman'];

     $sql = "INSERT INTO t_peminjaman VALUES ('', '$admin', '$anggota', '$tgl')";
     $db->runSQL($sql);

     $idpeminjamanterakhir = $db->getITEM("SELECT f_id AS idterakhir FROM t_peminjaman ORDER BY f_id DESC LIMIT 1");
     $idterakhir = $idpeminjamanterakhir['idterakhir'];
     $sql = "INSERT INTO t_detailpeminjaman VALUES('', '$idterakhir', '$judulbuku', '')";
     $db->runSQL($sql);

     $sql = "UPDATE t_detailbuku SET f_status= 'Tidak Tersedia' WHERE f_id=$judulbuku";
     $db->runSQL($sql);
     echo "<script>window.location.assign('?f=peminjaman&m=select');</script>";
}
?>