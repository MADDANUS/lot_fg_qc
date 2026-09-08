<?php
/**
 * Label Kiri — 95mm lebar × 62mm tinggi
 * 7 kolom (A-G), 14 baris berisi konten.
 *
 * Lebar kolom (skala dari Excel ke 95mm, total unit=47.57):
 *   A=19mm  B=18.5mm  C=20mm  D=13mm  E=5.5mm  F=6mm  G=13mm  → total=95mm
 *
 * Tinggi baris (pt × 0.3528):
 *   R1=5.82  R2=13.50  R3=5.29  R4=3.18  R5=4.76  R6=3.18
 *   R7=5.03  R8=3.44   R9=4.50  R10=1.32 R11=1.85 R12=3.18
 *   R13=3.18  R14=2.65   → total ≈ 62mm
 */
?>
<table style="width:95mm;min-width:95mm;max-width:95mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:9pt;">
<colgroup>
  <col style="width:15mm">  <!-- A -->
  <col style="width:19mm">  <!-- B -->
  <col style="width:23mm">  <!-- C -->
  <col style="width:13.5mm"> <!-- D -->
  <col style="width:5.5mm">  <!-- E -->
  <col style="width:6mm">    <!-- F -->
  <col style="width:13mm">   <!-- G -->
</colgroup>

<!-- R1: A1:E1 = header (cs5, border semua) | F1:G2 = QR (cs2, rs2) -->
<tr>
  <td colspan="5" style="height:4.95mm;border:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">015 - PT. NIHON SEIKI INDONESIA - <?= esc($productName) ?></td>
  <td colspan="2" rowspan="2" style="border:0.3mm solid #000;padding:0;text-align:center;vertical-align:middle;"><?= $qrCodeImg($qrLeft, 150, '16.4mm', 0) ?></td>
</tr>

<!-- R2: A2=kotak (border) | B2="Lot Guarantee" | C2="Lot SA" | D2:E2="4M" | F-G covered -->
<tr>
  <td style="width:15mm;height:11.48mm;border:0.3mm solid #000;"></td>
  <td style="width:19mm;border:0.3mm solid #000;text-align:center;vertical-align:middle;font-size:9pt;"><?= $lotGuarantee ? 'Lot<br>Guarantee' : '' ?></td>
  <td style="width:23mm;border:0.3mm solid #000;text-align:center;vertical-align:middle;font-size:9pt;"><?= $lotSa ? 'Lot SA' : '' ?></td>
  <td colspan="2" style="width:19mm;border:0.3mm solid #000;text-align:center;vertical-align:middle;font-size:9pt;"><?= $is4m ? '4M' : '' ?></td>
</tr>

<!-- R3: A3="Part Code:" bdr-TL | B3:C3=barcode(cs2) bdr-T | D3:G3=description(cs4) bdr-TR -->
<tr>
  <td style="height:4.5mm;border-top:0.3mm solid #000;border-left:0.3mm solid #000;padding:0.3mm 0.5mm;font-size:9pt;vertical-align:middle;">Part Code:</td>
  <td colspan="2" style="border-top:0.3mm solid #000;padding:1mm;vertical-align:middle;"><?= $barcodeSvg($itemCode, 5, 1.0) ?></td>
  <td colspan="4" style="border-top:0.3mm solid #000;border-right:0.3mm solid #000;text-align:center;vertical-align:middle;padding:0.3mm 1mm;font-size:9pt;"><?= esc($description) ?></td>
</tr>

<!-- R4: A4 bdr-L | B4:C4=itemCode(cs2) | D-F empty | G4 bdr-R -->
<tr>
  <td style="height:2.7mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="padding:0.2mm 0.5mm;font-size:9pt;"><?= esc($itemCode) ?></td>
  <td></td><td></td><td></td>
  <td rowspan="7" text-rotate="90" style="border-right:0.3mm solid #000;text-align:right;vertical-align:bottom;font-size:7pt;padding:1mm;">1.5.6786.18740</td>
