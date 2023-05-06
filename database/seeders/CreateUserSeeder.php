<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Reggy Charles Imanuel Lasut',
                'nik' => '1234567890123456',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Raya Kampus Unsrat',
                'role' => '1',
                'email' => 'charles@pertanian.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Markus Lasut',
                'nik' => '1234567890123464',
                'no_hp' => '081234567810',
                'alamat' => 'Jl. Raya Boolevart',
                'role' => '2',
                'email' => 'markus@pertanian.com',
                'password' => bcrypt('12345678'),
            ]
        ];
        foreach ($user as $user){
            User::create($user);
        }
    }
}
