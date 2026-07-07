<?php
/**
 * footer.php
 * -----------------------------------------------------------------------
 * Site footer: social links, copyright, back-to-top button.
 * Also responsible for loading the global JavaScript bundle.
 * -----------------------------------------------------------------------
 */
?>
  <footer class="site-footer">
    <div class="container footer-inner">
      <div class="footer-brand">
        <span class="logo-mark">AM</span>
        <p><?= e(SITE_TAGLINE) ?></p>
      </div>

      <div class="footer-socials" aria-label="Social media links">
        <?php foreach (SOCIAL_LINKS as $name => $data): ?>
          <a href="<?= e($data['url']) ?>" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="<?= e($name) ?>">
            <i class="<?= e($data['icon']) ?>"></i>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="footer-nav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="projects.php">Projects</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= e((string) CURRENT_YEAR) ?> <?= e(SITE_NAME) ?>. All rights reserved.</p>
      <p class="footer-crafted">Designed &amp; built from scratch with PHP.</p>
    </div>
  </footer>

  <!-- Back to top -->
  <button id="backToTop" class="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <!-- Toast notification container (used by contact form) -->
  <div id="toastContainer" class="toast-container" aria-live="polite"></div>

  <script src="<?= ASSETS_PATH ?>/js/main.js" defer></script>
</body>
</html>
