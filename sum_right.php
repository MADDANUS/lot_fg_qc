<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);
preg_match_all('/height:([\d\.]+)mm/', $cRight, $m);
$sum = array_sum($m[1]);
echo "Sum is: " . $sum . "mm\n";

preg_match('/<table style="[^"]*height:([\d\.]+)mm/', $cRight, $m2);
echo "Table height is: " . $m2[1] . "mm\n";
