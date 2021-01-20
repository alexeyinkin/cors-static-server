<?php declare(strict_types=1);

$filename = $_GET['filename'];
$forbiddenSubstrings = ['/', '\\', '..']; // Remove '/' and '\\' to allow subfolders.

foreach ($forbiddenSubstrings as $substring) {
    if (strpos($filename, $substring) !== false) {
        header('HTTP/1.1 403 Forbidden');
        exit();
    }
}

$origin = $_SERVER['HTTP_ORIGIN'];
$originsRegexp = '~http(s)?://(www\\.)?(localhost|jamigo\\.app)(:\\d+)?~'; // Your domains here.

if (preg_match($originsRegexp, $origin)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Content-Type: ' . mime_content_type($filename));
}

header('Content-Length: ' . filesize($filename));

// TODO: Add headers for cache control, ETag etc.
//       Allow to return ranges.

readfile($filename);
