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
            ['group' => 'general', 'key' => 'site_logo_dark', 'value' => 'assets/images/logo-dark.png', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_icon', 'value' => 'assets/images/icon.png', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_icon_dark', 'value' => 'assets/images/icon-dark.png', 'type' => 'text'],
            
            // Login & Portal Info
            ['group' => 'auth', 'key' => 'auth_headline', 'value' => 'Marine & Power Engineering Platform', 'type' => 'text'],
            ['group' => 'auth', 'key' => 'auth_tagline', 'value' => 'Authorized portal for marine engineers, turbine specialists, and administrative leadership.', 'type' => 'text'],
            
            // Industrial Brand Palette (Official Logo Brand Colors: #003C58 & #75767A)
            ['group' => 'theme', 'key' => 'theme_primary_color', 'value' => '#003C58', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_secondary_color', 'value' => '#75767A', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_accent_color', 'value' => '#0ea5e9', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_surface_light', 'value' => '#ffffff', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_surface_dark', 'value' => '#07131e', 'type' => 'text'],

            // Background Video & Presentation Defaults
            ['group' => 'theme', 'key' => 'site_bg_video_enabled', 'value' => '1', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'site_bg_video_url', 'value' => 'assets/videos/background-marine.mp4', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'site_bg_video_opacity', 'value' => '85', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_hero_backdrop', 'value' => 'frosted', 'type' => 'text'],
            ['group' => 'theme', 'key' => 'theme_video_break_enabled', 'value' => '1', 'type' => 'text'],

            // SEO & Social Link Share Defaults
            ['group' => 'seo', 'key' => 'seo_meta_title', 'value' => 'Nordroy Marine & Turbochargers | Authorized Maritime Overhauls', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'seo_meta_description', 'value' => 'Authorized multi-brand marine turbocharger overhauls, high-speed dynamic balancing, cartridge reconditioning, and 24/7 port emergency flying squads in Bangladesh.', 'type' => 'textarea'],
            ['group' => 'seo', 'key' => 'seo_meta_keywords', 'value' => 'marine turbocharger, dynamic balancing, turbocharger overhaul, chittagong port, maritime engineering, cartridge rebuilding', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'seo_og_image', 'value' => '', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}