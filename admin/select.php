<?php 
$jumlahdata = $db->rowCOUNT("SELECT f_id FROM t_admin");
$banyak = 5;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
	$p = $_GET['p'];
	$mulai = ($p * $banyak) - $banyak;
} else {
	$mulai = 0;
}

$sql = "SELECT * FROM t_admin ORDER BY f_id ASC LIMIT $mulai, $banyak";
$row = $db->getALL($sql);
$no = 1 + $mulai;
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>PERPUSTAKAAN PRA USK</title>
 	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&family=Reggae+One&family=Sriracha&display=swap" rel="stylesheet">
 	<style type="text/css">
        body{
        font-family: 'Sriracha', cursive
    }
 		.warna {
            background-color: #fad4ff;
        }

        .warna1 {
            background-color: #fef5ff;
        }
        th{
        	background-color: #2596be;
        }
        th, td{
        	margin: 10px;
        	text-align-last: center;
        	padding: 10px;
        }
        .nav-link{color: #f9e45b}

        .red:hover{
        	background-color: red;
        	border: red;
        }
        .pagination{
            justify-content: center;
        }
 	</style>
 </head>
 <body>
 	<form id="compose" class="compose" method="post" action="" enctype="multipart/form-data">
 		<strong>
 			<center>
 				<h2 style="font-family: 'Sriracha', cursive;">ADMIN</h2>
 				<hr>
 				<hr>
 			</center>
 		</strong>

 		<div class="mt-5">
 			<div class="container">
 				<br>
 				<br>

 				<table width="100%">
 					<thead>
	 					<tr>
	 						<th>NO</th>
	 						<th>ADMIN</th>
	 						<th>USERNAME</th>
	 						<th>PASSWORD</th>
	 						<th>LEVEL</th>
	 						<th>STATUS</th>
	 						<th>UPDATE</th>
	 						<th>DELETE</th>
	 					</tr>
 					</thead>
 					<tbody>
 						<?php if (!empty($row)) { ?>
 							<?php foreach ($row as $r) : ?>
 								<tr>
 									<td bgcolor="#2596be"><?php echo $no++ ?></td>
 									<td><?php echo $r['f_nama'] ?></td>
 									<td><?php echo $r['f_username'] ?></td>
 									<td><?php echo $r['f_password'] ?></td>
 									<td><?php echo $r['f_level'] ?></td>
 									<td><?php echo $r['f_status'] ?></td>
 									<td><a a style="color:black;" href="?f=admin&m=update&id=<?php echo $r['f_id'] ?>"><button type="button" class="btn btn-outline-success">Update</button></a></td>
                                    <td><a a style="color:black;" href="?f=admin&m=delete&id=<?php echo $r['f_id'] ?>"><button type="button" class="btn btn-outline-danger red">Delete</button></a></td>
 								</tr>
 							<?php endforeach ?>
 						<?php } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</form>	



 </body>
 </html>


 <nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination  my-4">
        <?php

        for ($i = 1; $i <= $halaman; $i++) {
            echo '<li class="page-item"><a class="page-link" style="color:black;" href="?f=admin&m=select&p=' . $i . '">' . $i . '</a></li>';
        }

        ?>
    </ul>
</nav>