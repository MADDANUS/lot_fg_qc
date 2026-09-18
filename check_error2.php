<?php
$c = file_get_contents('error_utf8.html');
preg_match_all('/([a-zA-Z0-9_\-\\\\]+\.php)[\s\S]{0,50}?line\s+(\d+)/is', strip_tags($c), $m);
for ($i=0; $i<count($m[0]); $i++) {
    echo $m[1][$i] . " : " . $m[2][$i] . "\n";
}
