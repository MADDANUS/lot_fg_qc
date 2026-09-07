<?php
/**
 * Default Medium — Label Card (1 unit)
 * 95mm lebar × 80mm tinggi — isi identik dengan label_right.php (Medium/Epson)
 *
 * Lebar kolom: A=5  B=23  C=20  D=10  E=11  F=6  G=5  H=4  I=6  J=5  → 95mm
 * Tinggi: R1=5.4 R2=4.5 R3=5.4 R4=4.5 R5=4.2 R6=4.5 R7=4.8 R8=5.1 R9=5.1
 *         R10=4.2 R11=0.6 R12=2.2 R13=3.5 R14=2.9 R15=1.6 R16=2.2 R17=3.8
 *         R18=3.2 R19=4.2 R20=3.8 R21=4.2 → ≈80mm
 */
?>
<table style="width:95mm;min-width:95mm;max-width:95mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:9pt;">
<colgroup>
  <col style="width:5mm">  <!-- A -->
  <col style="width:23mm"> <!-- B -->
  <col style="width:20mm"> <!-- C -->
  <col style="width:10mm"> <!-- D -->
  <col style="width:11mm"> <!-- E -->
  <col style="width:6mm">  <!-- F -->
  <col style="width:5mm">  <!-- G -->
  <col style="width:4mm">  <!-- H -->
  <col style="width:6mm">  <!-- I -->
  <col style="width:5mm">  <!-- J -->
</colgroup>

<!-- R1 -->
<tr>
  <td style="height:5.4mm;border-top:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border-top:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.3mm solid #000;border-right:0.3mm solid #000;text-align:right;font-weight:bold;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">FM-QCA-18</td>
</tr>
<!-- R2 -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;"><?= $qrCodeImg($qrRight, $qrSize) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R3 -->
<tr>
  <td style="height:5.4mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R4 -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R5 -->
<tr>
  <td style="height:4.2mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>DATE :</b> <?= $displayDate ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R6 -->
<tr>
  <td style="height:4.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R7 -->
<tr>
  <td style="height:4.8mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>
<!-- R8 -->
<tr>
  <td style="height:5.1mm;border-left:0.3mm solid #000;"></td>
  <td colspan="8" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>PART NO :</b> <?= esc($itemCode) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R9 -->
<tr>
  <td style="height:5.1mm;border-left:0.3mm solid #000;"></td>
  <td colspan="8" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($itemCode, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R10 -->
<tr>
  <td style="height:4.2mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:top;"><b>LOTNO :</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;">Treat/Plat</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R11 -->
<tr>
  <td style="height:0.6mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;font-size:9pt;"><?= esc($operator) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R12 -->
<tr>
  <td style="height:2.2mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($lotno, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R13 -->
<tr>
  <td style="height:3.5mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R14 -->
<tr>
  <td style="height:2.9mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:top;"><b>QTY :</b> <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R15 -->
<tr>
  <td style="height:1.6mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R16 -->
<tr>
  <td style="height:2.2mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($lotQty, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R17 -->
<tr>
  <td style="height:3.8mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;padding:0.3mm;">PRINT DATE</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R18 -->
<tr>
  <td style="height:3.2mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($refNo, 5, 1.0) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R19 -->
<tr>
  <td style="height:4.2mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R20 -->
<tr>
  <td style="height:3.8mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="4" style="text-align:center;font-size:9pt;vertical-align:middle;padding:0.5mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
<!-- R21 -->
<tr>
  <td style="height:4.2mm;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;"></td>
  <td style="border-bottom:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>
</table>

