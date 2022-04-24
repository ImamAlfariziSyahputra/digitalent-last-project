<?php
session_start();

require_once __DIR__ . './../db-config.php';

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
$newData = $statement->execute([$judul, $kategori, $pengarang, $penerbit, $status]);

// var_dump($newData);

if ($newData === true) {
  header("Location: ./../buku.php"); //! Redirect to "Home Page"
  exit();
} else {
  echo "Tambah Data Gagal!";
}

if ($updatedData == true) {
  $alert = <<<ALERT
    <script>
      alert('Tambah Data Sucess!');
      window.location='./../biodata.php'
    </script>
  ALERT;

  echo $alert;
  exit();

  // header("Location: ./../home.php"); //! Redirect to "Home Page"
  // exit();
} else {
  $alert = <<<ALERT
    <script>
      alert('Tambah Data Gagal!');
      window.location='./../add.php'
    </script>
  ALERT;

  echo $alert;
  exit();
}
