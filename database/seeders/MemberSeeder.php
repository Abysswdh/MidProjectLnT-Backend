<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'member_code' => 'MBR00001',
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'join_date' => '2024-01-15',
            ],
            [
                'member_code' => 'MBR00002',
                'name' => 'Siti Rahayu',
                'email' => 'siti@example.com',
                'phone' => '081234567891',
                'address' => 'Jl. Sudirman No. 45, Bandung',
                'join_date' => '2024-02-20',
            ],
            [
                'member_code' => 'MBR00003',
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'phone' => '081234567892',
                'address' => 'Jl. Diponegoro No. 67, Surabaya',
                'join_date' => '2024-03-10',
            ],
            [
                'member_code' => 'MBR00004',
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'phone' => '081234567893',
                'address' => 'Jl. Gatot Subroto No. 89, Yogyakarta',
                'join_date' => '2024-04-05',
            ],
            [
                'member_code' => 'MBR00005',
                'name' => 'Rizky Pratama',
                'email' => 'rizky@example.com',
                'phone' => '081234567894',
                'address' => 'Jl. Ahmad Yani No. 12, Semarang',
                'join_date' => '2024-05-18',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
