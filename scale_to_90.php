<?php
$fRight = 'app/Views/print_form/epson/label_right.php';
$cRight = file_get_contents($fRight);

// Change outer table height
$cRight = str_replace(['height:88mm', 'min-height:88mm', 'max-height:88mm'], ['height:90mm', 'min-height:90mm', 'max-height:90mm'], $cRight);

// Scale right label rows by 90/88
$cRight = preg_replace_callback(
    '/height:([0-9\.]+)mm/',
    function($m) {
        $val = floatval($m[1]);
        if ($val == 90) return $m[0]; // Ignore outer table after replacement (Wait, str_replace runs first, so outer table is 90mm)
        // Wait, if it is already 90, we ignore it.
        if ($val == 88) { // If it was 88, it's already replaced by str_replace above? No, str_replace replaced the specific strings 'height:88mm', but if there are other 88s, we ignore. 
            // Wait, str_replace above replaced it to 90mm.
            // So now the outer table has height:90mm. We should ignore 90mm.
        }
        if ($val == 90) return $m[0];
        
        $newVal = round($val * (90.0 / 88.0), 2);
        return 'height:' . $newVal . 'mm';
    },
    $cRight
);

file_put_contents($fRight, $cRight);
echo "Right label scaled to 90mm.\n";
