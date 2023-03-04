<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM t_buku WHERE f_id=$id";
    $row = $db->getITEM($sql);
}

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
        <h3 style="font-family: 'Sriracha', cursive;">Update Buku</h3>
        <hr>
        <?php
        $t_kategori = $db->getALL("SELECT * FROM t_kategori");
        ?>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50 mt-3">
                    <label for="">Kategori</label>
                    <select class="form-control" name="kategori">
                        <?php foreach ($t_kategori as $isi) : ?>
                            <option reqired value="<?php echo $isi['f_id'] ?>"><?php echo $isi['f_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Judul</label>
                    <input type="text" name="judul" required value="<?php echo $row['f_judul'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Pengarang</label>
                    <input type="text" name="pengarang" required value="<?php echo $row['f_pengarang'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Penerbit</label>
                    <input type="text" name="penerbit" required value="<?php echo $row['f_penerbit'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">:
                    <div class="form-group w-50 mt-3">
                        <label for="">Gambar Buku</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Deskripsi</label>
                    <input type="text" name="deskripsi" required value="<?php echo $row['f_deskripsi'] ?>" class=" form-control">
                </div><br>

                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    //Inisialisasi
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    //Menyimpan Gambar
    $folder = "../images/";
    move_uploaded_file($_FILES['gambar']['tmp_name'], $folder.$gambar);

    //update data
    $sql = "UPDATE t_buku SET f_idkategori='$kategori',f_judul='$judul',f_pengarang='$pengarang',f_penerbit='$penerbit',f_deskripsi='$deskripsi',f_gambar='$gambar' WHERE f_id=$id";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=buku&m=select');</script>";
}
?>