</tr>

<!-- R5: A5="Lot No.:" bdr-L | B5:C5=barcode(cs2) | D-F empty | G5 bdr-R -->
<tr>
  <td style="height:4.05mm;border-left:0.3mm solid #000;padding:0.3mm 0.5mm;font-size:9pt;vertical-align:middle;">Lot No.:</td>
  <td colspan="2" style="padding:1mm;vertical-align:middle;"><?= $barcodeSvg($lotNoCombined, 4, 1.0) ?></td>
  <td></td><td></td><td></td>
</tr>

<!-- R6: A6 bdr-L | B6:C6=lotNo text(cs2) | D-F empty | G6 bdr-R -->
<tr>
  <td style="height:2.7mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="padding:0.2mm 0.5mm;font-size:9pt;"><?= esc($lotNoCombined) ?></td>
  <td></td><td></td><td></td>
</tr>

<!-- R7: A7="Qty:" bdr-L | B7:C7=barcode(cs2) | D-F empty | G7 bdr-R -->
<tr>
  <td style="height:4.28mm;border-left:0.3mm solid #000;padding:0.3mm 0.5mm;font-size:9pt;vertical-align:middle;">Qty:</td>
  <td colspan="2" style="padding:1mm;vertical-align:middle;"><?= $barcodeSvg($lotQty, 4, 1.0) ?></td>
  <td></td><td></td><td></td>
</tr>

<!-- R8: A8 bdr-L | B8=qty text | C-F empty | G8 bdr-R -->
<tr>
  <td style="height:2.92mm;border-left:0.3mm solid #000;"></td>
  <td style="padding:0.2mm 0.5mm;font-size:9pt;"><?= esc($lotQty) ?></td>
  <td></td><td></td><td></td><td></td>
</tr>

<!-- R9: A9="Ref No.:" bdr-L | B9:C9=barcode(cs2) | D-F empty | G9 bdr-R -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;padding:0.3mm 0.5mm;font-size:9pt;vertical-align:middle;">Ref No.:</td>
  <td colspan="2" style="padding:1mm;vertical-align:middle;"><?= $barcodeSvg($refNo, 4, 1.0) ?></td>
  <td></td><td></td><td></td>
</tr>

<!-- R10: A10 bdr-L | B10:C11=refNo(cs2,rs2,center) | D-F empty | G10 bdr-R -->
<tr>
  <td style="height:1.12mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="text-align:center;vertical-align:middle;font-size:9pt;padding:0.2mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td>
</tr>

<!-- R11: A11 bdr-L | B-C covered | D11 | E11:F14=stamp(cs2,rs4) | G11:G14=stamp(rs4) -->
<tr>
  <td style="height:1.57mm;border-left:0.3mm solid #000;"></td>
  <td></td>
  <td colspan="2" rowspan="4" style="border:0.3mm solid #000;"></td>
  <td rowspan="4" style="border:0.3mm solid #000;"></td>
</tr>

<!-- R12: A12="Remark:" bdr-L | B12=remark | C-D empty | (E-G covered) -->
<tr>
  <td style="height:2.7mm;border-left:0.3mm solid #000;padding:0.3mm 0.5mm;font-size:9pt;vertical-align:middle;">Remark:</td>
  <td style="padding:0.2mm 0.5mm;font-size:9pt;vertical-align:middle;"><?= esc($remark) ?></td>
  <td></td><td></td>
</tr>

<!-- R13: A13 bdr-L | B-D empty | (E-G covered) -->
<tr>
  <td style="height:2.7mm;border-left:0.3mm solid #000;"></td>
  <td></td><td></td><td></td>
</tr>

<!-- R14: A14 bdr-BL | B-D bdr-B | (E-F stamp end) | (G stamp end) -->
<tr>
  <td colspan="4" style="height:2.25mm;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;padding:0.2mm 0.5mm;font-size:9pt;vertical-align:middle;white-space:nowrap;"><?= $now ?></td>
</tr>
</table>
