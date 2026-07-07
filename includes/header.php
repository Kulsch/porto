<?php
/**
 * header.php
 * -----------------------------------------------------------------------
 * Opens the HTML document, sets SEO meta tags, and loads CSS/fonts.
 * Each page may define $pageTitle / $pageDescription / $pageSlug
 * BEFORE including this file to override the defaults declared here.
 * -----------------------------------------------------------------------
 */
$pageTitle       = $pageTitle       ?? SITE_TITLE;
$pageDescription = $pageDescription ?? SITE_DESCRIPTION;
$pageSlug        = $pageSlug        ?? '';
$canonical       = rtrim(SITE_URL, '/') . '/' . $pageSlug;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

<!-- Primary SEO -->
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<meta name="keywords" content="<?= e(SITE_KEYWORDS) ?>">
<meta name="author" content="<?= e(SITE_AUTHOR) ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?= e($canonical) ?>">

<!-- Open Graph / Social preview -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e(SITE_URL . ASSETS_PATH . '/images/og-cover.jpg') ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($pageTitle) ?>">
<meta name="twitter:description" content="<?= e($pageDescription) ?>">

<meta name="theme-color" content="#0a0e17">
<link rel="icon" type="image/svg+xml" href="<?= ASSETS_PATH ?>/images/favicon.svg">

<!-- Performance: preconnect to font hosts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Core styles -->
<link rel="stylesheet" href="<?= ASSETS_PATH ?>/css/style.css">

<!-- Structured data for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "<?= e(SITE_AUTHOR) ?>",
  "url": "<?= e(SITE_URL) ?>",
  "jobTitle": "Product Engineer & Creative Developer",
  "email": "<?= e(SITE_EMAIL) ?>"
}
</script>
</head>
<body>

<!-- Loading screen -->
<div id="preloader" aria-hidden="true">
  <div class="preloader-mark">
    <span>A</span><span>M</span>
  </div>
  <div class="preloader-bar"><div class="preloader-bar-fill"></div></div>
</div>

<!-- Scroll progress indicator -->
<div id="scroll-progress" aria-hidden="true"></div>

<!-- Ambient gradient mesh (signature visual, sits behind all content) -->
<div class="mesh-bg" aria-hidden="true">
  <span class="mesh-blob blob-blue"></span>
  <span class="mesh-blob blob-purple"></span>
  <span class="mesh-blob blob-cyan"></span>
</div>
