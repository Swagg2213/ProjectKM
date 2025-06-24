<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $eventCreators = User::whereHas('role', function($query) {
            $query->where('name', 'Pembuat Event');
        })->get();

        $events = [
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Seminar Nasional Teknologi Informasi 2025',
                'kategori' => 'Seminar',
                'link' => 'https://bit.ly/seminar-ti-2025',
                'date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'startTime' => '08:00:00',
                'endTime' => '16:00:00',
                'lokasi' => 'Auditorium Universitas Surabaya',
                'detail' => 'Seminar nasional yang membahas perkembangan terbaru dalam bidang teknologi informasi, artificial intelligence, dan digital transformation. Pembicara dari berbagai universitas ternama dan praktisi industri.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Workshop Internet of Things (IoT)',
                'kategori' => 'Seminar',
                'link' => 'https://bit.ly/workshop-iot-ukp',
                'date' => Carbon::now()->addDays(8)->format('Y-m-d'),
                'startTime' => '09:00:00',
                'endTime' => '15:00:00',
                'lokasi' => 'Lab Komputer Fakultas MIPA',
                'detail' => 'Workshop hands-on tentang Internet of Things, mulai dari konsep dasar hingga implementasi praktis. Peserta akan belajar membuat project IoT sederhana.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Rekrutmen Panitia Dies Natalis UKP 2025',
                'kategori' => 'Panitia',
                'link' => 'https://bit.ly/panitia-diesnat-2025',
                'date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'startTime' => '13:00:00',
                'endTime' => '17:00:00',
                'lokasi' => 'Aula Rektorat UKP',
                'detail' => 'Membuka kesempatan bagi mahasiswa untuk bergabung sebagai panitia dalam acara Dies Natalis Universitas Surabaya tahun 2025. Berbagai divisi tersedia.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Pengabdian Masyarakat: Edukasi Digital Literasi',
                'kategori' => 'Pengmas',
                'link' => 'https://bit.ly/pengmas-digital-literasi',
                'date' => Carbon::now()->addDays(12)->format('Y-m-d'),
                'startTime' => '08:30:00',
                'endTime' => '12:00:00',
                'lokasi' => 'Desa Sumberbaru, Surabaya',
                'detail' => 'Program pengabdian masyarakat untuk memberikan edukasi tentang digital literasi kepada masyarakat desa. Mengajarkan penggunaan internet yang aman dan produktif.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Kompetisi Robotika Tingkat Universitas',
                'kategori' => 'Bakmi',
                'link' => 'https://bit.ly/kompetisi-robotika-ukp',
                'date' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'startTime' => '08:00:00',
                'endTime' => '17:00:00',
                'lokasi' => 'Lapangan Teknik UKP',
                'detail' => 'Kompetisi robotika antar fakultas di Universitas Surabaya. Kategori line follower, sumo robot, dan robot soccer. Hadiah menarik untuk para pemenang.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Festival Budaya Nusantara',
                'kategori' => 'Lainnya',
                'link' => 'https://bit.ly/festival-budaya-nusantara',
                'date' => Carbon::now()->addDays(25)->format('Y-m-d'),
                'startTime' => '16:00:00',
                'endTime' => '21:00:00',
                'lokasi' => 'Lapangan Rektorat UKP',
                'detail' => 'Festival yang menampilkan berbagai kebudayaan nusantara, mulai dari tarian tradisional, musik, hingga kuliner khas daerah. Event untuk mempererat persatuan mahasiswa.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Seminar Kewirausahaan Digital',
                'kategori' => 'Seminar',
                'link' => 'https://bit.ly/seminar-wirausaha-digital',
                'date' => Carbon::now()->addDays(18)->format('Y-m-d'),
                'startTime' => '09:00:00',
                'endTime' => '15:00:00',
                'lokasi' => 'Gedung Student Center UKP',
                'detail' => 'Seminar tentang kewirausahaan di era digital, strategi membangun startup, dan tips sukses berbisnis online. Pembicara dari startup unicorn Indonesia.',
                'status' => 'pending',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Rekrutmen Volunteer Earth Hour',
                'kategori' => 'Panitia',
                'link' => 'https://bit.ly/volunteer-earth-hour',
                'date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'startTime' => '14:00:00',
                'endTime' => '16:00:00',
                'lokasi' => 'Ruang Serbaguna Fakultas MIPA',
                'detail' => 'Rekrutmen volunteer untuk campaign Earth Hour di kampus. Kegiatan meliputi sosialisasi hemat energi dan aksi peduli lingkungan.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Program Literasi Anak Jalanan',
                'kategori' => 'Pengmas',
                'link' => 'https://bit.ly/literasi-anak-jalanan',
                'date' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'startTime' => '15:00:00',
                'endTime' => '18:00:00',
                'lokasi' => 'Taman Kota Surabaya',
                'detail' => 'Program pengabdian masyarakat untuk memberikan pendidikan literasi dasar kepada anak-anak jalanan di Kota Surabaya. Mengajar membaca, menulis, dan berhitung.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Turnamen E-Sports Mobile Legends',
                'kategori' => 'Bakmi',
                'link' => 'https://bit.ly/turnamen-ml-ukp',
                'date' => Carbon::now()->addDays(22)->format('Y-m-d'),
                'startTime' => '09:00:00',
                'endTime' => '18:00:00',
                'lokasi' => 'Aula Fakultas Teknik',
                'detail' => 'Turnamen Mobile Legends tingkat universitas dengan total hadiah 10 juta rupiah. Terbuka untuk semua mahasiswa UKP. Registrasi per tim (5 orang).',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Talk Show Karir IT Professional',
                'kategori' => 'Lainnya',
                'link' => 'https://bit.ly/talkshow-karir-it',
                'date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'startTime' => '13:00:00',
                'endTime' => '16:00:00',
                'lokasi' => 'Auditorium Fakultas MIPA',
                'detail' => 'Talk show dengan alumni yang sukses berkarir di bidang IT. Sharing pengalaman, tips interview, dan prospek karir di industri teknologi.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Workshop Machine Learning untuk Pemula',
                'kategori' => 'Seminar',
                'link' => 'https://bit.ly/workshop-ml-pemula',
                'date' => Carbon::now()->addDays(16)->format('Y-m-d'),
                'startTime' => '08:30:00',
                'endTime' => '16:30:00',
                'lokasi' => 'Lab AI Fakultas MIPA',
                'detail' => 'Workshop intensif machine learning dari basic hingga implementasi. Menggunakan Python dan berbagai library ML populer seperti scikit-learn dan TensorFlow.',
                'status' => 'pending',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Pelatihan Public Speaking',
                'kategori' => 'Lainnya',
                'link' => 'https://bit.ly/pelatihan-public-speaking',
                'date' => Carbon::now()->addDays(9)->format('Y-m-d'),
                'startTime' => '09:00:00',
                'endTime' => '15:00:00',
                'lokasi' => 'Ruang Seminar Fakultas FISIP',
                'detail' => 'Pelatihan public speaking untuk meningkatkan kemampuan komunikasi dan presentasi mahasiswa. Dilengkapi dengan praktek langsung dan feedback.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Bakti Sosial Bersih-Bersih Pantai',
                'kategori' => 'Pengmas',
                'link' => 'https://bit.ly/baksos-bersih-pantai',
                'date' => Carbon::now()->addDays(11)->format('Y-m-d'),
                'startTime' => '06:00:00',
                'endTime' => '12:00:00',
                'lokasi' => 'Pantai Payangan, Surabaya',
                'detail' => 'Kegiatan bakti sosial membersihkan pantai dari sampah plastik dan edukasi masyarakat tentang pentingnya menjaga kebersihan lingkungan laut.',
                'status' => 'approved',
            ],
            [
                'user_id' => $eventCreators->random()->id,
                'title' => 'Kompetisi Fotografi Alam',
                'kategori' => 'Bakmi',
                'link' => 'https://bit.ly/kompetisi-foto-alam',
                'date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'startTime' => '08:00:00',
                'endTime' => '17:00:00',
                'lokasi' => 'Kawasan Bromo Tengger Semeru',
                'detail' => 'Kompetisi fotografi dengan tema keindahan alam Indonesia. Kategori landscape, wildlife, dan macro photography. Hadiah total 15 juta rupiah.',
                'status' => 'rejected',
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}