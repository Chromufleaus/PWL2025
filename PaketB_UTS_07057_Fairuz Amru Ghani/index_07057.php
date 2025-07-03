<?php
include 'config_07057.php';
require "head.html";
/*	---- cetak data per halaman ---------	*/

//--------- konfigurasi
//jumlah data per halaman
$jmlDataPerHal = 5;

//pencarian data
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    $sql = "select * from products where nama_produk like'%$cari%' or
									id like '%$cari%' or
									kategori like '%$cari%'";
} else {
    $sql = "select * from products";
}

$qry = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
$jmlData = mysqli_num_rows($qry);

// CEIL() digunakan untuk mengembalikan nilai integer terkecil yang lebih besar dari 
//atau sama dengan angka.
$jmlHal = ceil($jmlData / $jmlDataPerHal);

if (isset($_GET['hal'])) {
    $halAktif = $_GET['hal'];
} else {
    $halAktif = 1;
}

$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

//Jika tabel data kosong
$kosong = false;
if (!$jmlData) {
    $kosong = true;
}

//Klausa LIMIT digunakan untuk membatasi jumlah baris yang dikembalikan oleh pernyataan SELECT
//data berdasar pencarian atau tidak
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    $sql = "select * from products where nama_produk like'%$cari%' or
									id like '%$cari%' or
									kategori like '%$cari%'
									limit $awalData,$jmlDataPerHal";
} else {
    $sql = "select * from products limit $awalData,$jmlDataPerHal";
}

//Ambil data untuk ditampilkan
$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

//$hasil = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>

<head>
    <title>UTS PWL 07057</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap533/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap533/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap533/js/bootstrap.js"></script>
</head>

<body>
    <div class="utama">
        <h2 class="text-center">Daftar Produk</h2>
        <span class="float-left">
            <a class="btn btn-success" href="create_07057.php">Tambah Produk</a>
        </span>
        <span class="float-right">
            <form action="" method="post" class="form-inline">
                <button class="btn btn-success" type="submit" name="cari" id="tombol-cari"> Cari</button>
                <input class="form-control mr-2 ml-2" type="text" name="cari" placeholder="cari data produk..."
                    autofocus autocomplete="off" id="keyword">
            </form>
        </span>
        <br><br>

        <ul class="pagination">
            <?php
            //navigasi pagination
            //cetak navigasi back
            if ($halAktif > 1) {
                $back = $halAktif - 1;
                //$back=$halAktif;
                echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
            }
            //cetak angka halaman
            for ($i = 1; $i <= $jmlHal; $i++) {
                if ($i == $halAktif) {
                    echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
                } else {

                    echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
                }
            }
            //cetak navigasi forward
            if ($halAktif < $jmlHal) {
                $forward = $halAktif + 1;
                echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
            }
            ?>
        </ul>
        <div class="container">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>

                    <?php while ($row = $hasil->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama_produk'] ?></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['harga'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td>
                                <a href="edit_07057.php?id=<?= $row['id'] ?>">Edit</a> |
                                <a href="delete_07057.php?id=<?= $row['id'] ?>"
                                    onclick="return confirm('Hapus data?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>