<?php
$f = 'app/Views/print_form/mitsuba/medium_card.php';
$c = file_get_contents($f);
$c = preg_replace_callback('/height:([0-9\.]+)mm/', function($m) {
    $v = floatval($m[1]) * (74/80);
    return 'height:' . round($v, 1) . 'mm';
}, $c);
file_put_contents($f, $c);
echo "Scaled heights";
