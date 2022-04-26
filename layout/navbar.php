<section class="sticky top-0 bg-secondary pt-4 z-10">
  <div class="flex items-center justify-between bg-white rounded p-4 shadow-lg border">
    <div class="flex items-center space-x-4">
      <div class="flex items-center space-x-1">
        <img src='icons/copyright-b.svg' alt='Logo Copyright' class='inline-block h-6 w-6' />
        <p class="text-sm"><span class="font-medium">Imam Alfarizi Syahputra</span> - JWD 3</p>
      </div>
      <span>|</span>
      <span class="text-sm font-medium">My Contact : </span>
      <div class="flex items-center space-x-4">
        <a href="https://github.com/ImamAlfariziSyahputra" target="_blank" class="inline-block">
          <img src='icons/github-b.svg' alt='Logo Github' class='inline-block h-6 w-6 hover:text-hover hover:cursor-pointer' />
        </a>
        <a href="https://www.instagram.com/mamlzy/" target="_blank" class="inline-block">
          <img src='icons/instagram-colorful.svg' alt='Logo Instagram' class='inline-block h-6 w-6 hover:text-hover hover:cursor-pointer' />
        </a>
        <a href="https://web.facebook.com/imam.alfarizi.754" target="_blank" class="inline-block">
          <img src='icons/facebook-blue.svg' alt='Logo Facebook' class='inline-block h-6 w-6 hover:text-hover hover:cursor-pointer' />
        </a>
        <a href="mailto:imam.alfarizi.777@gmail.com" target="_blank" class="inline-block">
          <img src='icons/gmail-colorful.svg' alt='Logo Gmail' class='inline-block h-6 w-6 hover:text-hover hover:cursor-pointer' />
        </a>
      </div>
    </div>

    <div class="flex items-center space-x-2">
      <a href="auth/logout.php" class="inline-block border-x border-gray-400 mr-2 px-3 hover:text-hover hover:cursor-pointer">
        <img src="icons/logout-b.svg" alt="Logo Logout" class='inline-block h-6 w-6'>
        <span>Logout</span>
      </a>
      <div>
        <h4 class="text-sm font-medium"><?= $_SESSION['name'] ?></h4>
        <p class="text-xs text-right"><?= $_SESSION['email'] ?></p>
      </div>

      <a href="auth/logout.php" class="inline-block">
        <img alt="Gambar Profil" src="https://mui.com/static/images/avatar/1.jpg" class='inline-block h-9 w-9 rounded-full hover:text-hover hover:cursor-pointer' />
      </a>
    </div>
  </div>
</section>