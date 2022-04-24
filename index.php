<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
  require_once __DIR__ . '/db-config.php';

  $sql = "SELECT * FROM books ORDER BY id DESC";
  $statement = $connection->prepare($sql);
  $statement->execute();

  $books = $statement->fetchAll();

  // var_dump($books);
  // exit();
} else {
  header("Location: login.php"); //! if Unauthenticated, Redirect to "Login Page"
  exit();
}
?>

?>

<?php require_once __DIR__ . '/layout/top.php' ?>

<div class=" bg-white rounded p-5 my-6 border shadow text-sm">

  <div className="flex justify-end">
    <a href='add.php' class="flex items-center space-x-2 bg-blue-500 hover:bg-blue-800 text-white p-2.5 px-4 rounded-lg shadow-xl hover:shadow-none font-bold mb-4">
      <!-- <AddIcon fontSize="small" /> -->
      <span>New Post</span>
    </a>
  </div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100">
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
            <td class="py-4 ">
              <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="check-delete.php?id=<?= $book['id'] ?>" class="bg-red-600 hover:bg-red-700 py-1.5 px-2.5 rounded font-medium text-white">Delete</a> -
              <a href="edit.php?id=<?= $book['id'] ?>" class="bg-blue-600 hover:bg-blue-700 py-1.5 px-2.5 rounded font-medium text-white">Edit</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


</div>

<?php require_once __DIR__ . '/layout/bottom.php' ?>