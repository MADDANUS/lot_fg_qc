<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'qrcode_label');

$mysqli->query("CREATE TABLE IF NOT EXISTS `omron_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$items = [
    '2244034-3' => 'INSERT METAL A Z-15G-B',
    '2244035-1' => 'INSERT METAL B Z-15G-B',
    '2244036-0' => 'INSERT METAL C Z-15G-B',
    '2244040-8' => 'INSERT METAL A Z-15G-B-K',
    '2244041-6' => 'INSERT METAL B Z-15G-B-K',
    '2244042-4' => 'INSERT METAL C Z-15G-B-K',
    '2244049-1' => 'CAP BUTTON Z-15GD55',
    '2244054-8' => 'CAP BUTTON Z-15GQ',
    '2244062-9' => 'MOVE BUSH Z-15GQ22',
    '2253973-0' => 'INSERT METAL (A) Z-15G',
    '2253974-9' => 'INSERT METAL (B) Z-15G',
    '2253975-7' => 'INSERT METAL (C) Z-15G'
];

foreach ($items as $code => $desc) {
    $stmt = $mysqli->prepare("INSERT IGNORE INTO `omron_items` (`item_code`, `description`) VALUES (?, ?)");
    $stmt->bind_param("ss", $code, $desc);
    $stmt->execute();
}
echo "Table omron_items created and populated with all 12 items.\n";
