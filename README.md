# LAPORAN FINAL PROJECT PEMROGRAMAN WEB

## Aneka Logistic Management System

Website : https://anekalogisticmsys.lovestoblog.com/

Link Video Demo : https://www.youtube.com/watch?v=izwU70Gdsxs

---

## 1. Pendahuluan

Aneka Logistic Management System adalah aplikasi web berbasis PHP dan MySQL yang dikembangkan untuk membantu proses manajemen pengiriman barang pada perusahaan ekspedisi Aneka Logistic. Sistem ini menyediakan fitur login multi-role, pengelolaan data pengiriman, tracking resi secara real-time, serta laporan pengiriman dan pendapatan.

Pengembangan sistem ini bertujuan untuk memenuhi kebutuhan Final Project (FP) dan Laporan Praktikum (Laprak) mata kuliah Web Programming dengan menerapkan konsep CRUD, autentikasi, session, database relasional, dan integrasi frontend–backend.

---

## 2. Spesifikasi Umum Sistem

* **Platform**: Web Application
* **Bahasa Pemrograman**: PHP Native
* **Database**: MySQL
* **Frontend**: HTML, CSS, JavaScript, Bootstrap 5
* **Library Tambahan**: AOS (Animate On Scroll)
* **User Role**:

  * Super Admin
  * Admin
  * Customer

---

## 3. Frontend & Backend Development

### 3.1 Frontend Development

Frontend aplikasi dirancang dengan konsep modern dan responsif menggunakan Bootstrap 5. Landing page (`index.php`) berfungsi sebagai halaman utama yang menampilkan informasi layanan, lokasi kantor, serta fitur cek resi publik.

Fitur frontend utama:

* Landing Page dengan hero slider otomatis
* Form tracking resi
* Tampilan lokasi kantor menggunakan Google Maps Embed
* Animasi ringan menggunakan AOS

![Image](https://github.com/user-attachments/assets/9dfe2bc0-fc00-4a5d-bcef-e1d42a005ec7)
![Image](https://github.com/user-attachments/assets/4a8a9674-b281-43ce-a82e-13c5719bd3fd)
![Image](https://github.com/user-attachments/assets/e49d2c23-0bed-41ad-b870-f656c350bf3b)
![Image](https://github.com/user-attachments/assets/6cce33a8-57a9-4f81-a743-d2af7625d343)

### 3.2 Backend Development

Backend dikembangkan menggunakan PHP Native dengan sistem session dan role-based access control. Setiap halaman dashboard dilindungi oleh pengecekan login dan role user.

Fungsi backend utama:

* Autentikasi login & logout
* Manajemen user (Super Admin)
* Input dan pengelolaan pengiriman
* Generate nomor resi otomatis (format MPI)
* Update status pengiriman dan tracking timeline
* Rekap laporan pengiriman

---

## 4. Database Implementation

Database MySQL digunakan untuk menyimpan seluruh data sistem secara terstruktur. Koneksi database diatur melalui file `db.php`.

### 4.1 Tabel Utama

* **users**: menyimpan data user dan role
* **shipments**: menyimpan data pengiriman dan resi
* **rute**: data kota asal dan tujuan
* **tarif**: tarif pengiriman berdasarkan rute
* **shipment_tracking**: riwayat status pengiriman

Relasi database memungkinkan satu pengiriman memiliki banyak status tracking.

---

## 5. Integrasi API & JavaScript

Sistem ini menggunakan JavaScript dan API internal untuk meningkatkan interaktivitas aplikasi.

Integrasi yang digunakan:

* Google Maps Embed API untuk lokasi kantor
* JavaScript Fetch API untuk update status dan timeline tracking
* JavaScript untuk:

  * Hero slider otomatis
  * Counter statistik
  * Perhitungan biaya pengiriman realtime

---

## 6. Pengujian Sistem

Pengujian dilakukan menggunakan metode Black Box Testing.

Contoh skenario pengujian:

* Login dengan role Super Admin dan Admin
* Input data pengiriman dengan rute dan berat berbeda
* Generate nomor resi otomatis
* Update status pengiriman
* Menampilkan timeline tracking
* Menampilkan laporan pengiriman

Hasil pengujian menunjukkan sistem berjalan sesuai dengan kebutuhan fungsional.

---

## 7. Alur Sistem (Deskriptif)

1. User melakukan login sesuai role
2. Admin/Super Admin menginput data pengiriman
3. Sistem menghitung biaya dan generate resi
4. Admin melakukan update status pengiriman
5. Data status tersimpan dan dapat ditracking
6. Super Admin melihat laporan pengiriman

---

## 8. Panduan Pengguna Singkat

### Super Admin

* Login ke sistem
* Mengelola user, rute, tarif
* Melihat laporan pengiriman dan pendapatan

### Admin

* Login ke sistem
* Input data pengiriman
* Update status pengiriman
* Melihat data pengiriman

### Customer

* Mengakses landing page
* Melakukan tracking pengiriman menggunakan nomor resi

---

## 9. Pembagian Jobdesk (Individu)

| No | Aktivitas | Keterangan                  |
| -- | --------- | --------------------------- |
| 1  | Frontend  | Landing page, dashboard, UI |
| 2  | Backend   | PHP, autentikasi, CRUD      |
| 3  | Database  | Desain tabel & relasi       |
| 4  | Testing   | Pengujian fitur sistem      |

| No | Nama      | Keterangan             |
| -- | --------- | ---------------------- |
| 1 | Dyah Utami Kesuma Dewi | Frontend (UI, Landing Page, Animasi) |
| 2 | Shifa Alya Dewi | Backend & Database |
| 3 | Dyah Utami Kesuma Dewi | Tracking & Laporan |
| 4 | Shifa Alya Dewi | Dokumentasi & Testing |

---

## 10. Penutup

Aneka Logistic Management System berhasil dikembangkan sebagai aplikasi web logistik yang mengimplementasikan pembelajaran Web Programming selama semester ini. Sistem ini mampu mengelola pengiriman, tracking resi, serta laporan secara terintegrasi. Diharapkan aplikasi ini dapat memenuhi kriteria kebutuhan jasa logistik. Atas ilmu yang telah diberikan, kami ucapkan terimakasih.

---
