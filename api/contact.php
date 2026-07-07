<?php
/**
 * api/contact.php
 * -----------------------------------------------------------------------
 * Handles the contact form submission (the "Controller" for contact
 * requests). Validates input server-side, checks CSRF token and
 * honeypot, rate-limits per session, sends the email, and always
 * responds with JSON so the frontend can show a toast notification.
 * -----------------------------------------------------------------------
 */
require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json; charset=utf-8');

/**
 * Small helper to end the request with a JSON payload.
 */
function respond(bool $success, string $message, int $httpCode = 200): void
{
    http_response_code($httpCode);
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', 405);
}

// Basic CSRF protection
if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    respond(false, 'Your session has expired. Please refresh the page and try again.', 403);
}

// Honeypot — if this hidden field is filled, it's almost certainly a bot
if (!empty($_POST['website'])) {
    // Silently pretend success so bots don't learn the honeypot was tripped
    respond(true, 'Message sent successfully!');
}

// Rate limit — max 3 submissions per minute per session
if (too_many_requests(3)) {
    respond(false, 'You are sending messages too quickly. Please wait a moment and try again.', 429);
}

// -----------------------------------------------------------------------
// Sanitize & validate input
// -----------------------------------------------------------------------
$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$errors = [];

if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
    $errors[] = 'Name must be between 2 and 100 characters.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) {
    $errors[] = 'Please provide a valid email address.';
}

if (mb_strlen($subject) < 3 || mb_strlen($subject) > 150) {
    $errors[] = 'Subject must be between 3 and 150 characters.';
}

if (mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
    $errors[] = 'Message must be between 10 and 5000 characters.';
}

// Reject obvious header-injection attempts in any field
foreach ([$name, $email, $subject, $message] as $field) {
    if (preg_match('/(\r|\n|%0A|%0D|Content-Type:|Bcc:|Cc:)/i', $field)) {
        $errors[] = 'Invalid characters detected in submission.';
        break;
    }
}

if (!empty($errors)) {
    respond(false, implode(' ', $errors), 422);
}

// -----------------------------------------------------------------------
// Build & send the email
// -----------------------------------------------------------------------
$safeName    = strip_tags($name);
$safeSubject = strip_tags($subject);
$safeMessage = strip_tags($message);

$mailSubject = '[' . SITE_NAME . ' Contact] ' . $safeSubject;

$mailBody  = "You've received a new message from your portfolio contact form.\n\n";
$mailBody .= "Name:    {$safeName}\n";
$mailBody .= "Email:   {$email}\n";
$mailBody .= "Subject: {$safeSubject}\n\n";
$mailBody .= "Message:\n{$safeMessage}\n";

// Use a fixed "From" address on your own domain; set Reply-To to the
// visitor's email so replying goes straight to them.
$headers   = [];
$headers[] = 'From: ' . SITE_NAME . ' Website <no-reply@' . parse_url(SITE_URL, PHP_URL_HOST) . '>';
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'X-Mailer: PHP/' . phpversion();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$sent = @mail(CONTACT_TO_EMAIL, $mailSubject, $mailBody, implode("\r\n", $headers));

if ($sent) {
    respond(true, 'Thanks, ' . explode(' ', $safeName)[0] . '! Your message has been sent — I\'ll get back to you soon.');
}

// mail() failed (common in local/dev environments without an MTA configured)
error_log('Contact form mail() failed for submission from ' . $email);
respond(false, 'Sorry, something went wrong sending your message. Please email me directly at ' . CONTACT_TO_EMAIL . '.', 500);
