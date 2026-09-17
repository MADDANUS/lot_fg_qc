<?php
$files = [
    'app/Views/print_form/epson/label_left.php',
    'app/Views/print_form/epson/label_right.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    // Replace the main table font-family
    $content = str_replace(
        "font-family:'Calibri','dejavusans',Arial,sans-serif;",
        "font-family:Arial,sans-serif;",
        $content
    );
    file_put_contents($file, $content);
}
echo "Updated font-family to Arial.\n";
