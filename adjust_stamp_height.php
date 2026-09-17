<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Target: Add 2mm to Row 13 (stamp box space)
// Current R13 height is 1.92mm. We will change it to 3.92mm.
$cLeft = str_replace('<td style="height:1.92mm;border-left:0.3mm solid #000;"></td>', '<td style="height:3.92mm;border-left:0.3mm solid #000;"></td>', $cLeft);

// Target: Subtract 2mm from R3-R10.
// R3: 4.86, R4: 2.92, R5: 4.39, R6: 2.92, R7: 4.64, R8: 3.14, R9: 4.15, R10: 1.2
// We will subtract 0.5mm from R3, R5, R7, R9.
$cLeft = str_replace('height:4.86mm;', 'height:4.36mm;', $cLeft); // R3
$cLeft = str_replace('height:4.39mm;', 'height:3.89mm;', $cLeft); // R5
$cLeft = str_replace('height:4.64mm;', 'height:4.14mm;', $cLeft); // R7
$cLeft = str_replace('height:4.15mm;', 'height:3.65mm;', $cLeft); // R9

file_put_contents($fLeft, $cLeft);
echo "Height transferred successfully.\n";
