<?php
/**
 * Default Small — Label Card (1 unit)
 * 70mm lebar × 62mm tinggi
 * Skala dari medium: lebar 70/95=0.737x, tinggi 62/80=0.775x
 *
 * Lebar kolom (0.737x dari medium):
 *   A=3.7  B=17  C=14.7  D=7.4  E=8.1  F=4.4  G=3.7  H=2.9  I=4.4  J=3.7 → ≈70mm
 * Font: 7pt
 */
?>
<table style="width:70mm;min-width:70mm;max-width:70mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:7pt;">
<colgroup>
  <col style="width:2mm">    <!-- A -->
  <col style="width:17mm">   <!-- B -->
  <col style="width:auto">   <!-- C -->
  <col style="width:7.4mm">  <!-- D -->
  <col style="width:8.1mm">  <!-- E -->
  <col style="width:4.4mm">  <!-- F -->
  <col style="width:3.7mm">  <!-- G -->
  <col style="width:2.9mm">  <!-- H -->
  <col style="width:4.4mm">  <!-- I -->
  <col style="width:2mm">    <!-- J -->
</colgroup>

<!-- R1 -->
<tr>
  <td style="height:4.2mm;border-top:0.2mm solid #000;border-left:0.2mm solid #000;width:2mm;max-width:2mm;"><div style="width:2mm;"></div></td>
  <td colspan="2" style="border-top:0.2mm solid #000;padding:0.2mm 0.7mm;font-weight:bold;font-size:7pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.2mm solid #000;border-right:0.2mm solid #000;text-align:right;font-weight:bold;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:middle;">FM-QCA-18</td>
</tr>
<!-- R2 -->
<tr>
  <td style="height:3.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-weight:bold;font-size:7pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.2mm solid #000;text-align:center;vertical-align:middle;padding:0;line-height:0;"><?= $qrCodeImg($qrRight, 150, '15mm', 0) ?></td>
  <td style="border-right:0.2mm solid #000;width:2mm;max-width:2mm;"><div style="width:2mm;"></div></td>
</tr>
<!-- R3 -->
<tr>
  <td style="height:4.2mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-weight:bold;font-size:7pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R4 -->
<tr>
  <td style="height:3.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-weight:bold;font-size:7pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R5 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:middle;"><b>DATE:</b> <?= $displayDate ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R6 -->
<tr>
  <td style="height:3.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-weight:bold;font-size:7pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R7 -->
<tr>
  <td style="height:3.7mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.2mm solid #000;text-align:center;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.2mm solid #000;"></td>
</tr>
<!-- R8 -->
<tr>
  <td style="height:4mm;border-left:0.2mm solid #000;"></td>
  <td colspan="8" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:middle;"><b>PART NO:</b> <?= esc($itemCode) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R9 -->
<tr>
  <td style="height:4mm;border-left:0.2mm solid #000;"></td>
  <td colspan="8" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.7mm;"><?= $barcodeSvg($itemCode, 3.5, 0.8) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R10 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:top;"><b>LOTNO:</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:7pt;vertical-align:middle;">Treat/Plat</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R11 -->
<tr>
  <td style="height:0.5mm;border-left:0.2mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.2mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;font-size:7pt;"><?= esc($operator) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R12 -->
<tr>
  <td style="height:1.7mm;border-left:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.7mm;"><?= $barcodeSvg($lotno, 3.5, 0.8) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R13 -->
<tr>
  <td style="height:2.7mm;border-left:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:7pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R14 -->
<tr>
  <td style="height:2.2mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;padding:0.2mm 0.7mm;font-size:7pt;vertical-align:top;"><b>QTY:</b> <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" style="border:0.2mm solid #000;padding:0.2mm;font-size:7pt;vertical-align:middle;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R15 -->
<tr>
  <td style="height:1.2mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.2mm solid #000;padding:0.2mm;font-size:7pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R16 -->
<tr>
  <td style="height:1.7mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;border-right:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.7mm;"><?= $barcodeSvg($lotQty, 3.5, 0.8) ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R17 -->
<tr>
  <td style="height:2.9mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.2mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;padding:0.2mm;white-space:nowrap;">PRINT DATE</td>
  <td colspan="3" style="border:0.2mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R18 -->
<tr>
  <td style="height:2.5mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.2mm solid #000;border-left:0.2mm solid #000;text-align:left;vertical-align:middle;padding:0.7mm;"><?= $barcodeSvg($refNo, 3.5, 0.8) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R19 -->
<tr>
  <td style="height:3.3mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="2" style="border:0.6mm solid #000;text-align:center;font-size:7pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R20 -->
<tr>
  <td style="height:2.9mm;border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
  <td colspan="4" style="text-align:center;font-size:7pt;vertical-align:middle;padding:0.3mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
<!-- R21 -->
<tr>
  <td style="height:3.3mm;border-bottom:0.2mm solid #000;border-left:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-top:0.2mm solid #000;border-bottom:0.2mm solid #000;"></td>
  <td style="border-bottom:0.2mm solid #000;border-right:0.2mm solid #000;"></td>
</tr>
</table>

