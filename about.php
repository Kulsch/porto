<?php
/**
 * about.php — About page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = 'About — ' . SITE_NAME;
$pageDescription = 'Learn more about ' . SITE_AUTHOR . ', a product engineer focused on building fast, elegant digital experiences.';
$pageSlug        = 'about.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<main>
  <section class="section container">
    <div class="section-head reveal">
      <p class="eyebrow">About Me</p>
      <h2>The person behind the code.</h2>
    </div>

    <div class="about-grid">
      <div class="about-photo reveal-scale">
        <img src="<?= ASSETS_PATH ?>/images/about.jpg" alt="<?= e(SITE_AUTHOR) ?> working at a desk" loading="lazy">
      </div>

      <div class="about-copy reveal">
        <h3 style="font-size:1.8rem;margin-bottom:18px;">Hi, I'm <?= e(SITE_AUTHOR) ?> — <span class="text-gradient">a product engineer</span> based in the cloud.</h3>
        <p style="color:var(--text-dim);margin-bottom:18px;">
          Over the last four years I've helped startups and design studios turn early ideas into
          production-ready products. I care about the full stack of the experience — from the
          database schema to the pixel-perfect hover state — and I believe the best interfaces
          are the ones users never have to think about.
        </p>
        <p style="color:var(--text-dim);margin-bottom:18px;">
          When I'm not writing code, I'm usually reading about type systems, tinkering with
          generative art, or mentoring junior developers in my community.
        </p>

        <div class="value-grid">
          <div class="value-card glass-card reveal-scale" style="--i:0">
            <i class="fa-solid fa-bolt"></i>
            <h4>Performance First</h4>
            <p>Every millisecond matters — I optimize for speed from the first commit.</p>
          </div>
          <div class="value-card glass-card reveal-scale" style="--i:1">
            <i class="fa-solid fa-shield-halved"></i>
            <h4>Secure by Default</h4>
            <p>Input validation, escaping, and least-privilege access, always.</p>
          </div>
          <div class="value-card glass-card reveal-scale" style="--i:2">
            <i class="fa-solid fa-layer-group"></i>
            <h4>Systematic Design</h4>
            <p>Reusable components and design tokens over one-off styling.</p>
          </div>
          <div class="value-card glass-card reveal-scale" style="--i:3">
            <i class="fa-solid fa-comments"></i>
            <h4>Clear Communication</h4>
            <p>Frequent updates and honest timelines — no surprises.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section container">
    <div class="glass-card reveal" style="text-align:center;padding:60px 40px;">
      <h2 style="font-size:clamp(1.6rem,3.6vw,2.2rem);margin-bottom:16px;">Want the full story?</h2>
      <p style="color:var(--text-dim);margin-bottom:28px;">Check my experience timeline or download the complete CV.</p>
      <div class="flex-center" style="gap:16px;flex-wrap:wrap;">
        <a href="experience.php" class="btn btn-ghost ripple">View Experience</a>
        <a href="<?= e(CV_FILE) ?>" class="btn btn-primary ripple" download><i class="fa-solid fa-download"></i> Download CV</a>
      </div>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
