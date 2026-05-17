<?php
function isActive($page) {
    $current = $_GET['hal'] ?? 'home';  // ambil nilai ?hal= dari URL
    return $current === $page ? 'active' : '';  // kalau sama, return 'active'
}

function isDropdownActive($pages) {
    $current = $_GET['hal'] ?? 'home';
    return in_array($current, $pages) ? 'show' : '';  // cek apakah halaman ada di dalam dropdown
}
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">

    <!-- Logo & Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.php?hal=home">
      <img src="img/sttnf.png" alt="Logo" width="40" class="me-2">
      My Portfolio
    </a>

    <!-- Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Menu -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if (!isset($_SESSION['MEMBER'])): ?>
          <!-- Guest: hanya Studies -->
          <li class="nav-item">
            <a class="nav-link <?= isActive('studies') ?>" href="index.php?hal=studies">
              My Studies
            </a>
          </li>
        <?php else: ?>
          <!-- Logged in: bebas akses menu -->
          <li class="nav-item">
            <a class="nav-link <?= isActive('home') ?>" aria-current="page"
              href="index.php?hal=home">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= isActive('about') ?>"
              href="index.php?hal=about">About Me</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= isActive('contact') ?>"
              href="index.php?hal=contact">Contact</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= isActive('studies') ?>" href="index.php?hal=studies">
              My Studies
            </a>
          </li>
        <?php endif; ?>

        <!-- Login / User -->
        <?php
        if (!isset($_SESSION['MEMBER'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link"
              href="index.php?hal=login">
              Login
            </a>
          </li>

        <?php
        } else {
        ?>

          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">

              <?= $_SESSION['MEMBER']['username'] . ' - ' . $_SESSION['MEMBER']['role'] ?>

            </a>

            <ul class="dropdown-menu">

              <li>
                <a class="dropdown-item" href="#">
                  Profile
                </a>
              </li>

              <?php
              if ($_SESSION['MEMBER']['role'] == 'admin') {
              ?>
                <li>
                  <a class="dropdown-item" href="#">
                    Manage Users
                  </a>
                </li>
              <?php } ?>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item" href="logout.php">
                  Logout
                </a>
              </li>

            </ul>
          </li>

        <?php } ?>

      </ul>

      <!-- Search -->
      <form class="d-flex" role="search">
        <input class="form-control me-2"
          type="text"
          name="keyword"
          placeholder="Search portfolio..."
          aria-label="Search">

        <button class="btn btn-outline-success"
          type="submit">
          Search
        </button>

        <input type="hidden" name="hal" value="produk_cari" />
      </form>

    </div>
  </div>
</nav>