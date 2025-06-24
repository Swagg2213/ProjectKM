<?php

namespace Database\Seeders;

use App\Models\EventReview;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventReviewSeeder extends Seeder
{
    public function run(): void
    {
        $adminUsers = User::whereHas('role', function($query) {
            $query->where('name', 'Admin');
        })->get();

        $reviewedEvents = Event::whereIn('status', ['approved', 'rejected'])->get();

        $reviews = [
            [
                'event_id' => $reviewedEvents->where('status', 'approved')->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Event ini sangat bagus dan sesuai dengan tujuan akademik. Semua persyaratan terpenuhi dengan baik. Disetujui untuk dilaksanakan.',
            ],
            [
                'event_id' => $reviewedEvents->where('status', 'approved')->skip(1)->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Workshop ini memberikan nilai tambah bagi mahasiswa. Materi yang diajarkan relevan dengan perkembangan teknologi terkini. Approved.',
            ],
            [
                'event_id' => $reviewedEvents->where('status', 'approved')->skip(2)->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Kegiatan kepanitiaan ini penting untuk pengembangan soft skill mahasiswa. Proposal lengkap dan timeline realistis. Disetujui.',
            ],
            [
                'event_id' => $reviewedEvents->where('status', 'approved')->skip(3)->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Program pengabdian masyarakat yang sangat baik. Memberikan manfaat langsung kepada masyarakat. Sesuai dengan Tri Dharma Perguruan Tinggi.',
            ],
            [
                'event_id' => $reviewedEvents->where('status', 'approved')->skip(4)->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Kompetisi robotika ini dapat meningkatkan minat mahasiswa terhadap teknologi. Budget reasonable dan timeline memadai. Approved.',
            ],
            [
                'event_id' => $reviewedEvents->where('status', 'rejected')->first()->id,
                'user_id' => $adminUsers->random()->id,
                'review' => 'Lokasi kegiatan terlalu jauh dan berpotensi membahayakan peserta. Budget juga tidak mencukupi untuk transportasi dan akomodasi. Mohon direvisi proposal.',
            ]
        ];

        foreach ($reviews as $review) {
            EventReview::create($review);
        }
    }
}