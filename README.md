# Sistem Informasi Pemeringkatan Siswa Teladan

Repository ini berisi sistem informasi untuk menghitung pemeringkatan siswa teladan berdasarkan input nilai teladan, nilai sikap, dan nilai perilaku menggunakan metode Fuzzy Tsukamoto. Sistem ini dibangun menggunakan PHP dan HTML murni serta MySQL untuk penyimpanan data.

## Daftar Isi

- [Pendahuluan](#pendahuluan)
- [Metodologi](#metodologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Kontak](#kontak)

## Pendahuluan

Proses pemeringkatan siswa teladan sering kali melibatkan penilaian subjektif yang bisa dipengaruhi oleh berbagai faktor. Dengan menggunakan metode Fuzzy Tsukamoto, sistem ini menawarkan pendekatan yang lebih transparan dan dapat diandalkan untuk menentukan siswa teladan berdasarkan kriteria yang jelas dan terukur.

## Metodologi

Sistem ini menggunakan metode Fuzzy Tsukamoto yang melibatkan langkah-langkah berikut:

1. **Fuzzifikasi**: Mengubah nilai input (nilai teladan, nilai sikap, dan nilai perilaku) menjadi derajat keanggotaan fuzzy.
2. **Inference**: Menerapkan aturan-aturan fuzzy untuk menghasilkan output dari input yang telah difuzzifikasi.
3. **Defuzzifikasi**: Mengubah hasil fuzzy menjadi nilai pasti yang dapat digunakan untuk pemeringkatan.

## Persyaratan Sistem

Untuk menjalankan proyek ini, Anda memerlukan:

- XAMPP, WAMP, atau Laragon (untuk menjalankan server lokal dan MySQL)
- Browser web (untuk mengakses antarmuka pengguna)
- PHP dan MySQL (bagian dari XAMPP, WAMP, atau Laragon)

## Instalasi

1. **Buat Database MySQL**: Buat database bernama `si` menggunakan PHPMyAdmin yang tersedia di XAMPP, WAMP, atau Laragon.

2. **Import File SQL**: Import file `si.sql` yang tersedia di repository ini ke dalam database `si` yang telah Anda buat. Ini dapat dilakukan melalui PHPMyAdmin dengan memilih database `si` dan menggunakan fitur `Import`.

3. **Pindahkan File Proyek**: Pindahkan seluruh file proyek ini ke direktori `htdocs` (untuk XAMPP) atau direktori `www` (untuk WAMP/Laragon).

4. **Jalankan Proyek**: Buka browser Anda dan navigasikan ke URL berikut:

    ```
    http://localhost/sistem_informasi/
    ```

## Penggunaan

1. **Hitung Manual**: Pilih opsi "Hitung Manual" untuk melakukan perhitungan pemeringkatan siswa secara manual.

2. **Tambah Siswa**: Gunakan fitur "Tambah Siswa" untuk melakukan operasi CRUD sederhana seperti menambah, mengedit, atau menghapus data siswa.

## Kontribusi

Kontribusi sangat dihargai! Jika Anda ingin berkontribusi pada proyek ini, silakan fork repository ini dan buat pull request dengan perubahan atau penambahan fitur yang Anda usulkan.

## Kontak

Jika Anda memiliki pertanyaan, saran, atau membutuhkan bantuan lebih lanjut, Anda dapat menghubungi saya melalui:

- **Email**: [khyar075@gmail.com](mailto:khyar075@gmail.com)
- **GitHub**: [github.com/rrayhka](https://github.com/rrayhka)
