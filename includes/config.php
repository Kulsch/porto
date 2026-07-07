<?php
/**
 * config.php
 * -----------------------------------------------------------------------
 * Central configuration file for the portfolio site.
 * Holds site-wide constants, security headers, and shared helper
 * functions used across every page (MVC-style "core" layer).
 * This file must be included FIRST on every page.
 * -----------------------------------------------------------------------
 */

// Prevent direct multiple inclusion issues
declare(strict_types=1);

// -----------------------------------------------------------------------
// Error handling — never expose raw errors to visitors in production
// -----------------------------------------------------------------------
error_reporting(E_ALL);
ini_set('display_errors', '0');      // Never show raw PHP errors publicly
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/error.log');

// -----------------------------------------------------------------------
// Session — secured cookie params (must run before any output/session_start)
// -----------------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

// -----------------------------------------------------------------------
// Security headers — sent on every page
// -----------------------------------------------------------------------
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
// Content-Security-Policy kept permissive enough for Google Fonts/CDN icons.
header("Content-Security-Policy: default-src 'self'; " .
       "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; " .
       "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; " .
       "script-src 'self' https://cdnjs.cloudflare.com; " .
       "img-src 'self' data:;");

// -----------------------------------------------------------------------
// Site-wide constants (edit these to personalize the whole site)
// -----------------------------------------------------------------------
define('SITE_NAME',        'Aarav Mehta');
define('SITE_TITLE',       'Aarav Mehta — Product Engineer & Creative Developer');
define('SITE_TAGLINE',     'I design and build fast, elegant digital products.');
define('SITE_DESCRIPTION', 'Portfolio of Aarav Mehta — a product engineer specializing in full-stack '.
                            'web development, interface design, and performance engineering.');
define('SITE_KEYWORDS',    'portfolio, web developer, full stack engineer, UI/UX, PHP developer, frontend developer');
define('SITE_URL',         'https://example.com');
define('SITE_AUTHOR',      'Aarav Mehta');
define('SITE_EMAIL',       'hello@example.com');
define('CONTACT_TO_EMAIL', 'hello@example.com'); // recipient for the contact form
define('ASSETS_PATH',      '/assets');
define('CV_FILE',          ASSETS_PATH . '/files/Aarav_Mehta_CV.pdf');
define('CURRENT_YEAR',     date('Y'));

// Social links — reused in footer.php
define('SOCIAL_LINKS', [
    'GitHub'   => ['url' => 'https://github.com/',           'icon' => 'fa-brands fa-github'],
    'LinkedIn' => ['url' => 'https://linkedin.com/',         'icon' => 'fa-brands fa-linkedin-in'],
    'Twitter'  => ['url' => 'https://twitter.com/',          'icon' => 'fa-brands fa-x-twitter'],
    'Dribbble' => ['url' => 'https://dribbble.com/',         'icon' => 'fa-brands fa-dribbble'],
]);

// -----------------------------------------------------------------------
// Helper: escape output safely (prevents XSS on every echo)
// -----------------------------------------------------------------------
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// -----------------------------------------------------------------------
// Helper: generate & verify CSRF tokens (used by the contact form)
// -----------------------------------------------------------------------
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify(?string $token): bool
{
    return !empty($token) && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

// -----------------------------------------------------------------------
// Helper: determine active nav link (used by navbar.php)
// -----------------------------------------------------------------------
function is_active_page(string $page): string
{
    $current = basename($_SERVER['SCRIPT_NAME'], '.php');
    return $current === $page ? 'active' : '';
}

// -----------------------------------------------------------------------
// Simple in-memory rate limiter for the contact API (per session)
// -----------------------------------------------------------------------
function too_many_requests(int $maxPerMinute = 3): bool
{
    $now = time();
    $_SESSION['contact_attempts'] = array_filter(
        $_SESSION['contact_attempts'] ?? [],
        fn($t) => $t > $now - 60
    );
    if (count($_SESSION['contact_attempts']) >= $maxPerMinute) {
        return true;
    }
    $_SESSION['contact_attempts'][] = $now;
    return false;
}
