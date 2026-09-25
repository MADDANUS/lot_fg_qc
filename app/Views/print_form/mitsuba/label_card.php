<?php
/**
 * Mitsuba Kanban Card
 * Ukuran: 9.5 cm x 5.5 cm
 */
?>
<table style="width:93mm; height:56mm; border-collapse:collapse; border: 1px solid #000; font-size:12pt; margin: 0; table-layout:fixed;">
    <colgroup>
        <col style="width:7mm">
        <col style="width:25mm">
        <col style="width:22mm">
        <col style="width:3mm">
        <col style="width:29mm">
        <col style="width:7mm">
    </colgroup>
    <tr>
        <td colspan="6" style="height:18mm; vertical-align:top; text-align:center; font-weight:bold; font-size:16pt; padding-top:5mm; padding-bottom:0; margin:0;">
            LOT CARD
        </td>
    </tr>
    <tr>
        <td rowspan="3" style="padding:0; margin:0; width:7mm;"><div style="width:7mm;"></div></td>
        <td rowspan="3" style="vertical-align:top; padding:0; margin:0; width:25mm;">
            <?= $qrCodeImg($qrData, 150, '25mm', 0) ?>
        </td>
        <td style="height:9.6mm; padding:0; padding-top:2mm; padding-left:5mm; padding-bottom:3mm; vertical-align:top;">Supplier</td>
        <td style="height:9.6mm; padding:0; padding-top:2mm; padding-bottom:3mm; text-align:center; vertical-align:top;">&nbsp;:&nbsp;</td>
        <td style="height:9.6mm; padding:0; padding-top:2mm; padding-bottom:3mm; vertical-align:top;">1001000</td>
        <td rowspan="3" style="padding:0; margin:0; width:7mm;"><div style="width:7mm;"></div></td>
    </tr>
    <tr>
        <td style="height:9.6mm; padding:0; padding-left:5mm; padding-bottom:3mm; vertical-align:top;">Part No</td>
        <td style="height:9.6mm; padding:0; padding-bottom:3mm; text-align:center; vertical-align:top;">&nbsp;:&nbsp;</td>
        <td style="height:9.6mm; padding:0; padding-bottom:3mm; vertical-align:top;"><?= esc($itemCode) ?></td>
    </tr>
    <tr>
        <td style="height:9.6mm; padding:0; padding-left:5mm; vertical-align:top;">Lot No</td>
        <td style="height:9.6mm; padding:0; text-align:center; vertical-align:top;">&nbsp;:&nbsp;</td>
        <td style="height:9.6mm; padding:0; vertical-align:top;"><?= esc($lotno) ?></td>
    </tr>
    <tr>
        <td colspan="6" style="height:9mm; padding:0; margin:0;"></td>
    </tr>
</table>
