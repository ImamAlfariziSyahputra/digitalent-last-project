<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
  require_once __DIR__ . '/db-config.php';

  $sql = "SELECT * FROM books ORDER BY id DESC";
  $statement = $connection->prepare($sql);
  $statement->execute();

  $books = $statement->fetchAll();
} else {
  $alert = <<<ALERT
    <script>
      alert('Login Terlebih Dahulu, Untuk Mengakses Halaman Web!');
      window.location='auth/login.php';
    </script>
  ALERT;

  echo $alert;
  exit();
}
?>

<?php require_once __DIR__ . '/layout/top.php' ?>

<!-- Header -->
<section>
  <div class="flex items-center mt-4">
    <h1 class="text-2xl pr-4">
      List Buku
    </h1>
  </div>
</section>
<!-- END Header -->

<!-- Content -->
<div class=" bg-white rounded p-5 my-6 border shadow text-sm">

  <div class="flex items-center justify-end space-x-3">
    <button type='button' onclick="printAll();" class="flex space-x-2 items-center bg-yellow-500 hover:bg-yellow-800 text-white p-2.5 px-4 rounded-lg shadow-md hover:shadow-none font-bold mb-4">
      <img src="icons/print-w.svg" alt="" class="w-4">
      <span>Cetak</span>
    </button>
    <a href='book-add.php' class="flex space-x-2 items-center bg-blue-500 hover:bg-blue-800 text-white p-2.5 px-4 rounded-lg shadow-md hover:shadow-none font-bold mb-4">
      <img src="icons/plus-w.svg" alt="" class="w-4">
      <span>Tambah</span>
    </a>
  </div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
          <th scope="col" class="px-6 py-3">
            Judul Buku
          </th>
          <th scope="col" class="px-6 py-3">
            Kategori
          </th>
          <th scope="col" class="px-6 py-3">
            Pengarang
          </th>
          <th scope="col" class="px-6 py-3">
            Penerbit
          </th>
          <th scope="col" class="px-6 py-3">
            Status
          </th>
          <!-- <th scope="col" class="px-6 py-3 text-center">
            Aksi
          </th> -->
          <th scope="col" class="px-6 py-3">
            <span class="sr-only">Aciton</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book) : ?>
          <tr class="bg-white border-b">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <?= $book['judul'] ?>
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <?= $book['kategori'] ?>
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <?= $book['pengarang'] ?>
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <?= $book['penerbit'] ?>
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <?= $book['status'] ?>
            </th>
            <td class="flex justify-content-evenly items-center space-x-1.5 py-4">
              <button type="button" onclick="printSingle(<?= $book['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-600 py-1.5 px-2.5 rounded font-medium text-white">Cetak</button>
              <span> - </span>
              <a href="book-edit.php?id=<?= $book['id'] ?>" class="bg-green-600 hover:bg-green-700 py-1.5 px-2.5 rounded font-medium text-white">Edit</a>
              <span> - </span>
              <form action="logic/buku/delete.php" method="POST">
                <input type="text" class='hidden' name='id' value='<?= $book['id'] ?>'>
                <button type="submit" onclick="return confirm(' Apakah yakin data akan di hapus?')" class="block bg-red-600 hover:bg-red-700 py-1.5 px-2.5 rounded font-medium text-white">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


</div>
<!-- END Content -->

<?php require_once __DIR__ . '/layout/bottom.php' ?>

<script>
  function printAll() {
    let printWindow = window.open('http://localhost:3000/project/tugas-akhir/print/book-all.php', '_blank', `width=${screen.availWidth}`, `height=${screen.availHeight}`);

    printWindow.print();
  }

  function printSingle(id) {
    let printWindow = window.open(`http://localhost:3000/project/tugas-akhir/print/book-single.php?id=${id}`, '_blank', `width=${screen.availWidth}`, `height=${screen.availHeight}`);

    printWindow.print();
  }
</script>