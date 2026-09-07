<?php
/**
 * Default Large — Label Card (1 unit)
 * 187mm lebar × 123mm tinggi
 * Skala dari medium: lebar 187/95=1.968x, tinggi 123/80=1.538x
 *
 * Lebar kolom (1.968x dari medium):
 *   A=9.8  B=45.3  C=39.4  D=19.7  E=21.6  F=11.8  G=9.8  H=7.9  I=11.8  J=9.8 → ≈187mm
 * Font: 14pt
 */
?>
<table style="width:187mm;min-width:187mm;max-width:187mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:14pt;">
<colgroup>
  <col style="width:9.8mm">  <!-- A -->
  <col style="width:45.3mm"> <!-- B -->
  <col style="width:39.4mm"> <!-- C -->
  <col style="width:19.7mm"> <!-- D -->
  <col style="width:21.6mm"> <!-- E -->
  <col style="width:11.8mm"> <!-- F -->
  <col style="width:9.8mm">  <!-- G -->
  <col style="width:7.9mm">  <!-- H -->
  <col style="width:11.8mm"> <!-- I -->
  <col style="width:9.8mm">  <!-- J -->
</colgroup>

<!-- R1 -->
<tr>
  <td style="height:8.3mm;border-top:0.4mm solid #000;border-left:0.4mm solid #000;"></td>
  <td colspan="2" style="border-top:0.4mm solid #000;padding:0.5mm 1.5mm;font-weight:bold;font-size:14pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.4mm solid #000;border-right:0.4mm solid #000;text-align:right;font-weight:bold;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:middle;">FM-QCA-18</td>
</tr>
<!-- R2 -->
<tr>
  <td style="height:6.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-weight:bold;font-size:14pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.4mm solid #000;text-align:center;vertical-align:middle;"><?= $qrCodeImg($qrRight, 120, '37mm', 2) ?></td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R3 -->
<tr>
  <td style="height:8.3mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-weight:bold;font-size:14pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R4 -->
<tr>
  <td style="height:6.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-weight:bold;font-size:14pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R5 -->
<tr>
  <td style="height:6.5mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:middle;"><b>DATE :</b> <?= $displayDate ?></td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R6 -->
<tr>
  <td style="height:6.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-weight:bold;font-size:14pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R7 -->
<tr>
  <td style="height:7.4mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.4mm solid #000;text-align:center;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.4mm solid #000;"></td>
</tr>
<!-- R8 -->
<tr>
  <td style="height:7.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="8" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:middle;"><b>PART NO :</b> <?= esc($itemCode) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R9 -->
<tr>
  <td style="height:7.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="8" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;text-align:left;vertical-align:middle;padding:1.5mm;"><?= $barcodeSvg($itemCode, 7, 1.5) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R10 -->
<tr>
  <td style="height:6.5mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:top;"><b>LOTNO :</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.4mm solid #000;padding:0.5mm;font-size:14pt;vertical-align:middle;">Treat/Plat</td>
  <td colspan="3" style="border:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R11 -->
<tr>
  <td style="height:0.9mm;border-left:0.4mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.4mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;font-size:14pt;"><?= esc($operator) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R12 -->
<tr>
  <td style="height:3.4mm;border-left:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;text-align:left;vertical-align:middle;padding:1.5mm;"><?= $barcodeSvg($lotno, 7, 1.5) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R13 -->
<tr>
  <td style="height:5.4mm;border-left:0.4mm solid #000;"></td>
  <td colspan="2" style="border:0.4mm solid #000;padding:0.5mm;font-size:14pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R14 -->
<tr>
  <td style="height:4.5mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;padding:0.5mm 1.5mm;font-size:14pt;vertical-align:top;"><b>QTY :</b> <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.4mm solid #000;"></td>
  <td colspan="3" style="border:0.4mm solid #000;padding:0.5mm;font-size:14pt;vertical-align:middle;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R15 -->
<tr>
  <td style="height:2.5mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.4mm solid #000;padding:0.5mm;font-size:14pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R16 -->
<tr>
  <td style="height:3.4mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;border-right:0.4mm solid #000;text-align:left;vertical-align:middle;padding:1.5mm;"><?= $barcodeSvg($lotQty, 7, 1.5) ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R17 -->
<tr>
  <td style="height:5.8mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="2" style="border:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;padding:0.5mm;">PRINT DATE</td>
  <td colspan="3" style="border:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R18 -->
<tr>
  <td style="height:4.9mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.4mm solid #000;border-left:0.4mm solid #000;text-align:left;vertical-align:middle;padding:1.5mm;"><?= $barcodeSvg($refNo, 7, 1.5) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R19 -->
<tr>
  <td style="height:6.5mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="2" style="border:0.4mm solid #000;text-align:center;font-size:14pt;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td></td><td></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R20 -->
<tr>
  <td style="height:5.8mm;border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
  <td colspan="4" style="text-align:center;font-size:14pt;vertical-align:middle;padding:0.5mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
<!-- R21 -->
<tr>
  <td style="height:6.5mm;border-bottom:0.4mm solid #000;border-left:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-top:0.4mm solid #000;border-bottom:0.4mm solid #000;"></td>
  <td style="border-bottom:0.4mm solid #000;border-right:0.4mm solid #000;"></td>
</tr>
</table>

