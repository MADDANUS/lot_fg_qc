<?php
$f = 'app/Views/print_form/epson/label_right.php';
$c = file_get_contents($f);

// 1. Change colgroup B & C
$c = str_replace('<col style="width:25mm">', '<col style="width:23mm">', $c);
$c = str_replace('<col style="width:21mm">', '<col style="width:19mm">', $c);

// 2. Change colgroup & td widths for A & J
$c = str_replace('width:3mm', 'width:5mm', $c);
$c = str_replace('max-width:3mm', 'max-width:5mm', $c);

file_put_contents($f, $c);
echo "Done.\n";
