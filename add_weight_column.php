<?php
$host   = 'localhost';
$dbname = 'qrcode_label';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SHOW COLUMNS FROM print_label_header LIKE 'weight'");
    if ($stmt->rowCount() > 0) {
        echo 'ALREADY_EXISTS';
    } else {
        $pdo->exec("ALTER TABLE print_label_header ADD COLUMN weight VARCHAR(20) NULL DEFAULT NULL AFTER user_initial");
        echo 'SUCCESS';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
