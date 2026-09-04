<?php
/**
 * PARTIAL — Label Kanan (Customer)
 * Ukuran: 9.5cm × 8.0cm
 *
 * PERSIS dari TEMPLATE lot kanan.xlsx
 * 10 kolom (A–J), 21 baris
 *
 * Kolom (Excel units → mm proporsional dlm 95mm, total=45.12):
 *   A=2.57→5.41mm   B=10.86→22.86mm  C=9.71→20.44mm   D=4.86→10.23mm
 *   E=5.14→10.82mm  F=2.71→5.71mm    G=2.57→5.41mm    H=1.71→3.60mm
 *   I=2.86→6.02mm   J=2.14→4.51mm
 *
 * Baris (Excel pt → mm):
 *   R1=12.75→4.50   R2=10.50→3.71   R3=12.75→4.50   R4=10.50→3.71
 *   R5=9.75→3.44    R6=10.50→3.71   R7=11.25→3.97   R8=12.00→4.23
 *   R9=12.00→4.23   R10=9.75→3.44   R11=1.50→0.53   R12=5.25→1.85
 *   R13=8.25→2.91   R14=6.75→2.38   R15=3.75→1.32   R16=5.25→1.85
 *   R17=9.00→3.18   R18=7.50→2.65   R19=9.75→3.44   R20=9.00→3.18
 *   R21=9.75→3.44
 *
 * Merged cells (dari Excel):
 *   B1:C1(cs2) D1:F1(cs3) G1:J1(cs4)
 *   B2:D2(cs3) E2:I6(rs5,cs5) B3:D3(cs3) B4:D4(cs3) B5:D5(cs3) B6:D6(cs3)
 *   B7:D7(cs3) E7:I7(cs5) B8:I8(cs8) B9:I9(cs8)
 *   B10:D11(rs2,cs3) E10:F10(cs2) E11:F12(rs2,cs2) G11:I12(rs2,cs3)
 *   B12:D13(rs2,cs3) E13:F13(cs2) G13:I13(cs3)
 *   B14:D15(rs2,cs3) E14:F14(cs2) G14:I14(cs3) E15:F16(rs2,cs2) G15:I16(rs2,cs3)
 *   B16:D17(rs2,cs3) E17:F17(cs2) G17:I17(cs3)
 *   B18:E19(rs2,cs4) F19:G19(cs2) B20:C20(cs2)
 */
?>
<table style="width:95mm;table-layout:fixed;border-collapse:collapse;">
<colgroup>
  <col style="width:5.41mm"> <!-- A -->
  <col style="width:22.86mm"><!-- B -->
  <col style="width:20.44mm"><!-- C -->
  <col style="width:10.23mm"><!-- D -->
  <col style="width:10.82mm"><!-- E -->
  <col style="width:5.71mm"> <!-- F -->
  <col style="width:5.41mm"> <!-- G -->
  <col style="width:3.60mm"> <!-- H -->
  <col style="width:6.02mm"> <!-- I -->
  <col style="width:4.51mm"> <!-- J -->
</colgroup>

<!-- R1: A1 bdr-TL | B1:C1="REV" cs2 bdr-T bold | D1:F1="NR" cs3 bdr-TB | G1:J1="FM-QCA-18" cs4 bdr-TR bold -->
<tr>
  <td style="height:4.50mm;border-top:0.1mm solid #000;border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="border-top:0.1mm solid #000;padding:0.5mm 1mm;font-weight:bold;">REV : 2/190916</td>
  <td colspan="3" style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;text-align:center;">NR</td>
  <td colspan="4" style="border-top:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;font-weight:bold;">FM-QCA-18</td>
</tr>

<!-- R2: A2 bdr-L | B2:D2="PT.NIHON" cs3 bdr-TLR bold | E2:I6 QR rs5,cs5 bdr-all | J2 bdr-R -->
<tr>
  <td style="height:3.71mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;font-weight:bold;">PT. NIHON SEIKI INDONESIA</td>
  <td colspan="5" rowspan="5" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;"><?= $qrCodeImg($qrRight, $qrSize) ?></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R3: A3 bdr-L | B3:D3="QC OK" cs3 bdr-BLR bold | (E-I covered) | J3 bdr-R -->
<tr>
  <td style="height:4.50mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;font-weight:bold;">QUALITY CONTROL OK</td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R4: A4 bdr-L | B4:D4="PT.CUSTOMER" cs3 bdr-TLR bold | (E-I covered) | J4 bdr-R -->
<tr>
  <td style="height:3.71mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;font-weight:bold;">PT. <?= esc($customer) ?></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R5: A5 bdr-L | B5:D5="DATE" cs3 bdr-BLR | (E-I covered) | J5 bdr-R -->
<tr>
  <td style="height:3.44mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;">DATE : <?= $displayDate ?></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R6: A6 bdr-L | B6:D6="PART NAME:" cs3 bdr-TLR bold | (E-I covered last, bdr-B) | J6 bdr-R -->
<tr>
  <td style="height:3.71mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;font-weight:bold;">PART NAME :</td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R7: A7 bdr-L | B7:D7=description cs3 bdr-BLR | E7:I7="BACK NO" cs5 bdr-all center | J7 bdr-R -->
<tr>
  <td style="height:3.97mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;"><?= esc($description) ?></td>
  <td colspan="5" style="border:0.1mm solid #000;text-align:center;">BACK NO <?= esc($backNo) ?></td>
  <td style="border-right:0.1mm solid #000;"></td>
