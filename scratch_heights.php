<?php
$f = 'app/Views/print_form/epson/label_right.php';
$c = file_get_contents($f);
$c = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    $h = round((float)$m[1] * 1.16262, 2);
    return 'height:' . $h . 'mm';
}, $c);
file_put_contents($f, $c);

$f2 = 'app/Views/print_form/epson/label_left.php';
$c2 = file_get_contents($f2);
$c2 = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    $h = round((float)$m[1] * 1.2954, 2);
    return 'height:' . $h . 'mm';
}, $c2);
file_put_contents($f2, $c2);
echo "Done";
