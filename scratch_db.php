<?php
try {
    $pdo = new PDO("sqlsrv:Server=10.1.70.250;Database=SBO_NSI_USD_LIVE", "sa", "P@ssw0rd");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT T0.[DocNum], T1.[U_MIS_LotNo], T1.[ItemCode], T0.[DocDate] 
            FROM OIGN T0 
            INNER JOIN IGN1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
            WHERE T1.[U_MIS_LotNo] LIKE '%26831A32Q10%'";
    $stmt = $pdo->query($sql);
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

    // Also try ODLN (Delivery)
    $sql2 = "SELECT T0.[DocNum], T1.[U_MIS_LotNo], T1.[ItemCode], T0.[DocDate]
            FROM ODLN T0 
            INNER JOIN DLN1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
            WHERE T1.[U_MIS_LotNo] LIKE '%26831A32Q10%'";
    $stmt2 = $pdo->query($sql2);
    print_r("From ODLN:\n");
    print_r($stmt2->fetchAll(PDO::FETCH_ASSOC));

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
