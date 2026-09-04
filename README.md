# Form Print QR Code Label — CodeIgniter 4

Project ini adalah web-based dari rancangan "Form Print QR Code Label" (rancangan_qrcode_qc.docx).
Bagian **model hasil print PDF & preview belum dibuat** (sesuai permintaan) — tombol Preview/Print
sudah ada di UI tapi endpoint-nya masih stub, tinggal diisi nanti.

## 1. Yang sudah dibuat

- Form input (menyesuaikan layout di Word): Doc Number + search ke DB pusat, Customer, Product Name
  (IJP/BS), Production Date **atau** Job Order, Shift, Line **atau** Mold+Cavity, From Series (4 digit,
  auto uppercase), Remark, User Initial Name (3 digit, auto uppercase), Additional (Lot Guarantee /
  Lot SA / 4M — bisa pilih lebih dari satu), grid data (Item Code, Description, Quantity, Lotno,
  Warehouse, Back No, Standard Pack, Operator), Size Mode.
- Tarik data dari **database server pusat** berdasarkan Doc Number — **read-only**, pakai koneksi
  database kedua (`central`) yang terpisah dari database aplikasi (`default`), jadi tidak akan pernah
  melakukan INSERT/UPDATE/DELETE ke server pusat.
- Halaman **Master Data** dengan 4 tab (Shift, Line, Mold, Cavity) — CRUD sederhana lewat AJAX,
  meniru popup "Master" di aplikasi desktop kamu.
- Seeder untuk Master Line berisi 228 pasangan ID → Line Name yang saya ambil langsung dari tabel di
  file Word kamu (CG→S001, EQ→A01, dst) supaya tidak perlu input ulang manual.

## 2. Yang BELUM dibuat (menunggu instruksi lanjutan)

- Layout/template PDF label & halaman Preview (tombol sudah ada, endpoint masih stub / TODO).
- Struktur tabel di **database server pusat** masih ASUMSI (lihat `app/Models/CentralDataModel.php`)
  karena saya belum tahu nama tabel & kolom aslinya. Wajib disesuaikan sebelum fitur search jalan.
- Validasi bisnis detail (misalnya apakah Doc Number wajib unik, format From Series harus kombinasi
  huruf+angka tertentu, dll) — sekarang baru validasi dasar (wajib isi, panjang karakter).

## 3. Instalasi dari nol

```bash
# 1. Buat project CI4 baru (butuh koneksi internet & composer)
composer create-project codeigniter4/appstarter qrcode_label
cd qrcode_label

# 2. Copy semua isi folder app/ dan public/ dari paket ini ke project,
#    timpa (overwrite) file yang sama namanya
cp -r ../ci4_qrcode_label/app/* app/
cp -r ../ci4_qrcode_label/public/* public/

# 3. Copy contoh .env
cp .env.example .env
```

Edit `.env`, isi minimal:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

#--------------------------------------------------------------------
# DATABASE APLIKASI (lokal, tempat menyimpan hasil input form)
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = qrcode_label
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

#--------------------------------------------------------------------
# DATABASE SERVER PUSAT (read-only, tarik data by Doc Number)
#--------------------------------------------------------------------
database.central.hostname = 10.0.0.X
database.central.database = nama_db_pusat
database.central.username = user_readonly
database.central.password = ********
database.central.DBDriver = MySQLi
database.central.port     = 3306
```

> Saran: buat user MySQL khusus di server pusat dengan hak akses **SELECT only** pada tabel/view
> yang relevan, supaya walaupun ada bug di kode, aplikasi ini secara fisik tidak bisa mengubah data
> di server pusat.

## 4. Buat database lokal & jalankan migration + seeder

```bash
# buat database kosong dulu di MySQL, misal: qrcode_label
php spark migrate
php spark db:seed MasterLineSeeder
php spark db:seed MasterShiftSeeder
```

## 5. Sesuaikan koneksi ke data pusat

Buka `app/Models/CentralDataModel.php`, ganti:
- `$table` → nama tabel/view asli di server pusat
- nama-nama kolom di method `getByDocNumber()` → sesuaikan dengan kolom asli (doc_number,
  customer, item_code, description, quantity, lotno, warehouse, back_no, standard_pack, operator)

## 6. Jalankan

```bash
php spark serve
```

Buka `http://localhost:8080/print-form`

## 7. Struktur file yang ditambahkan

```
app/Config/Database.php                  -> tambahan grup koneksi 'central'
app/Config/Routes.php                    -> routing form & master data
app/Controllers/PrintForm.php            -> halaman form utama + search doc number + save
app/Controllers/Master.php               -> CRUD master data (4 tab)
app/Models/ShiftModel.php
app/Models/LineModel.php
app/Models/MoldModel.php
app/Models/CavityModel.php
app/Models/PrintLabelModel.php           -> header transaksi print
app/Models/PrintLabelItemModel.php       -> detail grid per baris
app/Models/CentralDataModel.php          -> query READ ONLY ke server pusat
app/Database/Migrations/*                -> struktur tabel lokal
app/Database/Seeds/MasterLineSeeder.php  -> 228 data Line dari file Word
app/Database/Seeds/MasterShiftSeeder.php
app/Views/print_form/index.php           -> tampilan form
app/Views/master/index.php               -> tampilan master data (tab)
app/Views/templates/header.php, footer.php
public/assets/js/print_form.js           -> logic toggle & AJAX form
public/assets/js/master.js               -> logic CRUD master data
public/assets/css/app.css
```
