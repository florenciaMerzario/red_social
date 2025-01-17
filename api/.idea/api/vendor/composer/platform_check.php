<?php

// platform_check.php @generated by Composer

$issues = array();

if (!(PHP_VERSION_ID >= 50600)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 5.6.0". You are running ' . PHP_VERSION  .  '.';
}

$missingExtensions = array();
extension_loaded('mbstring') || $missingExtensions[] = 'mbstring';
extension_loaded('openssl') || $missingExtensions[] = 'openssl';

if ($missingExtensions) {
    $issues[] = 'Your Composer dependencies require the following PHP extensions to be installed: ' . implode(', ', $missingExtensions);
}

if ($issues) {
    echo 'Composer detected issues in your platform:' . "\n\n" . implode("\n", $issues);
    exit(104);
}
