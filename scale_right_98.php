<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Right: 96mm -> 98mm
$cRight = str_replace(['height:96mm', 'min-height:96mm', 'max-height:96mm'], ['height:98mm', 'min-height:98mm', 'max-height:98mm'], $cRight);
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 98) return $m[0]; // Ignore outer table
        if ($val == 96) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (98.0 / 96.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);
file_put_contents($fRight, $cRight);

echo "Scaled right to 98mm.\n";
