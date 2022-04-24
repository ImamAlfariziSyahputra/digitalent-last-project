<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #f7f7f7;
    }

    .font-montserrat {
      font-family: 'Montserrat', sans-serif;
    }

    .bg-secondary {
      background-color: #f7f7f7;
    }

    .text-primary {
      color: #827aa1;
    }

    .text-secondary {
      color: #a6a4b0;
    }

    .shadow-bottom {
      box-shadow: 0 0 10px 7px rgb(255 255 255 / 70%);
    }

    .text-hover {
      color: #7367f0;
    }

    .active {
      position: relative;
      background: linear-gradient(118deg, #7367f0, rgba(115, 103, 240, 0.7));
      box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
    }
  </style>
</head>

<body>

  <div class="flex text-primary font-montserrat">
    <!-- Sidebar -->
    <?php require_once __DIR__ . '/sidebar.php' ?>
    <!-- END Sidebar -->

    <section class="flex-grow mx-5">
      <!-- Navbar -->
      <?php require_once __DIR__ . '/navbar.php' ?>
      <!-- END Navbar -->

      <!-- Header -->
      <section>
        <div class="flex items-center mt-4">
          <h1 class="text-2xl font-medium pr-4 border-r border-gray-300">
            Books
          </h1>
          <Breadcrumbs />
        </div>
      </section>
      <!-- END Header -->

      <!-- Content -->