<?php
/**
 * skills.php — Skills page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = 'Skills — ' . SITE_NAME;
$pageDescription = 'Technical skills and tools used by ' . SITE_AUTHOR . ' across frontend, backend, and design.';
$pageSlug        = 'skills.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

// Data for the animated progress bars
$barSkills = [
    ['name' => 'PHP',              'pct' => 92],
    ['name' => 'JavaScript (ES6+)','pct' => 90],
    ['name' => 'HTML5 / CSS3',     'pct' => 96],
    ['name' => 'MySQL',            'pct' => 85],
    ['name' => 'React',            'pct' => 80],
];

// Data for circular indicators
$circleSkills = [
    ['name' => 'UI/UX Design', 'pct' => 88],
    ['name' => 'Node.js',      'pct' => 78],
    ['name' => 'DevOps',       'pct' => 70],
];

// Tech badges
$techStack = [
    ['name' => 'PHP',        'icon' => 'fa-brands fa-php'],
    ['name' => 'JavaScript', 'icon' => 'fa-brands fa-js'],
    ['name' => 'HTML5',      'icon' => 'fa-brands fa-html5'],
    ['name' => 'CSS3',       'icon' => 'fa-brands fa-css3-alt'],
    ['name' => 'React',      'icon' => 'fa-brands fa-react'],
    ['name' => 'Node.js',    'icon' => 'fa-brands fa-node-js'],
    ['name' => 'Git',        'icon' => 'fa-brands fa-git-alt'],
    ['name' => 'Docker',     'icon' => 'fa-brands fa-docker'],
    ['name' => 'Figma',      'icon' => 'fa-brands fa-figma'],
    ['name' => 'Linux',      'icon' => 'fa-brands fa-linux'],
];
?>
<main>
  <section class="section container">
    <div class="section-head center reveal">
      <p class="eyebrow" style="justify-content:center;">Skills &amp; Tools</p>
      <h2>What I bring to the table.</h2>
      <p>A blend of engineering depth and design sensibility, refined over four years of shipping products.</p>
    </div>

    <div class="skills-layout">
      <div class="reveal">
        <h3 style="font-size:1.3rem;margin-bottom:28px;">Core Proficiencies</h3>
        <?php foreach ($barSkills as $s): ?>
          <div class="skill-bar-item">
            <div class="skill-bar-top">
              <span><?= e($s['name']) ?></span>
              <span class="pct"><?= (int) $s['pct'] ?>%</span>
            </div>
            <div class="skill-bar-track">
              <div class="skill-bar-fill" data-pct="<?= (int) $s['pct'] ?>"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="reveal">
        <h3 style="font-size:1.3rem;margin-bottom:28px;">Additional Strengths</h3>
        <div class="circular-grid">
          <!-- Shared SVG gradient definition -->
          <svg width="0" height="0" style="position:absolute;">
            <defs>
              <linearGradient id="circGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#5b8cff"/>
                <stop offset="100%" stop-color="#9b6bff"/>
              </linearGradient>
            </defs>
          </svg>
          <?php foreach ($circleSkills as $c): ?>
            <div class="circular-item">
              <div class="circular-svg">
                <svg width="108" height="108" viewBox="0 0 108 108">
                  <circle class="track" cx="54" cy="54" r="48"></circle>
                  <circle class="fill" cx="54" cy="54" r="48" data-pct="<?= (int) $c['pct'] ?>"></circle>
                </svg>
                <span class="circular-pct"><?= (int) $c['pct'] ?>%</span>
              </div>
              <p><?= e($c['name']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <h3 style="font-size:1.3rem;margin:44px 0 8px;">Tech Stack</h3>
        <div class="tech-badges">
          <?php foreach ($techStack as $t): ?>
            <span class="tech-badge"><i class="<?= e($t['icon']) ?>"></i> <?= e($t['name']) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
