<?php
$c = file_get_contents('error_utf8.html');
preg_match('/<title>(.*?)<\/title>/is', $c, $m);
echo "TITLE: " . ($m[1] ?? 'NOT FOUND') . "\n";
preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $c, $m2);
echo "H1: " . strip_tags($m2[1] ?? 'NOT FOUND') . "\n";
