<?php
function checkH($f) {
    $c = file_get_contents($f);
    preg_match_all('/<tr.*?<td[^>]*height:([0-9\.]+)mm/', $c, $m);
    if (empty($m[1])) {
        // Try without tr
        preg_match_all('/height:([0-9\.]+)mm/', $c, $m);
        $sum = 0;
        foreach($m[1] as $val) {
            if (!in_array($val, [64, 67, 79, 80, 83, 91.85, 86.79])) {
                $sum += (float)$val;
            }
        }
    } else {
        $sum = array_sum($m[1]);
    }
    echo basename($f) . ": " . $sum . " mm\n";
}
checkH('app/Views/print_form/epson/label_left.php');
checkH('app/Views/print_form/epson/label_right.php');
