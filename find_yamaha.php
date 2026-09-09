<?php
try {
    $conn = new PDO("sqlsrv:Server=10.1.70.250;Database=SBO_NSI_USD_LIVE", "sa", "P@ssw0rd");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
    SELECT TOP 10 T0.[DocNum], T1.[ItemCode], T2.[CardName]
    FROM OIGN T0
    INNER JOIN IGN1 T1 ON T0.[DocEntry] = T1.[DocEntry]
    INNER JOIN (
        SELECT DISTINCT T0.[ItemCode], T2.[CardName]
        FROM DLN1 T0
        INNER JOIN ODLN T1 ON T0.[DocEntry] = T1.[DocEntry]
        INNER JOIN OCRD T2 ON T0.[BaseCard] = T2.[CardCode]
        WHERE T2.[CardName] LIKE '%YAMAHA%'
    ) T2 ON T1.[ItemCode] = T2.[ItemCode]
    ORDER BY T0.[DocDate] DESC
    ";
    
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
