<?php
$lines = file('d:/laragon/www/blog-NusaEducation/storage/logs/laravel.log');
$recentLines = array_slice($lines, -150);
foreach($recentLines as $line) {
    if (strpos($line, 'ERROR') !== false || strpos($line, 'Exception') !== false) {
        echo $line;
    }
}
