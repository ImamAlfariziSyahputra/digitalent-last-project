<?php

require __DIR__ . '/../../db-config.php';

$id = $_POST['id'];
$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$status = $_POST['status'];

$sql = "UPDATE books SET judul = ?, kategori = ?, pengarang = ?, penerbit = ?, status = ? WHERE id = ?";

$statement = $connection->prepare($sql);
$statement->execute([$judul, $kategori, $pengarang, $penerbit, $status, $id]);
$count = $statement->rowCount();

// var_dump($count);
// exit();

if ($count == 1) {
  $alert = <<<ALERT
      <script>
        alert('Update Data Sucess!');
        window.location='../../book.php'
      </script>
    ALERT;

  echo $alert;
  exit();
} else {
  $alert = <<<ALERT
      <script>
        alert('Edit Data Gagal!');
        window.location='../../book-edit.php?id=<?= $id ?>'
      </script>
    ALERT;

  echo $alert;
  exit();
}
