<?php
// Shared helpers. Included by pages that need escaping or CSRF.

/** Escape for HTML output. Use EVERYWHERE data goes into the page. */
function e(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

/** CSRF token field — put inside every <form method="post"> */
function csrf_field(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return '<input type="hidden" name="csrf" value="' . e($_SESSION['csrf']) . '">';
}

/** Verify the CSRF token. Call in every POST handler before touching data. */
function csrf_check(): void {
    $sent = $_POST['csrf'] ?? '';
    if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $sent)) {
        http_response_code(403);
        exit('CSRF token mismatch.');
    }
}
