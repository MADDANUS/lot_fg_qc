<?php
function sumHeights($file) {
    $c = file_get_contents($file);
    preg_match_all('/height:([0-9\.]+)mm/', $c, $m);
    $total = array_sum($m[1]);
    echo basename($file) . " rows total height: " . round($total, 2) . "mm\n";
    foreach ($m[1] as $h) echo "  - {$h}mm\n";
    return $total;
}

$left  = sumHeights('app/Views/print_form/label_left.php');
$right = sumHeights('app/Views/print_form/label_right.php');
echo "\nLabel LEFT  total: {$left}mm\n";
echo "Label RIGHT total: {$right}mm\n";
echo "Bigger of two: " . max($left,$right) . "mm\n";
echo "\nA4 height = 297mm\n";
echo "Margins top+bottom = 4mm (2+2)\n";
echo "Available = " . (297-4) . "mm\n";
echo "3 labels + 2 gaps (10mm each) = " . (max($left,$right)*3 + 20) . "mm\n";
echo "Fits? " . ((max($left,$right)*3 + 20) <= 293 ? "YES" : "NO") . "\n";
