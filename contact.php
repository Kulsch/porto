<?php
/**
 * contact.php — Contact page
 */
require_once __DIR__ . '/includes/config.php';

$pageTitle       = 'Contact — ' . SITE_NAME;
$pageDescription = 'Get in touch with ' . SITE_AUTHOR . ' for freelance work or full-time opportunities.';
$pageSlug        = 'contact.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<main>
  <section class="section container">
    <div class="section-head reveal">
      <p class="eyebrow">Contact</p>
      <h2>Let's build something together.</h2>
      <p>Have a project, a question, or just want to say hi? Fill out the form or reach me directly.</p>
    </div>

    <div class="contact-grid">
      <div class="reveal">
        <div class="contact-info-item">
          <i class="fa-solid fa-envelope"></i>
          <div>
            <h4>Email</h4>
            <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a>
          </div>
        </div>
        <div class="contact-info-item">
          <i class="fa-solid fa-location-dot"></i>
          <div>
            <h4>Location</h4>
            <p>Available worldwide — remote first</p>
          </div>
        </div>
        <div class="contact-info-item">
          <i class="fa-solid fa-clock"></i>
          <div>
            <h4>Response Time</h4>
            <p>Usually within 24 hours</p>
          </div>
        </div>

        <div class="footer-socials" style="margin-top:30px;">
          <?php foreach (SOCIAL_LINKS as $name => $data): ?>
            <a href="<?= e($data['url']) ?>" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="<?= e($name) ?>">
              <i class="<?= e($data['icon']) ?>"></i>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="glass-card reveal">
        <form id="contactForm" novalidate>
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <!-- Honeypot field — hidden from real users, trips up simple bots -->
          <div class="hp-field" aria-hidden="true">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Jane Doe" required>
              <span class="form-error">Please enter your name (min. 2 characters).</span>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="jane@example.com" required>
              <span class="form-error">Please enter a valid email address.</span>
            </div>
          </div>

          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control" placeholder="Project inquiry" required>
            <span class="form-error">Please enter a subject.</span>
          </div>

          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" placeholder="Tell me about your project…" required></textarea>
            <span class="form-error">Message should be at least 10 characters.</span>
          </div>

          <button type="submit" class="btn btn-primary ripple" style="width:100%;">
            <i class="fa-solid fa-paper-plane"></i><span>Send Message</span>
          </button>
        </form>
      </div>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
