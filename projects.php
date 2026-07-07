<?php
/**
 * projects.php — Projects page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = 'Projects — ' . SITE_NAME;
$pageDescription = 'Selected projects by ' . SITE_AUTHOR . ' spanning web apps, mobile apps, and UI/UX design.';
$pageSlug        = 'projects.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
require_once __DIR__ . '/includes/projects-data.php';

// Build the unique category list for the filter bar
$categories = array_values(array_unique(array_column($projects, 'category')));
?>
<main>
  <section class="section container">
    <div class="section-head reveal">
      <p class="eyebrow">Portfolio</p>
      <h2>Things I've built.</h2>
      <p>Filter by category to explore web apps, mobile builds, and design system work.</p>
    </div>

    <div class="filter-bar reveal" role="tablist" aria-label="Filter projects by category">
      <button class="filter-btn active" data-filter="all">All</button>
      <?php foreach ($categories as $cat): ?>
        <button class="filter-btn" data-filter="<?= e($cat) ?>"><?= e($cat) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="projects-grid stagger">
      <?php foreach ($projects as $i => $p): ?>
        <article class="project-card reveal-scale" style="--i:<?= $i ?>" data-category="<?= e($p['category']) ?>">
          <div class="project-thumb">
            <img src="<?= e($p['image']) ?>" alt="<?= e($p['title']) ?> preview" loading="lazy">
            <div class="project-overlay">
              <a href="<?= e($p['github']) ?>" class="project-icon-btn" aria-label="View source on GitHub" target="_blank" rel="noopener"><i class="fa-brands fa-github"></i></a>
              <a href="<?= e($p['demo']) ?>" class="project-icon-btn" aria-label="View live demo" target="_blank" rel="noopener"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </div>
          </div>
          <div class="project-body">
            <span class="project-cat"><?= e($p['category']) ?></span>
            <h3><?= e($p['title']) ?></h3>
            <p><?= e($p['summary']) ?></p>
            <div class="project-tags">
              <?php foreach ($p['tags'] as $tag): ?><span><?= e($tag) ?></span><?php endforeach; ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
