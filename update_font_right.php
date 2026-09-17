<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Change font-size:10pt to font-size:11pt
$cRight = str_replace('font-size:10pt', 'font-size:11pt', $cRight);

file_put_contents($fRight, $cRight);
echo "Font size in right label changed to 11pt.\n";
