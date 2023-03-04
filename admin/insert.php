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
        <h3 style="font-family:Georgia, 'Times New Roman', Times, serif;">Insert Admin</h3>
        <hr>

        <div class="form-group">
            <form action="" method="post">
                <div class="form-group w-50 mt-3">
                    <label for="">Nama</label>
                    <input type="text" name="nama" class="form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Level</label><br>
                    <select name="level" id="" class="form-control">
                        <option value="Pilih">Pilih...</option>
                        <option value="Admin">Admin</option>
                        <option value="Pustakawan">Pustakawan</option>
                    </select>
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Status</label><br>
                    <select name="status" id="" class="form-control">
                        <option value="Pilih">Pilih...</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div> <br>

                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $status = $_POST['status'];

    $sql = "INSERT INTO t_admin VALUES ('','$nama','$username','$password','$level','$status')";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=admin&m=select');</script>";
}

?>