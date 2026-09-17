<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Right: 94mm -> 96mm
$cRight = str_replace(['height:94mm', 'min-height:94mm', 'max-height:94mm'], ['height:96mm', 'min-height:96mm', 'max-height:96mm'], $cRight);
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 96) return $m[0]; // Ignore outer table
        if ($val == 94) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (96.0 / 94.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);
file_put_contents($fRight, $cRight);

echo "Scaled right to 96mm.\n";
