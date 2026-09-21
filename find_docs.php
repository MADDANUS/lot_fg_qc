<?php
define('FCPATH', __DIR__ . '/public' . DIRECTORY_SEPARATOR);
require FCPATH . '../app/Config/Paths.php';
$paths = new Config\Paths();
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once SYSTEMPATH . 'Config/DotEnv.php';
(new CodeIgniter\Config\DotEnv(ROOTPATH))->load();

$db = \Config\Database::connect('sqlsvr');

$customers = ['KIYOKUNI INDONESIA', 'KIYOKUNI TECHNOLOGIES', 'PATCO ELEKTRONIK TEKNOLOGI', 'NESINAK INDUSTRIES', 'MURAMOTO ELEKTRONIKA INDONESIA'];

foreach ($customers as $cust) {
    echo "--- CUSTOMER: $cust ---\n";
    $sql = "
        SELECT TOP 3 T0.DocNum, T1.ItemCode
        FROM OIGN T0
        INNER JOIN IGN1 T1 ON T0.DocEntry = T1.DocEntry
        WHERE T1.ItemCode IN (
            SELECT D0.ItemCode
            FROM DLN1 D0
            INNER JOIN ODLN D1 ON D0.DocEntry = D1.DocEntry
            INNER JOIN OCRD D2 ON D0.BaseCard = D2.CardCode
            WHERE D2.CardName LIKE '%" . str_replace(' ', '%', $cust) . "%'
        )
        ORDER BY T0.DocDate DESC
    ";
    try {
        $query = $db->query($sql);
        $result = $query->getResultArray();
        if (empty($result)) {
            echo "No documents found.\n";
        } else {
            foreach ($result as $row) {
                echo "DocNum: {$row['DocNum']} | ItemCode: {$row['ItemCode']}\n";
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
    echo "\n";
}
