<?php
$fLeft = 'app/Views/print_form/epson/label_left.php';
$cLeft = file_get_contents($fLeft);

// 1. Add 2mm to stamp box empty row (R13)
$cLeft = str_replace('<td style="height:1.92mm;border-left:0.3mm solid #000;"></td>', '<td style="height:3.92mm;border-left:0.3mm solid #000;"></td>', $cLeft);

// 2. Subtract 0.5mm from R3 height and its barcode SVG height (5 -> 4.5)
$cLeft = str_replace('height:4.86mm;', 'height:4.36mm;', $cLeft);
$cLeft = str_replace('$barcodeSvg($itemCodeLeft, 5, 1.0)', '$barcodeSvg($itemCodeLeft, 4.5, 1.0)', $cLeft);

// 3. Subtract 0.5mm from R5 height and its barcode SVG height (4 -> 3.5)
$cLeft = str_replace('height:4.39mm;', 'height:3.89mm;', $cLeft);
$cLeft = str_replace('$barcodeSvg($lotNoCombined, 4, 1.0)', '$barcodeSvg($lotNoCombined, 3.5, 1.0)', $cLeft);

// 4. Subtract 0.5mm from R7 height and its barcode SVG height (4 -> 3.5)
$cLeft = str_replace('height:4.64mm;', 'height:4.14mm;', $cLeft);
$cLeft = str_replace('$barcodeSvg($lotQty, 4, 1.0)', '$barcodeSvg($lotQty, 3.5, 1.0)', $cLeft);

// 5. Subtract 0.5mm from R9 height and its barcode SVG height (4 -> 3.5)
$cLeft = str_replace('height:4.15mm;', 'height:3.65mm;', $cLeft);
$cLeft = str_replace('$barcodeSvg($refNo, 4, 1.0)', '$barcodeSvg($refNo, 3.5, 1.0)', $cLeft);

file_put_contents($fLeft, $cLeft);
echo "Height transferred and SVG shrunk successfully.\n";
