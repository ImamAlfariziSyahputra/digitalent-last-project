<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
  require_once __DIR__ . '/db-config.php';

  $perPage = 1;

  // $sql = "SELECT * FROM books ORDER BY id DESC";
  $sql = "SELECT count(*) FROM books";
  $statement = $connection->query($sql);

  // Calculate Total pages
  $total_results = $statement->fetchColumn();
  $total_pages = ceil($total_results / $perPage);

  // Current page
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $starting_limit = ($page - 1) * $perPage;

  // Query to fetch books
  $sql = 'SELECT * FROM books ORDER BY id DESC LIMIT';
  $query = "$sql $starting_limit,$perPage";

  $books = $connection->query($query)->fetchAll();

  // var_dump($books);
  // exit();
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

  <!-- Buttons -->
  <div class="flex items-center justify-between">

    <!-- Add, Print Button -->
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
    <!-- END Add, Print Button -->

    <!-- Search Input -->
    <form class="flex items-center">
      <label for="simple-search" class="sr-only">Search</label>
      <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <img src="icons/search-gray.svg" alt="" class="h-5 w-5">
        </div>
        <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:outline-purple-400 block w-full pl-10 p-2.5" placeholder="Search" required>
      </div>
      <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-purple-700 rounded-lg border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300">
        <img src="icons/search-w.svg" alt="" class="h-5 w-5">
      </button>
    </form>
    <!-- END Search Input -->
  </div>
  <!-- END Buttons -->

  <!-- Table Data -->
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
  <!-- END Table Data -->

  <!-- Pagination -->
  <div class="flex items-center justify-between">
    <!-- Help text -->
    <span class="text-sm text-gray-700">
      Jumlah Data : <span class="font-semibold text-gray-900"><?= $total_results ?></span>
    </span>
    <!-- Buttons -->
    <div class="inline-flex mt-2 xs:mt-0">
      <?php $previousPage = $_GET['page'] - 1 ?>
      <a href="<?= "?page=$previousPage" ?>" class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 <?= $_GET['page'] == 1 ? '!hidden' : '' ?>">
        Previous
      </a>
      <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
        <a href="<?= "?page=$page" ?>" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 <?= $page == $_GET['page'] ? 'bg-blue-400 !text-white border-blue-400 hover:bg-blue-500 hover:text-white' : '' ?>">
          <?= $page; ?>
        </a>
      <?php endfor; ?>
      <?php $nextPage = $_GET['page'] + 1 ?>
      <a href="<?= "?page=$nextPage" ?>" class="py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 <?= $_GET['page'] == $total_pages ? '!hidden' : '' ?>">Next</a>
    </div>
  </div>
  <!-- END Pagination -->


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