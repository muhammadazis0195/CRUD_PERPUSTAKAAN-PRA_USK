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
        <h3 style="font-family: 'Sriracha', cursive;">Insert Anggota</h3>
        <hr>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50 mt-3">
                    <label for="">Nama</label>
                    <input type="text" name="nama" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Username</label>
                    <input type="text" name="username" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Password</label>
                    <input type="password" name="password" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Tempat Lahir</label>
                    <input type="text" name="tmptlhr" required class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" name="tgllhr" required class=" form-control">
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

    //inisialisasi
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $tmptlhr = $_POST['tmptlhr'];
    $tgllhr = $_POST['tgllhr'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    //insert produk
    $sql = "INSERT INTO t_anggota VALUES('','$nama','$username','$password','$tmptlhr','$tgllhr', '$kelas', '$jurusan')";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=anggota&m=select');</script>";
}
?>