<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate(['username' => 'administrator'], [
            'name' => 'Admin',
            'email' => 'myadmin@gmail.com',
            'username' => 'administrator',
            'password' => Hash::make('admin@123'),
        ]);
    }
}