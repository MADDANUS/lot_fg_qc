<?php

namespace App\Helpers;

/**
 * Helper fungsi-fungsi untuk generate label QR Code.
 *
 * Cara pakai di Controller:
 *   helper('App\Helpers\label_helper');   // atau load via autoload
 *
 * Karena CI4 helper biasanya berupa fungsi global di app/Helpers/,
 * file ini menggunakan namespace class agar lebih mudah di-import.
 * Di controller cukup: use App\Helpers\LabelHelper;
 */
class LabelHelper
{
    /**
     * Generate Ref No: 16 karakter random UPPERCASE alphanumeric (A-Z, 0-9).
     * Unik per lot — dipanggil sekali per baris lot.
     */
    public static function generateRefNo(): string
    {
        $chars  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $result = '';
        $max    = strlen($chars) - 1;
        for ($i = 0; $i < 16; $i++) {
            $result .= $chars[random_int(0, $max)];
        }
        return $result;
    }

    /**
     * Generate Lot No kombinasi untuk label kiri.
     *
     * Format: 015 + YYMD_atau_YYMDD + ShiftID + LineID_atau_MoldCavityID + FromSeries
     *
     * Contoh (Line mode, date=2026-09-01, shift=1, line=CG, from_series=12E):
     *   015 + 2691 + 1 + CG + 12E  → "01526911CG12E"
     *
     * Aturan tanggal:
     *   - YY  = 2 digit tahun (26)
     *   - M   = bulan tanpa leading zero jika < 10 (9 = Sep, 10 = Okt)
     *   - DD  = 2 digit tanggal
     *
     * @param string      $dateStr      Tanggal produksi atau dari job order (Y-m-d atau teks)
     * @param string      $dateMode     'production_date' atau 'job_order'
     * @param int|string  $shiftId      ID shift dari master
     * @param string      $lineMode     'line' atau 'mold_cavity'
     * @param string|null $lineId       ID line (misal 'CG')
     * @param int|null    $moldId       ID mold
     * @param int|null    $cavityId     ID cavity
     * @param string      $fromSeries   From Series (4 char, uppercase)
     */
    public static function generateLotNo(
        string      $dateStr,
        string      $dateMode,
        $shiftId,
        string      $lineMode,
        ?string     $lineId,
        $moldId,
        $cavityId,
        string      $fromSeries
    ): string {
        // -- Bagian tanggal --
        $datePart = '';
        if ($dateMode === 'production_date' && $dateStr) {
            $ts       = strtotime($dateStr);
            $year     = date('y', $ts);   // 2 digit tahun
            $month    = (int) date('n', $ts); // bulan tanpa leading zero
            $day      = date('d', $ts);   // 2 digit hari
            $datePart = $year . $month . $day;
        }
        // Jika job_order dipilih, datePart dikosongkan (tidak ada tanggal produksi)
        // — sesuaikan jika ada kebutuhan lain

        // -- Bagian shift --
        $shiftPart = (string) $shiftId;

        // -- Bagian line / mold-cavity --
        $linePart = '';
        if ($lineMode === 'line') {
            // Ambil ID line apa adanya (misal 'CG')
            $linePart = strtoupper((string) $lineId);
        } else {
            // Mold + Cavity: gabungkan ID langsung
            $linePart = ((string) $moldId) . ((string) $cavityId);
        }

        // -- Gabungkan semua --
        return '015' . $datePart . $shiftPart . $linePart . strtoupper($fromSeries);
    }

    /**
     * Return konfigurasi grid per size mode.
     *
     * Semua ukuran di kertas A4 portrait (210 × 297 mm).
     * Setiap "cell" berisi 1 pasang label (kiri + kanan).
     *
     * @return array ['cols' => int, 'rows_per_page' => int, 'pairs_per_page' => int,
     *                'cell_w_mm' => float, 'cell_h_mm' => float,
     *                'font_size_pt' => int, 'barcode_h_mm' => float]
     */
    public static function getGridConfig(string $sizeMode): array
    {
        // A4: 210 × 297 mm, margin ~5mm tiap sisi → usable 200 × 287 mm
        // Setiap baris berisi 2 label (kiri + kanan) per kolom,
        // tapi di sini "cols=2" berarti 2 pasang per baris, bukan per halaman.
        // Sebenarnya layout: 1 baris = 1 pasang (kiri+kanan), kolom=1 pair per baris.
        //
        // Dari spesifikasi user:
        //   Medium/Epson : 6 pasang per halaman (2 kolom × 3 baris)
        //   Medium       : sama dengan Medium/Epson
        //   Large        : 4 pasang per halaman (2 kolom × 2 baris)
        //   Small        : 8 pasang per halaman (2 kolom × 4 baris)
        //
        // Karena setiap "pasang" = kiri + kanan berdampingan,
        // sebenarnya layout-nya: tiap baris tabel berisi (pairs_per_row) sel,
        // masing-masing sel = 1 pasang label kiri+kanan.
        // Untuk simplifikasi di mPDF: 1 baris tabel = 1 pasang, lebar sel = ½ lebar usable.

        // pairs_per_row SELALU 1:
        //   Setiap lot menempati 1 baris penuh A4 (lebar 200mm).
        //   Baris dibagi 2 kolom: kiri = Label Kiri, kanan = Label Kanan.
        //   Lot berikutnya melanjut KE BAWAH, bukan ke samping.
        //
        // Ukuran tinggi per lot (cell_h_mm):
        //   Small       : 8 lot/hal  → ~35 mm per lot
        //   Medium/Epson: 4 lot/hal  → ~70 mm per lot
        //   Medium      : sama dgn Medium/Epson
        //   Large       : 2 lot/hal  → ~140 mm per lot
        return match (strtolower(str_replace(['/', ' ', '-'], '', $sizeMode))) {
            'mediumepson', 'medium' => [
                'pairs_per_page' => 3,
                'pairs_per_row'  => 1,
                'cell_h_mm'      => 85,  // 8cm right label + 5mm padding
                'font_size_pt'   => 7,
                'barcode_h_mm'   => 9,
            ],
            'large' => [
                'pairs_per_page' => 2,
                'pairs_per_row'  => 1,
                'cell_h_mm'      => 140, // 287/2 ≈ 143 mm per lot
                'font_size_pt'   => 9,
                'barcode_h_mm'   => 14,
            ],
            'small' => [
                'pairs_per_page' => 8,
                'pairs_per_row'  => 1,
                'cell_h_mm'      => 35,  // 287/8 ≈ 35 mm per lot
                'font_size_pt'   => 6,
                'barcode_h_mm'   => 6,
            ],
            default => [ // fallback ke medium
                'pairs_per_page' => 3,
                'pairs_per_row'  => 1,
                'cell_h_mm'      => 90,
                'font_size_pt'   => 7,
                'barcode_h_mm'   => 9,
            ],
        };
    }
}
