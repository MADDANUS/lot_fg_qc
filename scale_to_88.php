<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Change outer table height
$cRight = str_replace(['height:83mm', 'min-height:83mm', 'max-height:83mm'], ['height:88mm', 'min-height:88mm', 'max-height:88mm'], $cRight);

// Scale right label rows by 88/83
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 88) return $m[0]; // Ignore outer table
        $newVal = round($val * (88.0 / 83.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);

file_put_contents($fRight, $cRight);
echo "Right label scaled to 88mm.\n";
