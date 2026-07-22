<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$html = '<h2>Test Heading 2</h2><p>Paragraph</p>';
echo "Original: " . $html . "\n";
echo "Cleaned: " . clean($html) . "\n";
