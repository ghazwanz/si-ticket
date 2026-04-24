# Platform Ticketing & Pre-Order Merchandise Malang (JoinFest)

## Deskripsi Proyek
Proyek ini dikembangkan sebagai bagian dari tugas *Project Based Learning* (PBL) di Jurusan Teknologi Informasi, Politeknik Negeri Malang. **JoinFest** adalah sebuah perangkat lunak yang dirancang untuk mengintegrasikan proses pembelian tiket acara dan sistem *pre-order* merchandise di wilayah Malang. Fokus utamanya adalah memungkinkan pengguna untuk melakukan transaksi tiket dan merchandise secara bersamaan dalam satu keranjang (*single cart transaction*), memberikan pengalaman yang lebih praktis dan efisien.

## Scope MVP (Minimum Viable Product)
Berdasarkan rancangan sistem (Use Case) dan desain antarmuka, cakupan fitur utama JoinFest meliputi:

1. **Manajemen Autentikasi & Profil:**
   - Fitur Registrasi dan Login untuk akses pengguna (Customer).
   - Pengelolaan informasi profil pengguna untuk menyimpan data transaksi.

2. **E-Ticketing & Event Discovery:**
   - Menampilkan daftar event berdasarkan kategori (Music, Sports, dll).
   - Proses pemilihan tiket event dan pembelian secara digital.
   - Fitur pencarian event untuk memudahkan pengguna menemukan acara tertentu.

3. **Sistem Pre-Order Merchandise:**
   - Integrasi katalog merchandise di dalam platform.
   - Pemesanan produk merchandise sebagai bagian dari ekosistem event.

4. **Multi-Role Dashboard:**
   - **End User:** Akses ke halaman tiket saya, riwayat pesanan, dan pengaturan akun.
   - **Event Organizer:** Manajemen postingan event dan pemantauan aktivitas penjualan.
   - **Admin:** Kendali penuh terhadap manajemen user dan validasi data sistem.

5. **Antarmuka Mobile-Optimized:**
   - Navigasi utama menggunakan *Bottom Navigation Bar* (Home, My Ticket, Profile).
   - Layout kartu event (*event card*) yang informatif dengan detail lokasi dan harga yang jelas.

## Informasi Tim Pengembang
**Kelompok:** 5
**Kelas:** TI-2F

### Anggota Tim:
| No | Nama Lengkap | NIM | 
|:---:|:---|:---:|
| 1 | Ghazwan Ababil | 244107020151 |
| 2 | Mufliha Hafsyah Shahieza | 244107020147 | 
| 3 | Muhammad Fitra Adhim Nurrochman | 244107020089 | 
| 4 | Rani Miftahus Sa'adah | 244107020057 | 
| 5 | Rifo Anggi Barbara Danuarta | 244107020063 | 

---
## Kontribusi Anggota & Progress Pengerjaan

