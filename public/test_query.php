<?php
header('Content-Type: text/plain; charset=utf-8');

$host     = '10.1.70.250,1433';
$database = 'SBO_NSI_USD_LIVE';
$username = 'sa';
$password = 'P@ssw0rd';

$conn = sqlsrv_connect($host, [
    'Database'              => $database,
    'UID'                   => $username,
    'PWD'                   => $password,
    'LoginTimeout'          => 5,
    'TrustServerCertificate'=> true,
    'CharacterSet'          => 'UTF-8',
]);

if (!$conn) {
    echo "Koneksi gagal!\n";
    print_r(sqlsrv_errors());
    exit;
}

echo "=== TEST QUERY CUSTOMERS (Query dari pusat) ===\n\n";

// Query asli dari pusat
$sql1 = "
    SELECT TOP 5 T0.[ItemCode], T1.[CardCode], T2.[CardName]
    FROM DLN1 T0
    INNER JOIN ODLN T1 ON T0.[DocEntry] = T1.[DocEntry]
    INNER JOIN OCRD T2 ON T0.[BaseCard]  = T2.[CardCode]
    WHERE T2.[ValidFor] = 'Y'
    GROUP BY T1.[CardCode], T2.[CardName], T0.[ItemCode]
    ORDER BY T0.[ItemCode]
";

echo "-- Query 1 (BaseCard join) --\n";
$stmt1 = sqlsrv_query($conn, $sql1);
if ($stmt1 === false) {
    echo "GAGAL: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $count = 0;
    while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
        echo "  {$row['CardCode']} | {$row['CardName']} | {$row['ItemCode']}\n";
        $count++;
    }
    echo "  Total: $count baris\n";
}

echo "\n-- Cek kolom BaseCard di DLN1 --\n";
$sqlChk = "SELECT TOP 1 * FROM DLN1";
$stmtChk = sqlsrv_query($conn, $sqlChk);
if ($stmtChk) {
    $row = sqlsrv_fetch_array($stmtChk, SQLSRV_FETCH_ASSOC);
    if ($row) {
        $cols = array_keys($row);
        echo "Kolom DLN1: " . implode(', ', $cols) . "\n";
        echo "BaseCard = " . ($row['BaseCard'] ?? 'NULL/tidak ada') . "\n";
    }
}

echo "\n-- Query alternatif (CardCode dari ODLN langsung) --\n";
$sql2 = "
    SELECT TOP 5 T1.[ItemCode], T0.[CardCode], T2.[CardName]
    FROM ODLN T0
    INNER JOIN DLN1 T1 ON T0.[DocEntry] = T1.[DocEntry]
    INNER JOIN OCRD T2 ON T0.[CardCode]  = T2.[CardCode]
    WHERE T2.[ValidFor] = 'Y'
    GROUP BY T0.[CardCode], T2.[CardName], T1.[ItemCode]
    ORDER BY T1.[ItemCode]
";
$stmt2 = sqlsrv_query($conn, $sql2);
if ($stmt2 === false) {
    echo "GAGAL: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $count = 0;
    while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
        echo "  {$row['CardCode']} | {$row['CardName']} | {$row['ItemCode']}\n";
        $count++;
    }
    echo "  Total: $count baris\n";
}

sqlsrv_close($conn);
echo "\n=== SELESAI ===\n";
