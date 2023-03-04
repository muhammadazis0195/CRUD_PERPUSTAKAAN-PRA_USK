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
    $sql = "SELECT * FROM t_kategori WHERE f_id=$id";
    $row = $db->getITEM($sql);
}
?>

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
        <h3 style="font-family: 'Sriracha', cursive;">Update Kategori</h3>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50">
                    <label for="">Kategori</label>
                    <input type="text" name="f_kategori" required value="<?php echo $row['f_kategori'] ?>" class=" form-control">
                </div><br>
                <button type="submit" name="simpan" value="simpan" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $f_kategori = $_POST['f_kategori'];

    $sql = "UPDATE t_kategori SET f_kategori='$f_kategori' WHERE f_id=$id";
    $db->runSQL($sql);
    echo "<script>window.location.assign('?f=kategori&m=select');</script>";
}
?>