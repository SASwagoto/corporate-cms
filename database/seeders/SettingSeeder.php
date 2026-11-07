<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Corporate Info
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Nordroy CMS', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'Marine & Power Platform', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_logo', 'value' => 'assets/images/logo.png', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_icon', 'value' => 'assets/images/icon.png', 'type' => 'text'],
            
            // Login & Portal Info
            ['group' => 'auth', 'key' => 'auth_headline', 'value' => 'Marine & Power Engineering Platform', 'type' => 'text'],
            ['group' => 'auth', 'key' => 'auth_tagline', 'value' => 'Authorized portal for marine engineers, turbine specialists, and administrative leadership.', 'type' => 'text'],
            
            // Industrial Brand Palette (Nordroy Marine Navy)
            ['group' => 'theme', 'key' => 'theme_primary_color', 'value' => '#013d5a', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_accent_color', 'value' => '#6f7478', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}