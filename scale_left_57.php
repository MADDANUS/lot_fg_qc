<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Left: 58mm -> 57mm
$cLeft = str_replace(['height:58mm', 'min-height:58mm', 'max-height:58mm'], ['height:57mm', 'min-height:57mm', 'max-height:57mm'], $cLeft);
$cLeft = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 57) return $m[0]; // Ignore outer table
        if ($val == 58) return $m[0]; // Ignore outer table if missed
        $newVal = round($val * (57.0 / 58.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cLeft
);
file_put_contents($fLeft, $cLeft);

echo "Scaled left to 57mm.\n";
