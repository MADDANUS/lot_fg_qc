<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Left: 62mm -> 58mm
$cLeft = str_replace(['height:62mm', 'min-height:62mm', 'max-height:62mm'], ['height:58mm', 'min-height:58mm', 'max-height:58mm'], $cLeft);
$cLeft = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 58) return $m[0]; // Ignore outer table
        if ($val == 62) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (58.0 / 62.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cLeft
);
file_put_contents($fLeft, $cLeft);

echo "Scaled left to 58mm.\n";
