<?php
/**
 * navbar.php
 * -----------------------------------------------------------------------
 * Floating capsule (pill) navigation bar. The active link is detected
 * server-side via is_active_page() and a sliding highlight is animated
 * client-side in main.js.
 * -----------------------------------------------------------------------
 */
$navItems = [
    'index'      => ['label' => 'Home',       'href' => 'index.php'],
    'about'      => ['label' => 'About',      'href' => 'about.php'],
    'skills'     => ['label' => 'Skills',     'href' => 'skills.php'],
    'projects'   => ['label' => 'Projects',   'href' => 'projects.php'],
    'experience' => ['label' => 'Experience', 'href' => 'experience.php'],
    'contact'    => ['label' => 'Contact',    'href' => 'contact.php'],
];
?>
<header class="site-nav-wrap">
  <nav class="pill-nav" id="pillNav" aria-label="Primary navigation">
    <a href="index.php" class="pill-logo" aria-label="<?= e(SITE_NAME) ?> — Home">
      <span class="logo-mark">AM</span>
    </a>

    <ul class="pill-links" id="pillLinks">
      <?php foreach ($navItems as $key => $item): ?>
        <li>
          <a href="<?= e($item['href']) ?>"
             class="pill-link <?= is_active_page($key) ?>"
             data-key="<?= e($key) ?>">
            <?= e($item['label']) ?>
          </a>
        </li>
      <?php endforeach; ?>
      <span class="pill-indicator" id="pillIndicator" aria-hidden="true"></span>
    </ul>

    <a href="<?= e(CV_FILE) ?>" class="pill-cta ripple" download>
      <i class="fa-solid fa-download"></i><span>Resume</span>
    </a>

    <button class="pill-burger" id="pillBurger" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobileMenu">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- Mobile slide-down menu -->
  <div class="mobile-menu" id="mobileMenu">
    <?php foreach ($navItems as $key => $item): ?>
      <a href="<?= e($item['href']) ?>" class="<?= is_active_page($key) ?>"><?= e($item['label']) ?></a>
    <?php endforeach; ?>
    <a href="<?= e(CV_FILE) ?>" class="mobile-cta" download>Download Resume</a>
  </div>
</header>
