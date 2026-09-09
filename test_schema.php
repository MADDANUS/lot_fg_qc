<?php
$db = new mysqli('localhost', 'root', '', 'lot_fg');
$res = $db->query("SHOW COLUMNS FROM print_label_header");
while ($row = $res->fetch_assoc()) { echo $row['Field'] . "\n"; }
echo "\n====\n";
$res = $db->query("SHOW COLUMNS FROM print_label_items");
while ($row = $res->fetch_assoc()) { echo $row['Field'] . "\n"; }
