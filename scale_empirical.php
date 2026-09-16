<?php
// Right Label: 80 -> 83
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Change outer table height
$cRight = str_replace(['height:80mm', 'min-height:80mm', 'max-height:80mm'], ['height:83mm', 'min-height:83mm', 'max-height:83mm'], $cRight);

// Scale inner heights
$cRight = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    if ($m[1] == '83') return $m[0]; // skip outer
    $h = round((float)$m[1] * 1.0375, 2);
    return 'height:' . $h . 'mm';
}, $cRight);

file_put_contents($fRight, $cRight);

// Left Label: 67 -> 64
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Change outer table height
$cLeft = str_replace(['height:67mm', 'min-height:67mm', 'max-height:67mm'], ['height:64mm', 'min-height:64mm', 'max-height:64mm'], $cLeft);

// Scale inner heights
$cLeft = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    if ($m[1] == '64') return $m[0]; // skip outer
    $h = round((float)$m[1] * 0.95479, 2);
    return 'height:' . $h . 'mm';
}, $cLeft);

file_put_contents($fLeft, $cLeft);

echo "Adjusted successfully.\n";
