<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
{
    User::create([
        'name' => 'AdminYumly',
        'email' => 'admin@yumly.com',
        'password' => Hash::make('admin@yumly.com'), // El password es el correo
    ]);
}
}



