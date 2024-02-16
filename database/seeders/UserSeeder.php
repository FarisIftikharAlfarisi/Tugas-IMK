<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Faris Iftikhar Alfarisi',
            'email' => 'Faris@gmail.com',
            'role' => 'ADMIN',
            'password' => 'faris123',
            'no_telepon' => '10122050',
        ]);
        User::create([
            'username' => 'Fauzan',
            'email' => 'Fauzan@gmail.com',
            'role' => 'PRODUKSI',
            'password' => 'fauzan123',
            'no_telepon' => '10122057',
        ]);
        User::create([
            'username' => 'Syipa Afiyani',
            'email' => 'Syipa@gmail.com',
            'role' => 'ADMIN',
            'password' => 'syipa123',
            'no_telepon' => '10122047',
        ]);
        User::create([
            'username' => 'Fadly Fatwa Winata Alqoeruddin',
            'email' => 'Fadly@gmail.com',
            'role' => 'PRODUKSI',
            'password' => 'fadly123',
            'no_telepon' => '10122045',
        ]);
        User::create([
            'username' => 'Rangga Driya Nugraha ',
            'email' => 'Rangga@gmail.com',
            'role' => 'PRODUKSI',
            'password' => 'rangga123',
            'no_telepon' => '10122046',
        ]);
    }
}