| No | Nama Lengkap | NIM | Kontribusi & Progres Pengerjaan |
|----|--------------|-----|---------------------------------|
| 1 | Ghazwan Ababil | 244107020151 | - **23 Apr 2026 - Melakukan Refactoring Controller & Optimasi**: merefaktor `PesananController` (menggunakan model Order, menghapus data dummy), mengoptimasi `ProfileController` untuk akses tiket QR, dan menghapus *src.zip*. <br> - **20 Apr 2026 - Menambahkan Model & Fitur**: menambahkan model `TicketCategory`, `DemoDataSeeder`, relasi database, fitur form registrasi berbasis *user role*, serta view untuk profil *Admin* dan *Event Organizer*. <br> - **6 Apr 2026 - Melakukan Refactoring Antarmuka**: merefaktor komponen antarmuka ke kustom tema Tailwind dan menetapkan nama aplikasi JoinFest. <br> - **5 Apr 2026 - Mengimplementasikan Autentikasi & Dashboard**: membangun root scaffolding autentikasi pengguna dan UI Dashboard. <br> - **18 Mar 2026 - Merancang Skema Database**: merancang dan membuat skema *database* untuk *event management*, tiket, *merchandise*, pesanan, dan profil pengguna. <br> - **3-6 Mar 2026 - Melakukan Inisialisasi Proyek**: melaksanakan inisialisasi awal proyek dan pembaruan struktur folder. |
| 2 | Mufliha Hafsyah Shahieza | 244107020147 | - **12 Apr 2026 - Mengerjakan tampilan Halaman Checkout**: menambahkan formulir data pemesan (nama lengkap, email, nomor telepon), ringkasan item pesanan mencakup tiket utama dan merchandise beserta varian dan harga, rincian biaya (subtotal, biaya layanan, pajak 10%, dan total bayar), serta tombol pembayaran dengan indikator keamanan transaksi. <br> - **12 Apr 2026 - Mengerjakan tampilan Halaman Riwayat Pesanan**: menambahkan tab filter untuk menyaring pesanan berdasarkan status (Semua, Pending, Paid, Cancelled, Failed), serta tampilan empty state ketika belum ada pesanan yang ditemukan. <br> - **20 Apr 2026 - Mengerjakan tampilan Dashboard Admin**: menambahkan banner notifikasi prioritas untuk event yang menunggu persetujuan dan EO baru yang perlu diverifikasi, empat kartu statistik platform (total pengguna, event review, event aktif, EO pending), tabel recent activity log, serta widget jumlah tiket terjual dalam 24 jam dan grafik distribusi event per kategori. <br> - **20 Apr 2026 - Mengerjakan tampilan Halaman User Management**: menambahkan tab untuk memilah pengguna berdasarkan peran (Pembeli/End User, Event Organizer, Admin & Tim Internal), serta tabel daftar pengguna yang menampilkan nama, email, nomor HP, tanggal registrasi, dan badge status akun (Active/Suspended). <br> - **20 Apr 2026 - Mengerjakan tampilan Halaman Event Oversight**: menambahkan banner review prioritas berisi jumlah event menunggu persetujuan hari ini, tabel daftar event dengan filter status publikasi (Semua, Menunggu Review, Aktif, Ditolak, Selesai), panel preview konten event yang dipilih, serta automated review checklist berbasis AI untuk memverifikasi kelayakan event dilengkapi tombol Tolak dan Publikasikan Event. <br> - **20 Apr 2026 - Mengerjakan tampilan Halaman Profil Admin**: menambahkan form pengelolaan data akun administrator (nama, nomor HP, email) dengan badge role aktif, form pembaruan kata sandi. |
| 3 | Muhammad Fitra Adhim Nurrochman | 244107020089 | - **14 Apr 2026 - Mengerjakan integrasi Front-End & Halaman Utama**: mengintegrasikan *framework* CSS Tailwind dan menambahkan animasi JavaScript pada tampilan *front-end*, serta mengerjakan halaman *Landing Page*, *Login*, *Register*, *Katalog Event*, dan *Detail Event*. <br> - **8 Apr 2026 - Mengerjakan UI Halaman Autentikasi**: merancang rancangan dasar UI (antarmuka) halaman *Login* dan *Register*, serta melakukan pengujian sinkronisasi *repository*. |
| 4 | Rani Miftahus Sa'adah | 244107020057 | - **24 Apr 2026 - Mengerjakan Fitur Organizer Console (Copilot Assist)**: mengimplementasikan halaman antarmuka JoinFest Organizer Console. <br> - **Mengerjakan Desain UI/UX**: merancang UI/UX menggunakan Figma untuk seluruh halaman platform, mencakup pandangan untuk aktor *User*, *Event Organizer*, dan *Admin*. <br> - **Mengerjakan Penyusunan Laporan**: berkontribusi dalam penyusunan dan pembuatan dokumentasi/laporan proyek. |
| 5 | Rifo Anggi Barbara Danuarta | 244107020063 | - **14 Apr 2026 - Mengembangkan fitur scanner & manajemen profil**: mengembangkan fitur fungsionalitas pemindai kamera (*camera scanner*) untuk keperluan *check-in* tiket dan *QR code merchandise* yang dilengkapi dengan *feedback* visual. Melakukan peningkatan antarmuka tata letak form *header* & *content section*. Mengembangkan tampilan detail pesanan, *QR Code* tiket aplikasi, serta manajemen profil akun (tampilan *view* beserta rute kontroler aplikasi). |

---
*Proyek ini terintegrasi dengan mata kuliah Pemrograman Web Lanjut, Analisis dan Desain Berorientasi Objek, dan Bahasa Indonesia.*