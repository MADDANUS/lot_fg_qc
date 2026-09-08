<?php
header('Content-Type: text/plain; charset=utf-8');

$host     = '10.1.70.250,1433';
$database = 'SBO_NSI_USD_LIVE';
$username = 'sa';
$password = 'P@ssw0rd';

echo "=== TEST KONEKSI SQL SERVER ===\n\n";

// Test 1: sqlsrv_connect
echo "1. Mencoba sqlsrv_connect ke $host ...\n";
$conn = sqlsrv_connect($host, [
    'Database'              => $database,
    'UID'                   => $username,
    'PWD'                   => $password,
    'LoginTimeout'          => 5,
    'TrustServerCertificate'=> true,
    'CharacterSet'          => 'UTF-8',
]);

if ($conn === false) {
    echo "   GAGAL!\n";
    echo "   Error:\n";
    $errors = sqlsrv_errors();
    foreach ($errors as $e) {
        echo "   SQLSTATE: {$e['SQLSTATE']}\n";
        echo "   Code   : {$e['code']}\n";
        echo "   Message: {$e['message']}\n";
    }
} else {
    echo "   BERHASIL TERHUBUNG!\n\n";

    // Test 2: simple query
    echo "2. Mencoba SELECT TOP 3 dari OCRD...\n";
    $sql = "SELECT TOP 3 [CardCode], [CardName], [ValidFor] FROM OCRD WHERE ValidFor='Y'";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        echo "   Query GAGAL!\n";
        foreach (sqlsrv_errors() as $e) {
            echo "   " . $e['message'] . "\n";
        }
    } else {
        echo "   Query berhasil! Hasil:\n";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "   - {$row['CardCode']} | {$row['CardName']}\n";
        }
    }

    sqlsrv_close($conn);
}

echo "\n=== SELESAI ===\n";
