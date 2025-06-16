<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliah = [
            ['kode' => 'MK001', 'nama' => 'Bahasa Indonesia', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Mata kuliah Bahasa Indonesia membahas keterampilan berbahasa secara akademik.'],
            ['kode' => 'MK002', 'nama' => 'Bahasa Inggris I', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Pengantar Bahasa Inggris dasar untuk komunikasi akademik.'],
            ['kode' => 'MK003', 'nama' => 'Fisika', 'sks' => 3, 'semester' => 1, 'deskripsi' => 'Fisika dasar untuk ilmu komputer dan teknologi.'],
            ['kode' => 'MK004', 'nama' => 'Kalkulus I', 'sks' => 3, 'semester' => 1, 'deskripsi' => 'Dasar-dasar kalkulus diferensial dan integral.'],
            ['kode' => 'MK005', 'nama' => 'Konsep Pemrograman', 'sks' => 4, 'semester' => 1, 'deskripsi' => 'Pengantar logika dan struktur dasar pemrograman.'],
            ['kode' => 'MK006', 'nama' => 'Pendidikan Agama Budha', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Studi ajaran agama Budha dan etika.'],
            ['kode' => 'MK007', 'nama' => 'Pendidikan Agama Islam', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Studi ajaran agama Islam dan etika.'],
            ['kode' => 'MK008', 'nama' => 'Pendidikan Agama Katholik', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Studi ajaran agama Katholik dan etika.'],
            ['kode' => 'MK009', 'nama' => 'Pendidikan Agama Kristen', 'sks' => 2, 'semester' => 1, 'deskripsi' => 'Studi ajaran agama Kristen dan etika.'],
            ['kode' => 'MK010', 'nama' => 'Sistem Digital', 'sks' => 3, 'semester' => 1, 'deskripsi' => 'Konsep dasar sistem digital dan logika gerbang.'],
            ['kode' => 'MK011', 'nama' => 'Statistika & Probabilitas', 'sks' => 3, 'semester' => 1, 'deskripsi' => 'Dasar-dasar statistik dan probabilitas untuk analisis data.'],
            ['kode' => 'MK012', 'nama' => 'Aljabar Linier', 'sks' => 3, 'semester' => 2, 'deskripsi' => 'Konsep dasar aljabar linier dan penerapannya.'],
            ['kode' => 'MK013', 'nama' => 'Bahasa Inggris Ii', 'sks' => 2, 'semester' => 2, 'deskripsi' => 'Lanjutan Bahasa Inggris untuk komunikasi akademik.'],
            ['kode' => 'MK014', 'nama' => 'Kalkulus Ii', 'sks' => 3, 'semester' => 2, 'deskripsi' => 'Lanjutan kalkulus integral dan aplikasi.'],
            ['kode' => 'MK015', 'nama' => 'Metematika Diskrit I', 'sks' => 3, 'semester' => 2, 'deskripsi' => 'Dasar-dasar matematika diskrit.'],
            ['kode' => 'MK016', 'nama' => 'Organisasi Sistem Komputer', 'sks' => 3, 'semester' => 2, 'deskripsi' => 'Struktur dan organisasi sistem komputer.'],
            ['kode' => 'MK017', 'nama' => 'Pendidikan Kewarganegaraan', 'sks' => 2, 'semester' => 2, 'deskripsi' => 'Studi kewarganegaraan dan konstitusi Indonesia.'],
            ['kode' => 'MK018', 'nama' => 'Struktur Data & Algoritma', 'sks' => 4, 'semester' => 2, 'deskripsi' => 'Struktur data dasar dan algoritma.'],
            ['kode' => 'MK019', 'nama' => 'Basis Data', 'sks' => 4, 'semester' => 3, 'deskripsi' => 'Konsep dasar basis data dan SQL.'],
            ['kode' => 'MK020', 'nama' => 'Desain & Analisis Algoritma', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Perancangan dan analisis efisiensi algoritma.'],
            ['kode' => 'MK021', 'nama' => 'Matematika Diskrit Ii', 'sks' => 2, 'semester' => 3, 'deskripsi' => 'Lanjutan matematika diskrit.'],
            ['kode' => 'MK022', 'nama' => 'Metode Numerik', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Metode numerik dalam komputasi.'],
            ['kode' => 'MK023', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Konsep OOP dengan Java atau bahasa serupa.'],
            ['kode' => 'MK024', 'nama' => 'Pendidikan Pancasila', 'sks' => 2, 'semester' => 3, 'deskripsi' => 'Pendidikan nilai-nilai Pancasila.'],
            ['kode' => 'MK025', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Konsep dasar sistem operasi.'],
            ['kode' => 'MK026', 'nama' => 'Jaringan Komputer', 'sks' => 4, 'semester' => 4, 'deskripsi' => 'Dasar jaringan komputer dan protokol komunikasi.'],
            ['kode' => 'MK027', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 4, 'deskripsi' => 'Pengantar AI dan aplikasinya.'],
            ['kode' => 'MK028', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 4, 'deskripsi' => 'Teknologi dasar pengembangan web.'],
            ['kode' => 'MK029', 'nama' => 'Pengembangan Aplikasi Bergerak', 'sks' => 3, 'semester' => 4, 'deskripsi' => 'Membuat aplikasi mobile berbasis Android/iOS.'],
            ['kode' => 'MK030', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 4, 'semester' => 4, 'deskripsi' => 'Prinsip dan proses pengembangan perangkat lunak.'],
            ['kode' => 'MK031', 'nama' => 'Teori Bahasa & Automata', 'sks' => 3, 'semester' => 4, 'deskripsi' => 'Bahasa formal dan automata.'],
            ['kode' => 'MK032', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Teknik penambangan data untuk pengambilan keputusan.'],
            ['kode' => 'MK033', 'nama' => 'Interaksi Manusia & Komputer', 'sks' => 2, 'semester' => 5, 'deskripsi' => 'Desain antarmuka pengguna dan usability.'],
            ['kode' => 'MK034', 'nama' => 'Machine Learning', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Algoritma pembelajaran mesin.'],
            ['kode' => 'MK035', 'nama' => 'Manajemen Sistem Informasi', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Manajemen teknologi informasi di organisasi.'],
            ['kode' => 'MK036', 'nama' => 'Pengolahan Citra Digital', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Teknik pengolahan gambar dan citra digital.'],
            ['kode' => 'MK037', 'nama' => 'Riset Operasi', 'sks' => 2, 'semester' => 5, 'deskripsi' => 'Pemodelan dan optimasi sistem operasi.'],
            ['kode' => 'MK038', 'nama' => 'Sistem Terdistribusi', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Konsep sistem terdistribusi dan implementasinya.'],
            ['kode' => 'MK039', 'nama' => 'Business Intelligence', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Penggunaan data untuk keputusan bisnis.'],
            ['kode' => 'MK040', 'nama' => 'Cyber Security', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Keamanan sistem dan jaringan informasi.'],
            ['kode' => 'MK041', 'nama' => 'Expert System', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Sistem pakar dan pengambilan keputusan otomatis.'],
            ['kode' => 'MK042', 'nama' => 'Jaminan Mutu Perangkat Lunak', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Proses jaminan kualitas perangkat lunak.'],
            ['kode' => 'MK043', 'nama' => 'Kapita Selekta Ilmu Komputer', 'sks' => 2, 'semester' => 6, 'deskripsi' => 'Topik terpilih dalam bidang ilmu komputer.'],
            ['kode' => 'MK044', 'nama' => 'Komputasi Cloud', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Dasar komputasi awan dan teknologi pendukung.'],
            ['kode' => 'MK045', 'nama' => 'Metode Penelitian', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Metodologi riset dalam bidang teknologi.'],
            ['kode' => 'MK046', 'nama' => 'Natural Language Processing', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Pemrosesan bahasa alami dan aplikasinya.'],
            ['kode' => 'MK047', 'nama' => 'Pengamanan Data Multimedia', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Teknik keamanan multimedia dan enkripsi.'],
            ['kode' => 'MK048', 'nama' => 'Proyek Perangkat Lunak', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Proyek pengembangan perangkat lunak kelompok.'],
            ['kode' => 'MK049', 'nama' => 'Teknik Multimedia', 'sks' => 3, 'semester' => 6, 'deskripsi' => 'Teknik dan aplikasi multimedia.'],
            ['kode' => 'MK050', 'nama' => 'Computer Vision', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Pemrosesan dan analisis gambar oleh komputer.'],
            ['kode' => 'MK051', 'nama' => 'E-commerce', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Sistem dan aplikasi perdagangan elektronik.'],
            ['kode' => 'MK052', 'nama' => 'Etika Profesi', 'sks' => 2, 'semester' => 7, 'deskripsi' => 'Etika dalam profesi teknologi informasi.'],
            ['kode' => 'MK053', 'nama' => 'Kecerdasan Komputasional', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Metode komputasional untuk pemecahan masalah kompleks.'],
            ['kode' => 'MK054', 'nama' => 'Kewirausahaan', 'sks' => 2, 'semester' => 7, 'deskripsi' => 'Dasar-dasar kewirausahaan di bidang teknologi.'],
            ['kode' => 'MK055', 'nama' => 'Semantic Web', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Web semantik dan pengelolaan data terstruktur.'],
        ];

        DB::table('mata_kuliah')->insert($mataKuliah);
    }
}
