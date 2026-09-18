<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'lot_fg_qc');
$res = $mysqli->query('SELECT id, username FROM users');
while($row = $res->fetch_assoc()) echo $row['id'] . ' ' . $row['username'] . "\n";
