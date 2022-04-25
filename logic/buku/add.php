<?php
session_start();

require_once __DIR__ . '/../../db-config.php';

$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$status = $_POST['status'];

// var_dump(
//   $judul,
//   $kategori,
//   $pengarang,
//   $penerbit,
//   $status,
// );
// exit();

$sql = "INSERT INTO books(judul,kategori,pengarang,penerbit,status) VALUES( ? , ? , ? , ? , ? )";
$statement = $connection->prepare($sql);
$statement->execute([$judul, $kategori, $pengarang, $penerbit, $status]);
$count = $statement->rowCount();

// var_dump($count);
// exit();

if ($count == 1) {
  $alert = <<<ALERT
    <script>
      alert('Tambah Data Sucess!');
      window.location='../../book.php'
    </script>
  ALERT;

  echo $alert;
  exit();
} else {
  $alert = <<<ALERT
    <script>
      alert('Tambah Data Gagal!');
      window.location='../../book-add.php'
    </script>
  ALERT;

  echo $alert;
  exit();
}
