<?php
session_start();

$id = $_GET['id'];

// if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
require_once __DIR__ . '/../db-config.php';

$sql = "SELECT * FROM books WHERE id = ?";
$statement = $connection->prepare($sql);
$statement->execute([$id]);

if ($book = $statement->fetch()) {
} else {
  $alert = <<<ALERT
    <script>
      alert('Data tersebut tidak ditemukan!');
      window.location='../../book.php'
    </script>
  ALERT;

  echo $alert;
  exit();
}

// var_dump($books);
// exit();
// } else {
//   header("Location: login.php"); //! if Unauthenticated, Redirect to "Login Page"
//   exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style id="table_style" type="text/css">
    body {
      font-family: Arial;
      font-size: 10pt;
    }

    table {
      border: 1px solid #ccc;
      border-collapse: collapse;
    }

    table th {
      background-color: #F7F7F7;
      color: #333;
      font-weight: bold;
      padding: 0.8rem;
      text-align: center;
    }

    table td {
      padding: 0.7rem;
    }

    table td:nth-child(1) {
      text-align: center;
    }

    table th,
    table td {
      border: 1px solid #ccc;
    }
  </style>
</head>

<body>
  <div id="tableWrapper">
    <table cellspacing="0" rules="all" border="1">
      <tr>
        <th>ID</th>
        <th>Judul Buku</th>
        <th>Kategori</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Status</th>
      </tr>
      <tr>
        <td><?= $book['id'] ?></td>
        <td><?= $book['judul'] ?></td>
        <td><?= $book['kategori'] ?></td>
        <td><?= $book['pengarang'] ?></td>
        <td><?= $book['penerbit'] ?></td>
        <td><?= $book['status'] ?></td>
      </tr>
    </table>
  </div>

</body>


</html>