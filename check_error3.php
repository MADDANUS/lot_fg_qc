<?php
$c = file_get_contents('error3.html');
preg_match('/"message":\s*"(.*?)"/is', $c, $m);
echo 'ERROR: ' . ($m[1] ?? 'NOT JSON');
