<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndAdminSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            EnquirySeeder::class,
        ]);
    }
}