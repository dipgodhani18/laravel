<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(['username' => 'administrator'], [
            'username' => 'administrator',
            'password' => Hash::make('admin@123'),
        ]);
    }
}