<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$lines = file($fRight);

$targetLines = [115, 116, 124, 138, 139, 148, 156, 170, 171];

foreach ($targetLines as $ln) {
    $idx = $ln - 1; // zero-indexed array
    $lines[$idx] = str_replace('font-size:11pt;', 'font-size:9pt;', $lines[$idx]);
}

file_put_contents($fRight, implode("", $lines));
echo "Successfully changed the target texts to 9pt.\n";
