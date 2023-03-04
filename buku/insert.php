<?php
$t_kategori = $db->getALL("SELECT * FROM t_kategori");
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
    <style type="text/css">
        body{
            font-family: 'Sriracha', cursive;
        }
    </style>
<div class="mt-3">
    <div class="container">
        <h3 style="font-family: 'Sriracha', cursive;">Insert Buku</h3>
        <hr>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50 mt-2">
                    <label for="">Kategori</label>
                    <select class="form-control" name="f_kategori">
                        <option value="" disabled selected>Pilih...</option>
                        <?php foreach ($t_kategori as $isi) : ?>
                            <option value="<?php echo $isi['f_id'] ?>"><?php echo $isi['f_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group w-50 mt-2">
                    <label for="">Judul Buku</label>
                    <input type="text" name="f_judul" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-2">
                    <label for="">Pengarang</label>
                    <input type="text" name="f_pengarang" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-2">
                    <label for="">Penerbit</label>
                    <input type="text" name="f_penerbit" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-2">
                    <label for="">Deskripsi</label>
                    <input type="text" name="f_deskripsi" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-2">
                    <label for="">Jumlah Eksemplar</label>
                    <input type="number" name="eksemplar" required class=" form-control">
                </div><br>

                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {

    $kategori = $_POST['f_kategori'];
    $judul = $_POST['f_judul'];
    $pengarang = $_POST['f_pengarang'];
    $penerbit = $_POST['f_penerbit'];
    $deskripsi = $_POST['f_deskripsi'];
    $eksemplar = $_POST['eksemplar'];

    $sql = "INSERT INTO t_buku VALUES('','$kategori','$judul','$pengarang', '$penerbit','$deskripsi')";
    $db->runSQL($sql);

    $t_bukuterakhir = $db->getITEM("SELECT * FROM t_buku ORDER BY f_id DESC LIMIT 1");
    $idbukuterakhir = $t_bukuterakhir['f_id'];
    for ($i = 0; $i < $eksemplar; $i++) {
        $sql = "INSERT INTO t_detailbuku VALUES(NULL, '$idbukuterakhir', 'Tersedia')";
        $db->runSQL($sql);
    }
    echo "<script>window.location.assign('?f=buku&m=select');</script>";
}
?>