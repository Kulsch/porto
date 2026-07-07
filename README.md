# Premium Portfolio — PHP / HTML / CSS / JS

A modern, dark-themed, glassmorphic portfolio site built with **pure PHP**
(no frameworks), organized in an MVC-like structure.

## Folder structure

```
/
├── index.php            Home
├── about.php             About
├── skills.php            Skills
├── projects.php          Projects (with category filter)
├── experience.php        Experience timeline
├── contact.php           Contact form (PHP + AJAX)
├── assets/
│   ├── css/style.css     All styles (variables, components, responsive)
│   ├── js/main.js        All vanilla JS (animations, form handling)
│   ├── images/           Profile photo, about photo, project thumbnails
│   └── files/            Downloadable CV (PDF)
├── includes/             Reusable PHP partials ("Views" + "Model")
│   ├── config.php        Site constants, security headers, helpers
│   ├── header.php        <head>, SEO meta, preloader markup
│   ├── navbar.php        Floating pill navbar
│   ├── footer.php        Footer, back-to-top, script loading
│   └── projects-data.php Project data array (swap for a DB later)
├── api/
│   └── contact.php       Contact form controller (validation + mail)
├── logs/                 PHP error log target (not web-accessible)
├── .htaccess             Security headers, caching, blocks includes/
├── robots.txt / sitemap.xml
```

## Getting started

1. Copy the project to your PHP host (PHP 7.4+ recommended, 8.x fully supported).
2. Edit `includes/config.php` — set `SITE_NAME`, `SITE_EMAIL`,
   `CONTACT_TO_EMAIL`, `SITE_URL`, and `SOCIAL_LINKS` to your own info.
3. Replace the placeholder images in `assets/images/` with real photos,
   and swap `assets/files/Aarav_Mehta_CV.pdf` for your real résumé.
4. Update `includes/projects-data.php` with your real projects.
5. Make sure your host can send mail via PHP's `mail()` function, or
   swap the `mail()` call in `api/contact.php` for PHPMailer/SMTP if
   your host requires authenticated SMTP.
6. Point your web server's document root at this folder and browse to
   `index.php`.

## Notes on security

- All dynamic output is escaped with the `e()` helper (XSS-safe).
- The contact form uses a CSRF token, a honeypot field, per-session
  rate limiting, and server-side validation independent of the
  client-side JS checks.
- `includes/` and `logs/` are blocked from direct web access via `.htaccess`.
- Security headers (CSP, X-Frame-Options, etc.) are sent from `config.php`.

## Notes on performance

- Single CSS/JS bundle each (no build step, no extra HTTP requests).
- Fonts/icons are preconnected and loaded with `display=swap`.
- Images use `loading="lazy"` except the above-the-fold hero portrait.
- Gzip + browser caching enabled via `.htaccess`.

## Customizing the design

All design tokens (colors, radii, spacing, fonts) live at the top of
`assets/css/style.css` under `:root`. Change the gradient stops there to
retheme the entire site.
