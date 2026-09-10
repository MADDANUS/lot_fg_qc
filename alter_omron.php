<?php
$db = new mysqli('localhost', 'root', '', 'qrcode_label');
if ($db->connect_error) die("DB Error: " . $db->connect_error);

$db->query("ALTER TABLE omron_inner_labels ADD COLUMN cavity VARCHAR(50) NULL AFTER shift_id");
$db->query("ALTER TABLE omron_outer_labels ADD COLUMN cavity VARCHAR(50) NULL AFTER shift_id");
$db->query("ALTER TABLE omron_inner_labels ADD COLUMN shift VARCHAR(50) NULL AFTER cavity");
$db->query("ALTER TABLE omron_outer_labels ADD COLUMN shift VARCHAR(50) NULL AFTER cavity");

echo "Tables altered successfully.\n";
if ($db->error) echo "Error: " . $db->error . "\n";
