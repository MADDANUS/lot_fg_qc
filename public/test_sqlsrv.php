<?php
// Test apakah extension sqlsrv terbaca oleh Apache
header('Content-Type: text/plain');
echo "PHP Version: " . PHP_VERSION . "\n";
echo "sqlsrv loaded: "     . (extension_loaded('sqlsrv')     ? 'YES ✓' : 'NO ✗') . "\n";
echo "pdo_sqlsrv loaded: " . (extension_loaded('pdo_sqlsrv') ? 'YES ✓' : 'NO ✗') . "\n";
echo "\nLoaded php.ini: " . php_ini_loaded_file() . "\n";
echo "\nAll extensions with 'sql':\n";
foreach (get_loaded_extensions() as $ext) {
    if (stripos($ext, 'sql') !== false) echo "  - $ext\n";
}
