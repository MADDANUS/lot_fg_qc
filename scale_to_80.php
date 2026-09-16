<?php
$f = 'app/Views/print_form/epson/label_right.php';
$c = file_get_contents($f);
// Change outer table height from 79 to 80
$c = str_replace('height:79mm;min-height:79mm;max-height:79mm;', 'height:80mm;min-height:80mm;max-height:80mm;', $c);

// Scale inner heights
$c = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    if ($m[1] == '80') return $m[0]; // skip the outer one we just changed
    $h = round((float)$m[1] * 1.012658, 2);
    return 'height:' . $h . 'mm';
}, $c);

file_put_contents($f, $c);
echo "Scaled right label to 80mm.\n";
