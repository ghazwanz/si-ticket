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
| 1 | Ghazwan Ababil | 244107020151 | — |
| 2 | Mufliha Hafsyah Shahieza | 244107020147 | * **Mengerjakan tampilan Halaman Checkout**: menambahkan formulir data pemesan (nama lengkap, email, nomor telepon), ringkasan item pesanan mencakup tiket utama dan merchandise beserta varian dan harga, rincian biaya (subtotal, biaya layanan, pajak 10%, dan total bayar), serta tombol pembayaran dengan indikator keamanan transaksi. <br> - **Mengerjakan tampilan Halaman Riwayat Pesanan**: menambahkan tab filter untuk menyaring pesanan berdasarkan status (Semua, Pending, Paid, Cancelled, Failed), serta tampilan empty state ketika belum ada pesanan yang ditemukan. <br> - **Mengerjakan tampilan Dashboard Admin**: menambahkan banner notifikasi prioritas untuk event yang menunggu persetujuan dan EO baru yang perlu diverifikasi, empat kartu statistik platform (total pengguna, event review, event aktif, EO pending), tabel recent activity log, serta widget jumlah tiket terjual dalam 24 jam dan grafik distribusi event per kategori. <br> - **Mengerjakan tampilan Halaman User Management**: menambahkan tab untuk memilah pengguna berdasarkan peran (Pembeli/End User, Event Organizer, Admin & Tim Internal), serta tabel daftar pengguna yang menampilkan nama, email, nomor HP, tanggal registrasi, dan badge status akun (Active/Suspended). <br> - **Mengerjakan tampilan Halaman Event Oversight**: menambahkan banner review prioritas berisi jumlah event menunggu persetujuan hari ini, tabel daftar event dengan filter status publikasi (Semua, Menunggu Review, Aktif, Ditolak, Selesai), panel preview konten event yang dipilih, serta automated review checklist berbasis AI untuk memverifikasi kelayakan event dilengkapi tombol Tolak dan Publikasikan Event. <br> - **Mengerjakan tampilan Halaman Profil Admin**: menambahkan form pengelolaan data akun administrator (nama, nomor HP, email) dengan badge role aktif, form pembaruan kata sandi. |
| 3 | Muhammad Fitra Adhim Nurrochman | 244107020089 | — |
| 4 | Rani Miftahus Sa'adah | 244107020057 | — |
| 5 | Rifo Anggi Barbara Danuarta | 244107020063 | — |

---
*Proyek ini terintegrasi dengan mata kuliah Pemrograman Web Lanjut, Analisis dan Desain Berorientasi Objek, dan Bahasa Indonesia.*