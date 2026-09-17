<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Left: 57mm -> 56mm
$cLeft = str_replace(['height:57mm', 'min-height:57mm', 'max-height:57mm'], ['height:56mm', 'min-height:56mm', 'max-height:56mm'], $cLeft);
$cLeft = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 56) return $m[0]; // Ignore outer table
        if ($val == 57) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (56.0 / 57.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cLeft
);
file_put_contents($fLeft, $cLeft);

echo "Scaled left to 56mm.\n";
