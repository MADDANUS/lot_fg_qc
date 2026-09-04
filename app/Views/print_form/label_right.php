<?php
/**
 * PARTIAL TEMPLATE — Label Kanan (Customer)
 * Ukuran: 9.5cm × 8.0cm
 *
 * Menggunakan lebar kolom & tinggi baris PERSIS seperti Excel "TEMPLATE lot kanan.xlsx".
 *
 * Col B = 10.86 (25.52%)
 * Col C = 9.71  (22.81%)
 * Col D = 4.86  (11.42%)
 * Col E = 5.14  (12.08%)
 * Col F = 2.71  (6.37%)
 * Col G = 2.57  (6.04%)
 * Col H = 1.71  (4.02%)
 * Col I = 2.86  (6.72%)
 * Col J = 2.14  (5.03%)
 */
?>
<table style="width:95mm;height:80mm;table-layout:fixed;border-collapse:collapse;">
<colgroup>
  <col style="width:25.52%"> <!-- B -->
  <col style="width:22.81%"> <!-- C -->
  <col style="width:11.42%"> <!-- D -->
  <col style="width:12.08%"> <!-- E -->
  <col style="width:6.37%">  <!-- F -->
  <col style="width:6.04%">  <!-- G -->
  <col style="width:4.02%">  <!-- H -->
  <col style="width:6.72%">  <!-- I -->
  <col style="width:5.03%">  <!-- J -->
</colgroup>

<!-- ── Row 1 (12.75 pt) ── -->
<tr style="height:12.75pt;">
  <td colspan="2" style="border-top:0.1mm solid #000;padding:1pt;font-weight:bold;">
    REV : 2/190916
  </td>
  <td colspan="3" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;text-align:center;">
    NR
  </td>
  <td colspan="4" style="border-top:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;font-weight:bold;">
    FM-QCA-18
  </td>
</tr>

<!-- ── Row 2 (10.50 pt) ── -->
<tr style="height:10.50pt;">
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-weight:bold;">
    PT. NIHON SEIKI INDONESIA
  </td>
  <td colspan="5" rowspan="5" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;padding:1pt;">
    <?= $qrCodeImg($qrRight, $qrSize) ?>
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 3 (12.75 pt) ── -->
<tr style="height:12.75pt;">
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-weight:bold;">
    QUALITY CONTROL OK
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 4 (10.50 pt) ── -->
<tr style="height:10.50pt;">
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-weight:bold;">
    PT. <?= esc($customer) ?>
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 5 (9.75 pt) ── -->
<tr style="height:9.75pt;">
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;">
    DATE : <?= $displayDate ?>
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 6 (10.50 pt) ── -->
<tr style="height:10.50pt;">
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-weight:bold;">
    PART NAME :
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 7 (11.25 pt) ── -->
<tr style="height:11.25pt;">
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;">
    <?= esc($description) ?>
  </td>
  <td colspan="5" style="border:0.1mm solid #000;text-align:center;">
    BACK NO <?= esc($backNo) ?>
  </td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 8 (12.00 pt) ── -->
<tr style="height:12.00pt;">
  <td colspan="8" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;padding:1pt;vertical-align:center;">
    PART NO : <?= esc($itemCode) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 9 (12.00 pt) ── -->
<tr style="height:12.00pt;">
  <td colspan="8" style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;text-align:center;">
    <?= $barcodeSvg($itemCode, $barcodeH * 0.7) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 10 (9.75 pt) ── -->
<tr style="height:9.75pt;">
  <td colspan="3" rowspan="2" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;vertical-align:center;">
    LOTNO : <?= esc($lotno) ?>
  </td>
  <td colspan="2" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-size:8pt;">
    Treat/Plat
  </td>
  <td colspan="4" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    Inspection
  </td>
</tr>

<!-- ── Row 11 (1.50 pt) ── -->
<tr style="height:1.50pt;">
  <td colspan="2" rowspan="2" style="border-top:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.1mm solid #000;text-align:center;font-weight:bold;">
    <?= esc($operator) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 12 (5.25 pt) ── -->
<tr style="height:5.25pt;">
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;">
    <?= $barcodeSvg($lotno, $barcodeH * 0.7) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 13 (8.25 pt) ── -->
<tr style="height:8.25pt;">
  <td style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;">
    Marking
  </td>
  <td colspan="3" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    ROHS FREE
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 14 (6.75 pt) ── -->
<tr style="height:6.75pt;">
  <td colspan="3" rowspan="2" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:1pt;vertical-align:center;">
    QTY : <?= esc($lotQty) ?>
  </td>
  <td colspan="2" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="3" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    <?= $rohsFree ? 'YES' : 'NO' ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 15 (3.75 pt) ── -->
<tr style="height:3.75pt;">
  <td colspan="2" rowspan="2" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    <?= esc($warehouse) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 16 (5.25 pt) ── -->
<tr style="height:5.25pt;">
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;">
    <?= $barcodeSvg($lotQty, $barcodeH * 0.7) ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 17 (9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    PRINT DATE
  </td>
  <td colspan="3" style="border:0.1mm solid #000;padding:1pt;font-size:8pt;text-align:center;">
    <?= $printDateLong ?>
  </td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 18 (7.50 pt) ── -->
<tr style="height:7.50pt;">
  <td colspan="4" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;"></td>
  <td colspan="4" style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 19 (9.75 pt) ── -->
<tr style="height:9.75pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:1pt;text-align:center;">
    User
  </td>
  <td colspan="2" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 20 (9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td colspan="4" style="border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:1pt;text-align:center;">
    <?= esc($shiftName ?: $userInitial) ?>
  </td>
  <td colspan="2" style="border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 21 (9.75 pt) ── -->
<tr style="height:9.75pt;">
  <td colspan="8" style="border-bottom:0.1mm solid #000;border-top:0.1mm solid #000;border-left:0.1mm solid #000;padding:1pt;text-align:center;">
    <?= esc($refNo) ?><br>
    <?= $barcodeSvg($refNo, $barcodeH * 0.4) ?>
  </td>
  <td style="border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

</table>
