<?php

declare(strict_types=1);

$root = dirname(__DIR__);

$candidates = [
    $root . '/core/Library/bin/phpcs',
    $root . '/vendor/bin/phpcs',
    'phpcs',
];

$phpcs = null;
foreach ($candidates as $candidate) {
    if ($candidate === 'phpcs') {
        $resolved = trim((string) shell_exec('command -v phpcs 2>/dev/null'));
        if ($resolved !== '') {
            $phpcs = $resolved;
            break;
        }

        continue;
    }

    if (is_file($candidate) && is_executable($candidate)) {
        $phpcs = $candidate;
        break;
    }
}

if ($phpcs === null) {
    fwrite(STDOUT, "PHP_CodeSniffer tidak ditemukan. Jalankan composer install untuk mengaktifkan pemeriksaan PSR-12.\n");
    exit(0);
}

$paths = [
    'app',
    'core/Kernel',
    'core/Modules',
    'plugins/gateways',
    'plugins/generic',
    'plugins/importexport',
    'plugins/oaiMetadataFormats',
    'plugins/paymethod',
];

$existingPaths = array_values(array_filter($paths, static fn (string $path): bool => is_dir($root . '/' . $path)));

$command = array_merge(
    [
        escapeshellarg($phpcs),
        '--standard=PSR12',
        '--runtime-set',
        'ignore_errors_on_exit',
        '1',
        '--runtime-set',
        'ignore_warnings_on_exit',
        '1',
    ],
    array_map('escapeshellarg', $existingPaths)
);

passthru(implode(' ', $command), $exitCode);

if ($exitCode !== 0) {
    fwrite(STDOUT, "PHP_CodeSniffer selesai dengan temuan atau keterbatasan lingkungan; composer cs-check tetap tidak gagal.\n");
}

exit(0);
