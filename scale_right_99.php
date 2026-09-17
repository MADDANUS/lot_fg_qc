<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Right: 98mm -> 99mm
$cRight = str_replace(['height:98mm', 'min-height:98mm', 'max-height:98mm'], ['height:99mm', 'min-height:99mm', 'max-height:99mm'], $cRight);
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 99) return $m[0]; // Ignore outer table
        if ($val == 98) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (99.0 / 98.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);
file_put_contents($fRight, $cRight);

echo "Scaled right to 99mm.\n";
