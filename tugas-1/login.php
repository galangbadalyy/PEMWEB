<div class="row justify-content-center mt-5">
  <div class="col-md-4">

    <h4 class="mb-1 fw-semibold">Login</h4>
    <p class="text-muted mb-4" style="font-size:13px;">Masukkan username dan password kamu</p>

    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
      <div class="alert alert-danger py-2" style="font-size:13px;">
        Username atau password salah.
      </div>
    <?php endif; ?>

    <form method="POST" action="controller/loginController.php">

      <div class="mb-3">
        <label class="form-label" style="font-size:14px;">Username</label>
        <input type="text" name="username" class="form-control"
          placeholder="Username"
          value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
          required autofocus>
      </div>

      <div class="mb-4">
        <label class="form-label" style="font-size:14px;">Password</label>
        <input type="password" name="password" class="form-control"
          placeholder="Password" required>
      </div>

      <button type="submit" class="btn btn-dark w-100">Masuk</button>

    </form>

  </div>
</div>