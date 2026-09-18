<?php
$c = file_get_contents('error3.html');
echo substr(preg_replace('/\s+/', ' ', strip_tags($c)), 0, 1000);
