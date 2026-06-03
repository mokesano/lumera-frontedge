<?php
// fix-namespaces.php

// 1. Mengganti referensi di dalam kode (contoh: use App\Pages\Sectioneditor\SomeClass;)
$codeReplacements = [
    'App\\Pages\\Copyeditor\\'          => 'App\\Pages\\CopyEditor\\',
    'App\\Pages\\Layouteditor\\'        => 'App\\Pages\\LayoutEditor\\',
    'App\\Pages\\Rtadmin\\'             => 'App\\Pages\\RtAdmin\\',
    'App\\Pages\\Sectioneditor\\'       => 'App\\Pages\\SectionEditor\\',
    'App\\Pages\\Subscriptionmanager\\' => 'App\\Pages\\SubscriptionManager\\',
];

// 2. Mengganti deklarasi namespace dan statement use tunggal
$declarationReplacements = [
    'namespace App\\Pages\\Copyeditor;'          => 'namespace App\\Pages\\CopyEditor;',
    'namespace App\\Pages\\Layouteditor;'        => 'namespace App\\Pages\\LayoutEditor;',
    'namespace App\\Pages\\Rtadmin;'             => 'namespace App\\Pages\\RtAdmin;',
    'namespace App\\Pages\\Sectioneditor;'       => 'namespace App\\Pages\\SectionEditor;',
    'namespace App\\Pages\\Subscriptionmanager;' => 'namespace App\\Pages\\SubscriptionManager;',
    
    'use App\\Pages\\Copyeditor;'          => 'use App\\Pages\\CopyEditor;',
    'use App\\Pages\\Layouteditor;'        => 'use App\\Pages\\LayoutEditor;',
    'use App\\Pages\\Rtadmin;'             => 'use App\\Pages\\RtAdmin;',
    'use App\\Pages\\Sectioneditor;'       => 'use App\\Pages\\SectionEditor;',
    'use App\\Pages\\Subscriptionmanager;' => 'use App\\Pages\\SubscriptionManager;',
];

// Direktori yang akan dipindai (sesuaikan jika ada direktori lain)
$directories = ['app', 'core', 'tests']; 

function updateNamespaces($dir, $codeReplacements, $declarationReplacements) {
    if (!is_dir($dir)) return;
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            $filePath = $file->getPathname();
            $content = file_get_contents($filePath);
            $originalContent = $content;
            
            // Terapkan penggantian untuk referensi kode
            $content = str_replace(array_keys($codeReplacements), array_values($codeReplacements), $content);
            
            // Terapkan penggantian untuk deklarasi namespace
            $content = str_replace(array_keys($declarationReplacements), array_values($declarationReplacements), $content);
            
            if ($content !== $originalContent) {
                file_put_contents($filePath, $content);
                echo "Updated: " . $filePath . "\n";
            }
        }
    }
}

foreach ($directories as $dir) {
    updateNamespaces($dir, $codeReplacements, $declarationReplacements);
}

echo "\nDone! Semua namespace telah disesuaikan dengan nama folder.\n";