</tr>

<!-- R8: A8 bdr-L | B8:I8="PART NO:..." cs8 bdr-TLR | J8 bdr-LR -->
<tr>
  <td style="height:4.23mm;border-left:0.1mm solid #000;"></td>
  <td colspan="8" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;">PART NO : <?= esc($itemCode) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R9: A9 bdr-L | B9:I9=barcode area cs8 bdr-LR center | J9 bdr-LR -->
<tr>
  <td style="height:4.23mm;border-left:0.1mm solid #000;"></td>
  <td colspan="8" style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;"><?= $barcodeSvg($itemCode, 3) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R10: A10 bdr-L | B10:D11="LOTNO" rs2,cs3 bdr-TLR | E10:F10="Treat/Plat" cs2 bdr-TBR | G10-I10="Inspection" cs3 bdr-all | J10 bdr-LR -->
<tr>
  <td style="height:3.44mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;vertical-align:top;">LOTNO : <?= esc($lotno) ?></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:0.5mm;font-size:8pt;">Treat/Plat</td>
  <td colspan="3" style="border:0.1mm solid #000;text-align:center;font-size:8pt;">Inspection</td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R11: A11 bdr-L | (B-D covered) | E11:F12 rs2,cs2 bdr-all empty | G11:I12="operator" rs2,cs3 bdr-all bold center | J11 bdr-LR -->
<tr>
  <td style="height:0.53mm;border-left:0.1mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.1mm solid #000;text-align:center;vertical-align:middle;font-weight:bold;"><?= esc($operator) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R12: A12 bdr-L | B12:D13 rs2,cs3 bdr-BLR center (barcode area) | (E-F covered) | (G-I covered) | J12 bdr-LR -->
<tr>
  <td style="height:1.85mm;border-left:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;vertical-align:middle;"><?= $barcodeSvg($lotno, 3) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R13: A13 bdr-L | (B-D covered) | E13:F13="Marking" cs2 bdr-all | G13:I13="ROHS FREE" cs3 bdr-all center | J13 bdr-LR -->
<tr>
  <td style="height:2.91mm;border-left:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;padding:0.5mm;font-size:8pt;">Marking</td>
  <td colspan="3" style="border:0.1mm solid #000;text-align:center;font-size:8pt;">ROHS FREE</td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R14: A14 bdr-LR | B14:D15="QTY" rs2,cs3 bdr-TLR | E14:F14 cs2 bdr-all empty | G14:I14="YES" cs3 bdr-all | J14 bdr-LR -->
<tr>
  <td style="height:2.38mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;padding:0.5mm 1mm;vertical-align:top;">QTY : <?= esc($lotQty) ?></td>
  <td colspan="2" style="border:0.1mm solid #000;"></td>
  <td colspan="3" style="border:0.1mm solid #000;font-size:8pt;"><?= $rohsFree ? 'YES' : 'NO' ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R15: A15 bdr-LR | (B-D covered) | E15:F16 rs2,cs2 bdr-all empty | G15:I16="WHFGL" rs2,cs3 bdr-all | J15 bdr-LR -->
<tr>
  <td style="height:1.32mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" rowspan="2" style="border:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border:0.1mm solid #000;font-size:8pt;"><?= esc($warehouse) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R16: A16 bdr-LR | B16:D17 rs2,cs3 bdr-BLR center (barcode area) | (E-F covered) | (G-I covered) | J16 bdr-LR -->
<tr>
  <td style="height:1.85mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="3" rowspan="2" style="border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000;text-align:center;vertical-align:middle;"><?= $barcodeSvg($lotQty, 3) ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R17: A17 bdr-LR | (B-D covered) | E17:F17="PRINT DATE" cs2 bdr-all center | G17:I17=date cs3 bdr-all center | J17 bdr-LR -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;text-align:center;font-size:8pt;">PRINT DATE</td>
  <td colspan="3" style="border:0.1mm solid #000;text-align:center;font-size:8pt;"><?= $printDateLong ?></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R18: A18 bdr-LR | B18:E19 rs2,cs4 bdr-TL center (barcode area) | F18-I18 empty | J18 bdr-LR -->
<tr>
  <td style="height:2.65mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="4" rowspan="2" style="border-top:0.1mm solid #000;border-left:0.1mm solid #000;text-align:center;vertical-align:middle;"><?= $barcodeSvg($refNo, 3) ?></td>
  <td></td><td></td><td></td><td></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R19: A19 bdr-LR | (B-E covered) | F19:G19="User" cs2 bdr-all center | H19 | I19 | J19 bdr-LR -->
<tr>
  <td style="height:3.44mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" style="border:0.1mm solid #000;text-align:center;">User</td>
  <td></td><td></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R20: A20 bdr-LR | B20:C20=refNo cs2 center | D-I empty | J20 bdr-LR -->
<tr>
  <td style="height:3.18mm;border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
  <td colspan="2" style="text-align:center;"><?= esc($refNo) ?></td>
  <td></td><td></td><td></td><td></td><td></td><td></td>
  <td style="border-left:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

<!-- R21: A21 bdr-BL | B21-I21 bdr-TB | J21 bdr-BR -->
<tr>
  <td style="height:3.44mm;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-top:0.1mm solid #000;border-bottom:0.1mm solid #000;"></td>
  <td style="border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;"></td>
</tr>

</table>
