<?php
require 'app/Config/Database.php';
$db = (new \Config\Database())->default;
$mysqli = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
$res = $mysqli->query('SELECT id, username FROM users');
while($row = $res->fetch_assoc()) echo $row['id'] . ' ' . $row['username'] . "\n";
