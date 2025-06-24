<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $eventCreatorRole = Role::where('name', 'Pembuat Event')->first();
        $studentRole = Role::where('name', 'Mahasiswa')->first();

        $initialAdminUsers = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'phone' => '081234567890',
                'city' => 'Surabaya',
                'address' => 'Jl. Kalimantan No. 37, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin Kedua',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'phone' => '082345678901',
                'city' => 'Surabaya',
                'address' => 'Jl. Raya Surabaya No. 123',
                'email_verified_at' => now(),
            ]
        ];

        $initialEventCreators = [
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '083456789012',
                'city' => 'Surabaya',
                'address' => 'Jl. Letjen Suprapto, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Prof. Siti Nurhaliza',
                'email' => 'siti@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '084567890123',
                'city' => 'Surabaya',
                'address' => 'Jl. Kalimantan, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Drs. Ahmad Wijaya',
                'email' => 'ahmad@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '085678901234',
                'city' => 'Surabaya',
                'address' => 'Jl. Mastrip, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dr. Maya Sari',
                'email' => 'maya@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '086789012345',
                'city' => 'Surabaya',
                'address' => 'Jl. Bondowoso, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Prof. Rudi Hartono',
                'email' => 'rudi@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '087890123456',
                'city' => 'Surabaya',
                'address' => 'Jl. Gajah Mada, Surabaya',
                'email_verified_at' => now(),
            ]
        ];

        $initialStudents = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '088901234567',
                'city' => 'Surabaya',
                'address' => 'Jl. Sumatera No. 45, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '089012345678',
                'city' => 'Surabaya',
                'address' => 'Jl. Patimura No. 67, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rizki Maulana',
                'email' => 'rizki@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '081123456789',
                'city' => 'Situbondo',
                'address' => 'Jl. Situbondo Raya No. 12',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sari Indah',
                'email' => 'sari@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '082234567890',
                'city' => 'Bondowoso',
                'address' => 'Jl. Bondowoso Indah No. 34',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fajar Ramadhan',
                'email' => 'fajar@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '083345678901',
                'city' => 'Surabaya',
                'address' => 'Jl. Diponegoro No. 78, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Nita Safitri',
                'email' => 'nita@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '084456789012',
                'city' => 'Lumajang',
                'address' => 'Jl. Lumajang Permai No. 56',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bayu Aji',
                'email' => 'bayu@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '085567890123',
                'city' => 'Surabaya',
                'address' => 'Jl. Ahmad Yani No. 23, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Linda Maharani',
                'email' => 'linda@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '086678901234',
                'city' => 'Probolinggo',
                'address' => 'Jl. Probolinggo Sejahtera No. 89',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dimas Setiawan',
                'email' => 'dimas@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '087789012345',
                'city' => 'Surabaya',
                'address' => 'Jl. Hayam Wuruk No. 45, Surabaya',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Putri Amelia',
                'email' => 'putri@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '088890123456',
                'city' => 'Banyuwangi',
                'address' => 'Jl. Banyuwangi Cantik No. 101',
                'email_verified_at' => now(),
            ]
        ];

        foreach ($initialAdminUsers as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        foreach ($initialEventCreators as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        foreach ($initialStudents as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        $cities = ['Surabaya', 'Jakarta', 'Bandung', 'Yogyakarta', 'Semarang', 'Malang', 'Sidoarjo'];

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Admin User ' . $i,
                'email' => 'admin_user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'phone' => '081' . mt_rand(100000000, 999999999),
                'city' => 'Surabaya',
                'address' => 'Jl. Admin Address No. ' . $i,
                'email_verified_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => 'Event Creator ' . $i,
                'email' => 'creator' . $i . '@ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $eventCreatorRole->id,
                'phone' => '082' . mt_rand(100000000, 999999999),
                'city' => 'Surabaya',
                'address' => 'Jl. Creator Address No. ' . $i,
                'email_verified_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 300; $i++) {
            User::create([
                'name' => 'Student User ' . $i,
                'email' => 'student_user' . $i . '@student.ukp.ac.id',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'phone' => '085' . mt_rand(100000000, 999999999),
                'city' => $cities[array_rand($cities)],
                'address' => 'Jl. Student Address No. ' . $i,
                'email_verified_at' => now(),
            ]);
        }
    }
}
