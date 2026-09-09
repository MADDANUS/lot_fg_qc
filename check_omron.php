<?php
try {
    $conn = new PDO("sqlsrv:Server=10.1.70.250;Database=SBO_NSI_USD_LIVE", "sa", "P@ssw0rd");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT T0.CardCode, T0.CardName FROM OCRD T0 INNER JOIN OSCN T1 ON T0.CardCode = T1.CardCode WHERE T1.ItemCode='2244034-3C'";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
