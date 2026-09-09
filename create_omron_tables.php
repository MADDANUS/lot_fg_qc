<?php
$db = new mysqli('localhost', 'root', '', 'qrcode_label');
if ($db->connect_error) die("DB Error: " . $db->connect_error);

// Tabel omron_inner_labels
$sql_inner = "CREATE TABLE IF NOT EXISTS omron_inner_labels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doc_number VARCHAR(50) NOT NULL,
    doc_date DATE NULL,
    item_code VARCHAR(50) NOT NULL,
    description VARCHAR(255) NULL,
    quantity INT DEFAULT 0,
    standard_pack INT DEFAULT 0,
    lotno VARCHAR(100) NULL,
    whs_code VARCHAR(20) NULL,
    back_no VARCHAR(50) NULL,
    operator VARCHAR(100) NULL,
    production_date DATE NULL,
    machine VARCHAR(50) NULL,
    notification VARCHAR(100) NULL,
    user_initial VARCHAR(10) NOT NULL DEFAULT '',
    job_order VARCHAR(50) NULL,
    shift_id VARCHAR(10) NULL,
    remark TEXT NULL,
    is_printed TINYINT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Tabel omron_outer_labels
$sql_outer = "CREATE TABLE IF NOT EXISTS omron_outer_labels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doc_number VARCHAR(50) NOT NULL,
    doc_date DATE NULL,
    item_code VARCHAR(50) NOT NULL,
    description VARCHAR(255) NULL,
    quantity INT DEFAULT 0,
    standard_pack INT DEFAULT 0,
    lotno VARCHAR(100) NULL,
    whs_code VARCHAR(20) NULL,
    back_no VARCHAR(50) NULL,
    operator VARCHAR(100) NULL,
    production_date DATE NULL,
    machine VARCHAR(50) NULL,
    notification VARCHAR(100) NULL,
    user_initial VARCHAR(10) NULL DEFAULT NULL,
    job_order VARCHAR(50) NULL,
    shift_id VARCHAR(10) NULL,
    remark TEXT NULL,
    is_printed TINYINT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($db->query($sql_inner)) {
    echo "OK: omron_inner_labels created/exists\n";
} else {
    echo "ERROR inner: " . $db->error . "\n";
}

if ($db->query($sql_outer)) {
    echo "OK: omron_outer_labels created/exists\n";
} else {
    echo "ERROR outer: " . $db->error . "\n";
}

$db->close();
echo "DONE\n";
