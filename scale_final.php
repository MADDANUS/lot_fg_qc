<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$fRight = 'app/Views/print_form/epson/label_right.php';

$cLeft = file_get_contents($fLeft);
$cRight = file_get_contents($fRight);

// Left: 60mm -> 62mm
$cLeft = str_replace(['height:60mm', 'min-height:60mm', 'max-height:60mm'], ['height:62mm', 'min-height:62mm', 'max-height:62mm'], $cLeft);
$cLeft = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 62) return $m[0]; // Ignore the outer table we just replaced
        if ($val == 60) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (62.0 / 60.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cLeft
);
file_put_contents($fLeft, $cLeft);

// Right: 90mm -> 94mm
$cRight = str_replace(['height:90mm', 'min-height:90mm', 'max-height:90mm'], ['height:94mm', 'min-height:94mm', 'max-height:94mm'], $cRight);
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 94) return $m[0]; // Ignore outer table
        if ($val == 90) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (94.0 / 90.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);
file_put_contents($fRight, $cRight);

echo "Scaled left to 62mm, right to 94mm.\n";
