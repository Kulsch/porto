<?php
/**
 * experience.php — Experience / work history page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = 'Experience — ' . SITE_NAME;
$pageDescription = 'Work history and professional experience of ' . SITE_AUTHOR . '.';
$pageSlug        = 'experience.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$experience = [
    [
        'date'    => '2024 — Present',
        'role'    => 'Senior Product Engineer',
        'company' => 'Northlight Studio · Remote',
        'desc'    => 'Leading frontend architecture for client products; introduced a shared component library that cut delivery time by 30%.',
    ],
    [
        'date'    => '2022 — 2024',
        'role'    => 'Full-Stack Developer',
        'company' => 'Vantage Digital · Remote',
        'desc'    => 'Built and maintained PHP/MySQL backends for six client platforms, focusing on performance and security hardening.',
    ],
    [
        'date'    => '2021 — 2022',
        'role'    => 'Frontend Developer',
        'company' => 'Pixel Foundry · Hybrid',
        'desc'    => 'Translated Figma designs into responsive, accessible interfaces for early-stage startups.',
    ],
    [
        'date'    => '2020 — 2021',
        'role'    => 'Junior Web Developer',
        'company' => 'Freelance',
        'desc'    => 'Delivered WordPress and custom PHP sites for small businesses, handling everything from design to deployment.',
    ],
];
?>
<main>
  <section class="section container">
    <div class="section-head center reveal">
      <p class="eyebrow" style="justify-content:center;">Career Path</p>
      <h2>Where I've worked.</h2>
      <p>A timeline of roles that shaped how I build products today.</p>
    </div>

    <div class="timeline">
      <?php foreach ($experience as $i => $item): ?>
        <div class="timeline-item reveal" style="--i:<?= $i ?>">
          <span class="timeline-dot"></span>
          <span class="timeline-date"><?= e($item['date']) ?></span>
          <h3><?= e($item['role']) ?></h3>
          <h4><?= e($item['company']) ?></h4>
          <p><?= e($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="flex-center" style="margin-top:20px;">
      <a href="<?= e(CV_FILE) ?>" class="btn btn-primary ripple" download><i class="fa-solid fa-download"></i> Download Full CV</a>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
