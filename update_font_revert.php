<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Revert 9pt to 11pt
$cRight = str_replace('font-size:9pt', 'font-size:11pt', $cRight);

file_put_contents($fRight, $cRight);
echo "Font size restored to 11pt.\n";
