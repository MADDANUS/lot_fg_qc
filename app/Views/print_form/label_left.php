<?php
/**
 * PARTIAL TEMPLATE — Label Kiri (Pabrik)
 * Ukuran: 9.6cm × 7.2cm
 *
 * Menggunakan lebar kolom & tinggi baris PERSIS seperti Excel "TEMPLATE lot kiri.xlsx".
 *
 * Col A = 9.57 (20.12%)
 * Col B = 9.29 (19.53%)
 * Col C = 10.00 (21.02%)
 * Col D = 6.57 (13.81%)
 * Col E = 2.71 (5.70%)
 * Col F = 3.14 (6.60%)
 * Col G = 6.29 (13.22%)
 */
?>
<table style="width:96mm;height:72mm;table-layout:fixed;border-collapse:collapse;">
<colgroup>
  <col style="width:20.12%"> <!-- A -->
  <col style="width:19.53%"> <!-- B -->
  <col style="width:21.02%"> <!-- C -->
  <col style="width:13.81%"> <!-- D -->
  <col style="width:5.70%">  <!-- E -->
  <col style="width:6.60%">  <!-- F -->
  <col style="width:13.22%"> <!-- G -->
</colgroup>

<!-- ── Row 1 (Height: 16.50 pt) ── -->
<tr style="height:16.50pt;">
  <td colspan="5" style="border:0.1mm solid #000;padding:1pt;font-weight:bold;">
    015 - PT. NIHON SEIKI INDONESIA - <?= esc($productName) ?>
  </td>
  <td colspan="2" rowspan="2" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;padding:1pt;">
    <?= $qrCodeImg($qrLeft, $qrSize) ?>
  </td>
</tr>

<!-- ── Row 2 (Height: 38.25 pt) ── -->
<tr style="height:38.25pt;">
  <td style="border:0.1mm solid #000;"></td>
  <td style="border:0.1mm solid #000;text-align:center;font-size:10pt;">
    <?php if ($lotGuarantee): ?>Lot Guarantee<?php endif; ?>
  </td>
  <td style="border:0.1mm solid #000;text-align:center;font-size:10pt;">
    <?php if ($lotSa): ?>Lot SA<?php endif; ?>
  </td>
  <td colspan="2" style="border:0.1mm solid #000;text-align:center;font-size:10pt;">
    <?php if ($is4m): ?>4M<?php endif; ?>
  </td>
</tr>

<!-- ── Row 3 (Height: 15.00 pt) ── -->
<tr style="height:15.00pt;">
  <td style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;padding:1pt;vertical-align:top;">
    Part Code:
  </td>
  <td style="border-top:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;"></td>
  <td colspan="4" style="border-top:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;font-weight:bold;padding:1pt;">
    <?= esc($description) ?>
  </td>
</tr>

<!-- ── Row 4 (Height: 9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="padding:1pt;vertical-align:center;">
    <?= esc($itemCode) ?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 5 (Height: 13.50 pt) ── -->
<tr style="height:13.50pt;">
  <td style="border-left:0.1mm solid #000;padding:1pt;vertical-align:top;">
    Lot No.:
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 6 (Height: 9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="padding:1pt;vertical-align:center;">
    <?= esc($lotNoCombined) ?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 7 (Height: 14.25 pt) ── -->
<tr style="height:14.25pt;">
  <td style="border-left:0.1mm solid #000;padding:1pt;vertical-align:top;">
    Qty:
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 8 (Height: 9.75 pt) ── -->
<tr style="height:9.75pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td style="padding:1pt;vertical-align:center;">
    <?= esc($lotQty) ?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 9 (Height: 12.75 pt) ── -->
<tr style="height:12.75pt;">
  <td style="border-left:0.1mm solid #000;padding:1pt;vertical-align:top;">
    Ref No.:
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 10 (Height: 3.75 pt) ── -->
<tr style="height:3.75pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="padding:1pt;vertical-align:center;text-align:center;">
    <?= esc($refNo) ?><br>
    <?= $barcodeSvg($refNo, $barcodeH * 0.4) ?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- ── Row 11 (Height: 5.25 pt) ── -->
<tr style="height:5.25pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <!-- B10:C11 is rowspan 2 -->
  <td></td>
  <td colspan="2" rowspan="4" style="border:0.1mm solid #000;text-align:center;"></td>
  <td rowspan="4" style="border:0.1mm solid #000;text-align:center;"></td>
</tr>

<!-- ── Row 12 (Height: 9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td style="border-left:0.1mm solid #000;padding:1pt;vertical-align:center;">
    Remark:
  </td>
  <td style="padding:1pt;vertical-align:center;"><?= esc($remark) ?></td>
  <td></td>
  <td></td>
  <!-- E, F, G are rowspan 4 -->
</tr>

<!-- ── Row 13 (Height: 9.00 pt) ── -->
<tr style="height:9.00pt;">
  <td style="border-left:0.1mm solid #000;"></td>
  <td></td>
  <td></td>
  <td></td>
</tr>

<!-- ── Row 14 (Height: 7.50 pt) ── -->
<tr style="height:7.50pt;">
  <td style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;padding:1pt;vertical-align:center;font-size:8pt;">
    <?= $now ?>
  </td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;"></td>
</tr>

<!-- Sisa tinggi bisa dibiarkan kosong, tabel akan mentok 72mm -->
</table>
