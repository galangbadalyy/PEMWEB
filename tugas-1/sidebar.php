<div class="list-group">
  <?php if (!isset($_SESSION['MEMBER'])): ?>
    <a href="index.php?hal=studies" class="list-group-item list-group-item-action active" aria-current="true">
      My Studies
    </a>
    <a href="index.php?hal=login" class="list-group-item list-group-item-action">Login</a>
  <?php else: ?>
    <a href="index.php?hal=home" class="list-group-item list-group-item-action active" aria-current="true">
      Home
    </a>
    <a href="index.php?hal=about" class="list-group-item list-group-item-action">About</a>
    <a href="index.php?hal=studies" class="list-group-item list-group-item-action">My Studies</a>
    <a href="index.php?hal=contact" class="list-group-item list-group-item-action">Contact</a>
  <?php endif; ?>
</div>
