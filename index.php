<?php
/**
 * index.php — Home page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = SITE_TITLE;
$pageDescription = SITE_DESCRIPTION;
$pageSlug        = '';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<main>

  <!-- ============ HERO ============ -->
  <section class="hero container">
    <div class="hero-grid">
      <div class="hero-copy">
        <p class="hero-eyebrow reveal">Hi, my name is</p>
        <h1 class="reveal">
          <?= e(SITE_AUTHOR) ?><br>
          <span class="text-gradient">I build things for the web.</span>
        </h1>
        <p class="hero-type reveal" style="font-size:1.3rem;font-family:var(--font-display);color:var(--text-dim);">
          <span id="typedText" data-words='["Product Engineer.","UI/UX Designer.","Full-Stack Developer.","Performance Nerd."]'></span><span class="cursor">&nbsp;</span>
        </p>
        <p class="lead reveal">
          I design and build fast, accessible, and elegant digital products —
          turning complex problems into clean interfaces and reliable code.
        </p>
        <div class="hero-actions reveal">
          <a href="<?= e(CV_FILE) ?>" class="btn btn-primary ripple" download>
            <i class="fa-solid fa-download"></i> Download CV
          </a>
          <a href="contact.php" class="btn btn-ghost ripple">
            <i class="fa-solid fa-paper-plane"></i> Get in Touch
          </a>
        </div>
        <div class="hero-stats reveal">
          <div class="hero-stat">
            <h3 class="counter-num" data-target="4" data-suffix="+">0</h3>
            <span>Years Experience</span>
          </div>
          <div class="hero-stat">
            <h3 class="counter-num" data-target="40" data-suffix="+">0</h3>
            <span>Projects Shipped</span>
          </div>
          <div class="hero-stat">
            <h3 class="counter-num" data-target="18" data-suffix="+">0</h3>
            <span>Happy Clients</span>
          </div>
        </div>
      </div>

      <div class="hero-portrait reveal-scale">
        <span class="hero-portrait-ring"></span>
        <div class="hero-portrait-img">
          <img src="<?= ASSETS_PATH ?>/images/profile.jpg" alt="Portrait of <?= e(SITE_AUTHOR) ?>" width="400" height="400" loading="eager">
        </div>
        <div class="float-chip chip-1"><i class="fa-brands fa-php" style="color:#8b93ff"></i> PHP</div>
        <div class="float-chip chip-2"><i class="fa-brands fa-js" style="color:#f7df1e"></i> JavaScript</div>
        <div class="float-chip chip-3"><i class="fa-solid fa-palette" style="color:#56e0ff"></i> UI Design</div>
      </div>
    </div>

    <div class="scroll-cue"><span class="mouse"></span> Scroll</div>
  </section>

  <!-- ============ ABOUT PREVIEW ============ -->
  <section class="section container">
    <div class="section-head reveal">
      <p class="eyebrow">About Me</p>
      <h2>Crafting digital experiences with precision &amp; care.</h2>
      <p>I'm a product engineer who bridges design and engineering — obsessed with
         performance, accessibility, and the small details that make an interface feel alive.</p>
    </div>
    <div class="counters stagger">
      <?php
      $stats = [
        ['num' => 40, 'suffix' => '+', 'label' => 'Projects Completed'],
        ['num' => 18, 'suffix' => '+', 'label' => 'Clients Worldwide'],
        ['num' => 4,  'suffix' => '+', 'label' => 'Years of Experience'],
        ['num' => 99, 'suffix' => '%', 'label' => 'Client Satisfaction'],
      ];
      foreach ($stats as $i => $s): ?>
        <div class="glass-card counter-card reveal-scale" style="--i:<?= $i ?>">
          <h3 class="counter-num" data-target="<?= $s['num'] ?>" data-suffix="<?= e($s['suffix']) ?>">0</h3>
          <p class="counter-label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ============ FEATURED PROJECTS PREVIEW ============ -->
  <section class="section container">
    <div class="section-head reveal">
      <p class="eyebrow">Selected Work</p>
      <h2>Projects I'm proud of.</h2>
      <p>A mix of client work and personal experiments — spanning web apps, dashboards, and design systems.</p>
    </div>

    <div class="projects-grid stagger">
      <?php
      require_once __DIR__ . '/includes/projects-data.php';
      $featured = array_slice($projects, 0, 2);
      foreach ($featured as $i => $p): ?>
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

    <div class="flex-center" style="margin-top:48px;">
      <a href="projects.php" class="btn btn-ghost ripple">View All Projects <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </section>

  <!-- ============ CTA ============ -->
  <section class="section container">
    <div class="glass-card reveal" style="text-align:center;padding:70px 40px;">
      <h2 style="font-size:clamp(1.8rem,4vw,2.6rem);margin-bottom:18px;">Have a project in mind? <span class="text-gradient">Let's build it.</span></h2>
      <p style="color:var(--text-dim);max-width:520px;margin-inline:auto;margin-bottom:32px;">
        I'm currently available for freelance work and full-time opportunities.
      </p>
      <a href="contact.php" class="btn btn-primary ripple"><i class="fa-solid fa-paper-plane"></i> Start a Conversation</a>
    </div>
  </section>

</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
