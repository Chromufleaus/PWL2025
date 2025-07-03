<?php
include 'config_07057.php';
require "head.html";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $koneksi->query("INSERT INTO products (nama_produk, kategori, harga, stok) VALUES ('$nama_produk',
'$kategori', '$harga', '$stok')");
    header("Location: index_07057.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Produk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap533/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap533/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap533/js/bootstrap.js"></script>
</head>

<body>
    <div class="utama">
        <h2 class="text-center">Tambah Pengguna</h2>
        <div class="form-group">
            <form method="POST">
                <table>
                    <tr>
                        <td>Nama Produk</td>
                        <td>: <input class="form-control-ku" type="text" name="nama_produk" required></td> <br>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>: <input class="form-control-ku" type="text" name="kategori" required></td> <br>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>: <input class="form-control-ku" type="text" name="harga" required></td> <br>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>: <input class="form-control-ku" type="number" name="stok" required></td> <br>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>