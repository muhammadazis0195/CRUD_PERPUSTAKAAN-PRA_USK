<?php
if (isset($_POST['opsi'])) {
    $opsi = $_POST['opsi'];
    $where = "WHERE f_idkategori=$opsi";
} else {
    $opsi = 0;
    $where = "";
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM t_anggota WHERE f_id=$id";
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
        <h3 style="font-family: 'Sriracha', cursive;">Update Anggota</h3>
        <hr>

        <?php
        $t_kategori = $db->getALL("SELECT * FROM t_kategori $where");
        ?>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50 mt-3">
                    <label for="">Nama</label>
                    <input type="text" name="nama" required value="<?php echo $row['f_nama'] ?>" class=" form-control">
                </div>


                <div class="form-group w-50 mt-3">
                    <label for="">Username</label>
                    <input type="text" name="username" required value="<?php echo $row['f_username'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Password</label>
                    <input type="password" name="password" required placeholder="Password" class="form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Tempat Lahir</label>
                    <input type="text" name="tempatlahir" required value="<?php echo $row['f_tempatlahir'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" name="tanggallahir" required value="<?php echo $row['f_tanggallahir'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Kelas</label>
                    <select name="kelas" id="cars" class="form-control">
                      <option value="X">X</option>
                      <option value="XI">XI</option>
                      <option value="XII">XII</option>
                    </select>
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Jurusan</label>
                    <select name="jurusan" id="cars" class=" form-control">
                      <option value="DKV">DKV</option>
                      <option value="RPL">RPL</option>
                      <option value="ANM">ANM</option>
                    </select>
                </div>

                <br>
                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    //Inisialisasi
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $tempatlahir = $_POST['tempatlahir'];
    $tanggallahir = $_POST['tanggallahir'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    //update data
    $sql = "UPDATE t_anggota SET f_nama='$nama', f_username='$username', f_password='$password', f_tempatlahir='$tempatlahir', f_tanggallahir='$tanggallahir', f_kelas='$kelas', f_jurusan='$jurusan' WHERE f_id=$id";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=anggota&m=select');</script>";
}
?>