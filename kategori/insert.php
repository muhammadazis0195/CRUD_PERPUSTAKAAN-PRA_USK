<style type="text/css">
    .nav-link{color: #f9e45b;}
</style>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
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
        <h3 style="font-family: 'Sriracha', cursive;">Insert Kategori</h3>
        <hr>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50">
                    <label for="">Kategori</label>
                    <input type="text" name="namakategori" required class=" form-control">
                </div><br>
                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {

    //inisialisasi
    $namakategori = $_POST['namakategori'];

    //insert produk
    $sql = "INSERT INTO t_kategori VALUES('','$namakategori')";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=kategori&m=select');</script>";
}
?>