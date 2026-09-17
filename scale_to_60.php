<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Change outer table height
$cLeft = str_replace(['height:64mm', 'min-height:64mm', 'max-height:64mm'], ['height:60mm', 'min-height:60mm', 'max-height:60mm'], $cLeft);

// Scale left label rows by 60/64
$cLeft = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 60) return $m[0]; // Ignore outer table
        $newVal = round($val * (60.0 / 64.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cLeft
);

file_put_contents($fLeft, $cLeft);
echo "Left label scaled to 60mm.\n";
