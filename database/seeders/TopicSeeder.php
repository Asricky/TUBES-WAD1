<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            [
                'name' => 'Karier',
                'description' => 'Konsultasi mengenai pengembangan karier, pemilihan jalur karier, persiapan karier, dan masalah terkait pekerjaan.'
            ],
            [
                'name' => 'Kesehatan Mental',
                'description' => 'Konsultasi mengenai masalah kesehatan mental seperti stres, kecemasan, depresi, dan kesejahteraan psikologis.'
            ],
            [
                'name' => 'Akademik',
                'description' => 'Konsultasi mengenai masalah akademik seperti kesulitan belajar, manajemen waktu, strategi belajar, dan perencanaan studi.'
            ],
            [
                'name' => 'Hubungan Sosial',
                'description' => 'Konsultasi mengenai masalah hubungan interpersonal, pertemanan, hubungan dengan keluarga, dan komunikasi.'
            ],
            [
                'name' => 'Pengembangan Diri',
                'description' => 'Konsultasi mengenai pengembangan soft skills, kepemimpinan, manajemen diri, dan peningkatan potensi diri.'
            ],
            [
                'name' => 'Penyesuaian Kampus',
                'description' => 'Konsultasi mengenai adaptasi kehidupan kampus, transisi ke perguruan tinggi, dan masalah terkait lingkungan akademik.'
            ],
            [
                'name' => 'Perencanaan Masa Depan',
                'description' => 'Konsultasi mengenai perencanaan jangka panjang, penetapan tujuan, dan pengambilan keputusan untuk masa depan.'
            ],
        ];

        foreach ($topics as $topic) {
            Topic::create($topic);
        }
    }
}
