<?php
/**
 * Label Kanan — 95mm lebar × 80mm tinggi
 * 10 kolom (A-J), 21 baris — PERSIS struktur Excel TEMPLATE lot kanan.xlsx
 *
 * Lebar kolom (skala dari Excel ke 95mm, total unit=45.12):
 *   A=5mm  B=23mm  C=20mm  D=10mm  E=11mm  F=6mm  G=5mm  H=4mm  I=6mm  J=5mm
 *   Total = 95mm
 *
 * Tinggi baris (skala dari Excel pt ke mm, total 66.18pt→80mm, faktor=1.209):
 *   R1=5.4  R2=4.5  R3=5.4  R4=4.5  R5=4.2  R6=4.5  R7=4.8  R8=5.1  R9=5.1
 *   R10=4.2  R11=0.6  R12=2.2  R13=3.5  R14=2.9  R15=1.6  R16=2.2  R17=3.8
 *   R18=3.2  R19=4.2  R20=3.8  R21=4.2  → total ≈ 80mm
 *
 * Merged cells (dari Excel template):
 *   B1:C1(cs2)  D1:F1(cs3)  G1:J1(cs4)
 *   B2:D2(cs3)  E2:I6(rs5,cs5)
 *   B3:D3(cs3)  B4:D4(cs3)  B5:D5(cs3)  B6:D6(cs3)
 *   B7:D7(cs3)  E7:I7(cs5)
 *   B8:I8(cs8)  B9:I9(cs8)
 *   B10:D11(rs2,cs3)  E10:F10(cs2)  G10:I10(cs3)
 *   E11:F12(rs2,cs2)  G11:I12(rs2,cs3)
 *   B12:D13(rs2,cs3)  E13:F13(cs2)  G13:I13(cs3)
 *   B14:D15(rs2,cs3)  E14:F14(cs2)  G14:I14(cs3)
 *   E15:F16(rs2,cs2)  G15:I16(rs2,cs3)
 *   B16:D17(rs2,cs3)  E17:F17(cs2)  G17:I17(cs3)
 *   B18:E19(rs2,cs4)  F19:G19(cs2)
 *   B20:C20(cs2)
 */
$displayItemCode = $itemCode;
?>
<table style="width:95mm;min-width:95mm;max-width:95mm;table-layout:fixed;border-collapse:collapse;font-family:'Calibri','dejavusans',Arial,sans-serif;font-size:9pt;">
<colgroup>
  <col style="width:3mm">  <!-- A -->
  <col style="width:25mm"> <!-- B -->
  <col style="width:auto"> <!-- C (akan meregang menyerap sisa ruang) -->
  <col style="width:10mm"> <!-- D -->
  <col style="width:11mm"> <!-- E -->
  <col style="width:6mm">  <!-- F -->
  <col style="width:5mm">  <!-- G -->
  <col style="width:4mm">  <!-- H -->
  <col style="width:6mm">  <!-- I -->
  <col style="width:3mm">  <!-- J -->
</colgroup>

<!-- ═══ R1 ═══: A1 bdr-TL | B1:C1="REV" cs2 bdr-T bold | D1:F1="NR" cs3 bdr-TB center | G1:J1="FM-QCA-18" cs4 bdr-TR bold right -->
<tr>
  <td style="height:4.59mm;border-top:0.3mm solid #000;border-left:0.3mm solid #000;width:3mm;max-width:3mm;"><div style="width:3mm;"></div></td>
  <td colspan="2" style="border-top:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-bottom:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;white-space:nowrap;">NR <?= esc($docNumber) ?></td>
  <td colspan="4" style="border-top:0.3mm solid #000;border-right:0.3mm solid #000;text-align:right;font-weight:bold;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">FM-QCA-18</td>
</tr>

<!-- ═══ R2 ═══: A2 bdr-L | B2:D2="PT.NIHON" cs3 bdr-TLR bold | E2:I6=QR rs5,cs5 bdr-all | J2 bdr-R -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;padding:0;line-height:0;"><?= $qrCodeImg($qrRight, 200, '19mm') ?></td>
  <td style="border-right:0.3mm solid #000;width:3mm;max-width:3mm;"><div style="width:3mm;"></div></td>
</tr>

<!-- ═══ R3 ═══: A3 bdr-L | B3:D3="QC OK" cs3 bdr-BLR bold | (QR covered) | J3 bdr-R -->
<tr>
  <td style="height:4.59mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">QUALITY CONTROL OK</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R4 ═══: A4 bdr-L | B4:D4="PT.CUSTOMER" cs3 bdr-TLR bold | (QR covered) | J4 bdr-R -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;"><?= esc($customer) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R5 ═══: A5 bdr-L | B5:D5="DATE" cs3 bdr-BLR | (QR covered) | J5 bdr-R -->
<tr>
  <td style="height:3.57mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>DATE :</b> <?= $displayDate ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R6 ═══: A6 bdr-L | B6:D6="PART NAME:" cs3 bdr-TLR bold | (QR covered last row) | J6 bdr-R -->
