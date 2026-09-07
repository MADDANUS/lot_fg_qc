<?php
$files = [
    'c:/xampp/htdocs/lot_fg/app/Views/print_form/label_left.php',
    'c:/xampp/htdocs/lot_fg/app/Views/print_form/label_right.php'
];

foreach ($files as $f) {
    $c = file_get_contents($f);
    $c = preg_replace_callback('/height:([0-9\.]+)mm;/', function($m) {
        $newHeight = round((float)$m[1] * 0.85, 2);
        return 'height:' . $newHeight . 'mm;';
    }, $c);
    file_put_contents($f, $c);
    echo "Updated $f\n";
}
