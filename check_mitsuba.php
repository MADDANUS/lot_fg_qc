<?php
try {
    $conn = new PDO("sqlsrv:Server=10.1.70.250;Database=SBO_NSI_USD_LIVE", "sa", "P@ssw0rd");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        SELECT TOP 5 T0.DocNum, T0.DocDate, T1.ItemCode, T1.Quantity
        FROM OIGN T0
        INNER JOIN IGN1 T1 ON T0.DocEntry = T1.DocEntry
        WHERE T1.ItemCode IN ('A4029-194-02-200', 'A4029-194-02-000')
        ORDER BY T0.DocDate DESC
    ";
    
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
