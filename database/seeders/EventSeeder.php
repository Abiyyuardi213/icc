<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Kompetisi Basis Data
        Event::create([
            'name' => 'Kompetisi Basis Data',
            'slug' => 'kompetisi-basis-data',
            'description' => '
                <p>Kompetisi <strong>Basis Data</strong> ini dirancang untuk menguji kemampuan dasar mahasiswa dalam merancang dan mengelola sistem basis data menggunakan MySQL. Fokus utama kompetisi adalah pada pemodelan data dan eksekusi query dasar.</p>

                <h3>Kategori Peserta</h3>
                <ul>
                    <li>Mahasiswa Aktif ITATS Angkatan 2024</li>
                    <li>Wajib telah menempuh atau sedang menempuh mata kuliah Basis Data</li>
                </ul>

                <h3>Materi yang Diujikan</h3>
                <ul>
                    <li>Konsep Dasar DBMS (MySQL)</li>
                    <li>Perancangan Entity Relationship Diagram (ERD)</li>
                    <li>Pembuatan Conceptual Data Model (CDM)</li>
                    <li>Pembuatan Physical Data Model (PDM)</li>
                    <li>SQL Query Dasar (DDL & DML)</li>
                </ul>

                <h3>Hadiah Pemenang</h3>
                <ul>
                    <li>Juara 1: Rp 450.000 + Sertifikat</li>
                    <li>Juara 2: Rp 300.000 + Sertifikat</li>
                    <li>Juara 3: Rp 250.000 + Sertifikat</li>
                </ul>
            ',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);

        // 2. Kompetisi Pemrograman Terstruktur
        Event::create([
            'name' => 'Kompetisi Pemrograman Terstruktur',
            'slug' => 'kompetisi-pemrograman-terstruktur',
            'description' => '
                <p><strong>Kompetisi Pemrograman Terstruktur</strong> adalah ajang kompetisi pemrograman tingkat dasar. Peserta akan ditantang menyelesaikan masalah logika menggunakan bahasa pemrograman C++ dengan batasan materi fundamental.</p>

                <h3>Kategori Peserta</h3>
                <ul>
                    <li>Mahasiswa Aktif ITATS Angkatan 2025</li>
                    <li>Wajib telah menempuh atau sedang menempuh mata kuliah Pemrograman Terstruktur</li>
                </ul>

                <h3>Bahasa Pemrograman</h3>
                <p>Peserta wajib menggunakan bahasa: <strong>C++</strong></p>

                <h3>Materi yang Diujikan</h3>
                <ul>
                    <li>Input/Output (I/O) Dasar</li>
                    <li>Tipe Data & Operator</li>
                    <li>Struktur Kondisi (Selection)</li>
                    <li>Struktur Perulangan (Looping)</li>
                    <li>Penggunaan Header</li>
                    <li>Function (Fungsi & Prosedur)</li>
                </ul>

                <h3>Hadiah Pemenang</h3>
                <ul>
                    <li>Juara 1: Rp 450.000 + Sertifikat</li>
                    <li>Juara 2: Rp 300.000 + Sertifikat</li>
                    <li>Juara 3: Rp 250.000 + Sertifikat</li>
                </ul>
            ',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);
    }
}
