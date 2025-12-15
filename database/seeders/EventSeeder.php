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
        
        // 1. Event Basis Data
        Event::create([
            'name' => 'Competence of Database System',
            'slug' => 'competence-of-database-system',
            'description' => '
                <p>Kompetisi <strong>Basis Data</strong> ini dirancang untuk menguji kemampuan mahasiswa dalam merancang, mengelola, dan mengoptimalkan sistem basis data. Peserta akan ditantang dengan studi kasus nyata yang membutuhkan pemahaman mendalam tentang ERD, Normalisasi, SQL Query, hingga Database Administration.</p>
                
                <h3>Kategori Peserta</h3>
                <ul>
                    <li>Mahasiswa Aktif ITATS Angkatan 2024</li>
                    <li>Wajib telah menempuh atau sedang menempuh mata kuliah Basis Data</li>
                </ul>

                <h3>Materi yang Diujikan</h3>
                <ul>
                    <li>Konsep Dasar Database & RDBMS</li>
                    <li>Entity Relationship Diagram (ERD) & Conceptual Data Model (CDM)</li>
                    <li>Physical Data Model (PDM) & Normalisasi Data</li>
                    <li>DDL, DML, DCL (SQL Query Advance)</li>
                    <li>Trigger, Stored Procedure, & Function</li>
                </ul>

                <h3>Fasilitas Peserta</h3>
                <ul>
                    <li>Sertifikat Tingkat Nasional</li>
                    <li>Snack & Lunch (saat Final Offline)</li>
                    <li>Merchandise Eksklusif ICC 2026</li>
                </ul>
            ',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);

        // 2. Event Pemrograman Terstruktur (Logic Competition)
        Event::create([
            'name' => 'Logic & Algorithm Competition',
            'slug' => 'logic-algorithm-competition',
            'description' => '
                <p><strong>Logic & Algorithm Competition</strong> adalah ajang pembuktian logika pemrograman bagi mahasiswa tahun pertama. Kompetisi ini berfokus pada penyelesaian masalah (problem solving) menggunakan algoritma yang efisien dan struktur data yang tepat.</p>

                <h3>Kategori Peserta</h3>
                <ul>
                    <li>Mahasiswa Aktif ITATS Angkatan 2025</li>
                    <li>Wajib telah menempuh atau sedang menempuh mata kuliah Pemrograman Terstruktur / Algoritma Pemrograman</li>
                </ul>

                <h3>Bahasa Pemrograman</h3>
                <p>Peserta diperbolehkan menggunakan salah satu bahasa berikut:</p>
                <ul>
                    <li>C++ (Recommended)</li>
                    <li>Java</li>
                    <li>Python 3</li>
                </ul>

                <h3>Materi yang Diujikan</h3>
                <ul>
                    <li>Input/Output, Conditional, Looping</li>
                    <li>Array (1D, 2D) & String Manipulation</li>
                    <li>Function & Recursion</li>
                    <li>Sorting & Searching Algorithms</li>
                    <li>Basic Data Structures (Stack, Queue)</li>
                </ul>

                <h3>Hadiah Pemenang</h3>
                <ul>
                    <li>Juara 1: Rp 1.500.000 + Medali Emas</li>
                    <li>Juara 2: Rp 1.000.000 + Medali Perak</li>
                    <li>Juara 3: Rp 750.000 + Medali Perunggu</li>
                </ul>
            ',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);
        
        // 3. Tambahan Event untuk Test List UI
        Event::create([
            'name' => 'Workshop UI/UX Design',
            'slug' => 'workshop-ui-ux-design',
            'description' => '
                <p>Ingin belajar membuat desain aplikasi yang user-friendly dan menarik? Ikuti Workshop UI/UX Design bersama expert dari industri. Kita akan belajar tools Figma dari nol hingga menjadi prototype aplikasi siap coding.</p>
                
                <h3>Apa yang Kamu Dapatkan?</h3>
                <ul>
                    <li>Pemahaman Fundamental UI/UX</li>
                    <li>Praktek Langsung menggunakan Figma</li>
                    <li>Tips & Trik Design System</li>
                    <li>E-Certificate</li>
                </ul>
            ',
            'registration_start' => $now->copy()->subDays(5),
            'registration_end' => $now->copy()->addDays(15),
            'event_start' => $now->copy()->addDays(18),
            'event_end' => $now->copy()->addDays(18),
            'max_members' => 1, // Workshop perorangan
            'is_active' => true,
        ]);
    }
}
