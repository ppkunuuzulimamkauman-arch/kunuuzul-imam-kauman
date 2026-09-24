<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Produksi: hanya admin. Akun demo (pjgt001/gt001/dll) dihapus agar tidak ikut ke-seed.
        $users = [
            [
                'name' => 'Admin Kunuuzul',
                'email' => 'admin@kunuuzul.test',
                'username' => 'admin',
                'role' => 'admin',
                'password' => 'admin123',
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], $u);
        }
    }
}
