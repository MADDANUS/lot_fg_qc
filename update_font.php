<?php
$files = [
    'app/Views/print_form/epson/label_left.php',
    'app/Views/print_form/epson/label_right.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = preg_replace('/font-size:\s*9pt/', 'font-size:10pt', $content);
    file_put_contents($file, $content);
}
echo "Updated font-size to 10pt.\n";
