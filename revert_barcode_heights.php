<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// Revert R3, R5, R7, R9 to their original heights before the 2mm deduction
$cLeft = str_replace('height:4.36mm;', 'height:4.86mm;', $cLeft); // R3
$cLeft = str_replace('height:3.89mm;', 'height:4.39mm;', $cLeft); // R5
$cLeft = str_replace('height:4.14mm;', 'height:4.64mm;', $cLeft); // R7
$cLeft = str_replace('height:3.65mm;', 'height:4.15mm;', $cLeft); // R9

// Also revert the stamp box empty space (R13) from 3.92mm back to 1.92mm for a clean slate
$cLeft = str_replace('<td style="height:3.92mm;border-left:0.3mm solid #000;"></td>', '<td style="height:1.92mm;border-left:0.3mm solid #000;"></td>', $cLeft);

file_put_contents($fLeft, $cLeft);
echo "Reverted all changes to restore clean state.\n";
