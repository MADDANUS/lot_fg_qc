<?php
$db = new mysqli('localhost', 'root', '', 'qrcode_label');
if ($db->connect_error) die("DB Error: " . $db->connect_error);

$db->query("ALTER TABLE omron_inner_labels ADD COLUMN ref_no VARCHAR(100) NULL AFTER doc_number");
$db->query("ALTER TABLE omron_outer_labels ADD COLUMN ref_no VARCHAR(100) NULL AFTER doc_number");

echo "Tables altered successfully.\n";
if ($db->error) echo "Error: " . $db->error . "\n";