<tr>
  <td style="height:3.83mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-weight:bold;font-size:9pt;vertical-align:middle;">PART NAME :</td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R7 ═══: A7 bdr-L | B7:D7=description cs3 bdr-BLR | E7:I7="BACK NO" cs5 bdr-all center | J7 bdr-R -->
<tr>
  <td style="height:4.08mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.3mm solid #000;text-align:center;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R8 ═══: A8 bdr-L | B8:I8="PART NO:..." cs8 bdr-TLR | J8 bdr-LR -->
<tr>
  <td style="height:4.34mm;border-left:0.3mm solid #000;"></td>
  <td colspan="8" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:middle;"><b>PART NO :</b> <?= esc($displayItemCode) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R9 ═══: A9 bdr-L | B9:I9=barcode cs8 bdr-BLR center | J9 bdr-LR -->
<tr>
  <td style="height:6mm;border-left:0.3mm solid #000;"></td>
  <td colspan="8" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($displayItemCode, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R10 ═══: A10 bdr-L | B10:D11="LOTNO" cs3,rs2 bdr-TLR | E10:F10="Treat/Plat" cs2 bdr-all | G10:I10="Inspection" cs3 bdr-all | J10 bdr-LR -->
<tr>
  <td style="height:3.57mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:top;"><b>LOTNO :</b> <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;">Treat/Plat</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">Inspection</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R11 ═══: A11 bdr-L | (B-D covered LOTNO) | E11:F12=empty cs2,rs2 bdr-all | G11:I12=operator cs3,rs2 bdr-all bold center | J11 bdr-LR -->
<tr>
  <td style="height:0.51mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.3mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;font-size:9pt;"><?= esc($operator) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R12 ═══: A12 bdr-L | B12:D13=barcode(lotno) cs3,rs2 bdr-BLR | (E-F covered) | (G-I covered) | J12 bdr-LR -->
<tr>
  <td style="height:1.87mm;border-left:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($lotno, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R13 ═══: A13 bdr-L | (B-D covered barcode) | E13:F13="Marking" cs2 bdr-all | G13:I13="ROHS FREE" cs3 bdr-all center | J13 bdr-LR -->
<tr>
  <td style="height:2.98mm;border-left:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;">Marking</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;">ROHS FREE</td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R14 ═══: A14 bdr-LR | B14:D15="QTY" cs3,rs2 bdr-TLR | E14:F14=empty cs2 bdr-all | G14:I14=YES cs3 bdr-all | J14 bdr-LR -->
<tr>
  <td style="height:2.47mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;padding:0.3mm 1mm;font-size:9pt;vertical-align:top;"><b>QTY :</b> <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R15 ═══: A15 bdr-LR | (B-D covered QTY) | E15:F16=empty cs2,rs2 bdr-all | G15:I16=warehouse cs3,rs2 bdr-all | J15 bdr-LR -->
<tr>
  <td style="height:1.36mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.3mm solid #000;padding:0.3mm;font-size:9pt;vertical-align:middle;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R16 ═══: A16 bdr-LR | B16:D17=barcode(qty) cs3,rs2 bdr-BLR | (E-F covered) | (G-I covered) | J16 bdr-LR -->
<tr>
  <td style="height:1.87mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;border-right:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($lotQty, 5, 1.0) ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R17 ═══: A17 bdr-LR | (B-D covered barcode) | E17:F17="PRINT DATE" cs2 bdr-all center | G17:I17=date cs3 bdr-all center | J17 bdr-LR -->
<tr>
  <td style="height:3.23mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.3mm solid #000;text-align:center;font-size:7pt;vertical-align:middle;padding:0.3mm;white-space:nowrap;">PRINT DATE</td>
  <td colspan="3" style="border:0.3mm solid #000;text-align:center;font-size:9pt;vertical-align:middle;"><?= $printDateLong ?></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R18 ═══: A18 bdr-LR | B18:E19=barcode(refNo) cs4,rs2 bdr-TL | F-I empty | J18 bdr-LR -->
<tr>
  <td style="height:2mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.3mm solid #000;border-left:0.3mm solid #000;text-align:left;vertical-align:middle;padding:1mm;"><?= $barcodeSvg($refNo, 5, 1.0) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R19 ═══: A19 bdr-LR | (B-E covered barcode) | F19:G19="User" cs2 bdr-all center | H-I empty | J19 bdr-LR -->
<tr>
  <td style="height:2mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="2" style="border:0.8mm solid #000;text-align:center;font-size:9pt;font-weight:bold;vertical-align:middle;"><?= esc($userInitial) ?></td>
  <td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R20 ═══: A20 bdr-LR | B20:C20=refNo text cs2 center | D-I empty | J20 bdr-LR -->
<tr>
  <td style="height:3.23mm;border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
  <td colspan="4" style="text-align:center;font-size:9pt;vertical-align:middle;padding:0.5mm;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.3mm solid #000;border-right:0.3mm solid #000;"></td>
</tr>

<!-- ═══ R21 ═══: A21 bdr-BL | B-I bdr-TB | J21 bdr-BR -->
<tr>
  <td style="height:3.57mm;border-bottom:0.3mm solid #000;border-left:0.3mm solid #000;"></td>
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
