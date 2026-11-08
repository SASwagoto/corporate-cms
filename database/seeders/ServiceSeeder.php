<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'en' => 'Dynamic Rotor Balancing (100k RPM)',
                    'bn' => 'ডায়নামিক রটার ব্যালেন্সিং (১০০,০০০ আরপিএম)',
                ],
                'slug' => 'dynamic-rotor-balancing',
                'icon' => 'solid:gauge',
                'short_summary' => [
                    'en' => 'Elimination of micro-vibrations with computerized dynamic balancing up to 100,000 RPM, certified with comprehensive tolerance test sheets.',
                    'bn' => 'কম্পিউটারাইজড ডায়নামিক ব্যালেন্সিংয়ের মাধ্যমে মাইক্রো-কম্পন দূরীকরণ (১০০,০০০ আরপিএম পর্যন্ত), ক্লাস টেস্ট সার্টিফিকেশন সহ।',
                ],
                'content' => [
                    'en' => 'At extreme peripheral velocities, even a fraction of a gram imbalance creates immense centrifugal forces that destroy hydrodynamic bearings and trigger blade failure. We utilize high-precision Schenck dynamic balancing systems with dual-plane phase angle sensors, balancing rotors up to 100,000 RPM in accordance with ISO 1940-1 grade G2.5 standards.',
                    'bn' => 'উচ্চ গতিতে সামান্যতম ভারসাম্যহীনতাও ঘূর্ণনশীল বিয়ারিং এবং ব্লেডের মারাত্মক ক্ষতি করতে পারে। আমরা শেনক ডুয়াল-প্লেন ডায়নামিক ব্যালেন্সিং সিস্টেমের মাধ্যমে আইএসও ১৯৪০-১ জি২.৫ মান অনুযায়ী নিখুঁত ব্যালেন্সিং নিশ্চিত করি।',
                ],
                'is_featured' => true,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Turbine Blading & TIG Welding',
                    'bn' => 'টারবাইন ব্লেডিং এবং টিআইজি ওয়েল্ডিং',
                ],
                'slug' => 'turbine-blading-tig-welding',
                'icon' => 'solid:fire-flame-curved',
                'short_summary' => [
                    'en' => 'Precision laser and micro-TIG rebuilding of eroded turbine blade profiles, shroud rings, and metallurgical crack restoration.',
                    'bn' => 'ক্ষয়ে যাওয়া টারবাইন ব্লেড প্রোফাইল, শ্রাউড রিং এবং মেটালার্জিক্যাল ফাটল মেরামতে নির্ভুল মাইক্রো-টিআইজি এবং লেজার রিবিল্ডিং।',
                ],
                'content' => [
                    'en' => 'Heavy fuel oil deposits and high exhaust temperatures erode turbine blade tips, degrading thermodynamic expansion efficiency. We perform certified micro-TIG reconstruction on Nimonic alloys, re-profiling blade aerofoils, replacing damping wires, and conducting dye-penetrant inspection to eliminate micro-fractures.',
                    'bn' => 'ভারী জ্বালানী তেল ও অতিরিক্ত তাপমাত্রার ফলে টারবাইন ব্লেডের ক্ষতি হয়। আমরা নিমোনিক অ্যালয়ের উপর বিশেষায়িত মাইক্রো-টিআইজি পুনঃনির্মাণ, ব্লেড অ্যারোফয়েল প্রোফাইলিং এবং ডাই-পেনেট্র্যান্ট পরীক্ষার মাধ্যমে শতভাগ নির্ভরযোগ্যতা নিশ্চিত করি।',
                ],
                'is_featured' => true,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Cartridge (CHRA) Exchange & Rebuild',
                    'bn' => 'কার্ট্রিজ (CHRA) এক্সচেঞ্জ এবং পুনর্নির্মাণ',
                ],
                'slug' => 'cartridge-chra-exchange',
                'icon' => 'solid:arrows-rotate',
                'short_summary' => [
                    'en' => 'Pre-assembled, factory-balanced cartridge replacement modules for rapid turnaround times during tight vessel port calls.',
                    'bn' => 'জাহাজের দ্রুত টার্নঅ্যারাউন্ডের জন্য ফ্যাক্টরি-ক্যালিব্রেটেড ও প্রি-অ্যাসেম্বলড কার্ট্রিজ প্রতিস্থাপন ও রিবিল্ড সুবিধা।',
                ],
                'content' => [
                    'en' => 'When vessel schedules permit only a short port window, our ready-assembled, balanced cartridge (Center Housing Rotating Assembly) modules provide the fastest solution. We swap out the worn core, install a factory-calibrated CHRA, and rebuild your core at our workshop for future rotation.',
                    'bn' => 'বন্দরে স্বল্প সময়ের অবস্থানের সময় জাহাজের টার্বোচার্জার সম্পূর্ণ ডাউনটাইম এড়াতে আমাদের প্রস্তুত কার্ট্রিজ এক্সচেঞ্জ প্রোগ্রাম সবচেয়ে কার্যকর সমাধান দেয়।',
                ],
                'is_featured' => true,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Ultrasonic Chemical De-Carbonization',
                    'bn' => 'আল্ট্রাসনিক কেমিক্যাল ডি-কার্বনাইজেশন',
                ],
                'slug' => 'ultrasonic-chemical-decarbonization',
                'icon' => 'solid:spray-can',
                'short_summary' => [
                    'en' => 'Multi-stage heated ultrasonic bath cleaning to remove stubborn heavy fuel oil carbon glaze without damaging parent metal tolerances.',
                    'bn' => 'ধাতব সহনশীলতা অক্ষত রেখে ভারী জ্বালানী তেলের অবশিষ্টাংশ এবং কার্বন সরাতে বহু-স্তরীয় উত্তপ্ত আল্ট্রাসনিক বাথ ক্লিনিং।',
                ],
                'content' => [
                    'en' => 'Multi-stage heated ultrasonic immersion baths paired with biodegradable solvency solutions safely break down crystalline heavy fuel oil carbon, sulfur residue, and varnish encrustations on turbine nozzles and diffuser rings without pitting or eroding parent metallurgy.',
                    'bn' => 'বিশেষায়িত পরিবেশবান্ধব রাসায়নিক দ্রবণ ও উচ্চ-ফ্রিকোয়েন্সি আল্ট্রাসনিক তরঙ্গের সমন্বয়ে নোজেল রিং এবং ডিফিউজারের শক্ত কার্বনস্তর নিরাপদে সম্পূর্ণ পরিষ্কার করা হয়।',
                ],
                'is_featured' => false,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => '24/7 Port Emergency Flying Squads',
                    'bn' => '২৪/৭ পোর্ট ইমার্জেন্সি ফ্লাইং স্কোয়াড',
                ],
                'slug' => 'emergency-flying-squads',
                'icon' => 'solid:truck-fast',
                'short_summary' => [
                    'en' => 'Marine engineers equipped with mobile inspection tools ready to board vessels at Chattogram, Mongla, or international outer anchorages.',
                    'bn' => 'চট্টগ্রাম, মোংলা বা গভীর সাগরে নোঙ্গর করা জাহাজে জরুরি মেরামতের জন্য ভ্রাম্যমাণ টেস্টিং সরঞ্জামসহ প্রস্তুত মেরিন ইঞ্জিনিয়ার দল।',
                ],
                'content' => [
                    'en' => 'Factory-trained certified marine technicians on standby 24/7, ready to dispatch within 2 hours of distress notice. Equipped with portable vibration analyzers, laser alignment tools, and complete field overhaul equipment to perform emergency repairs at outer anchorages or quayside berths.',
                    'bn' => 'জরুরি প্রয়োজনে ২ ঘণ্টার মধ্যে রওনা হতে প্রস্তুত ডিএনভি-প্রত্যয়িত প্রকৌশলী দল। গভীর সমুদ্রে অ্যাঙ্করেজে কিংবা জেটিতে দ্রুততম সময়ে নির্ভরযোগ্য মেরামত ও পরীক্ষা সম্পন্ন করা হয়।',
                ],
                'is_featured' => true,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Retrofit & Modernization Upgrades',
                    'bn' => 'রেট্রোফিট এবং আধুনিকীকরণ আপগ্রেড',
                ],
                'slug' => 'retrofit-modernization-upgrades',
                'icon' => 'solid:wrench',
                'short_summary' => [
                    'en' => 'Replacement of outdated, obsolete turbochargers with modern, high-efficiency models for reduced fuel consumption and lower IMO emissions.',
                    'bn' => 'জ্বালানী সাশ্রয় এবং আইএমও নির্গমন মান পূরণে পুরনো টার্বোচার্জারের স্থলে আধুনিক উচ্চ-দক্ষতার ইউনিট প্রতিস্থাপন।',
                ],
                'content' => [
                    'en' => 'Turnkey engineering packages to swap out obsolete turbocharger models with contemporary high-pressure ratio units. Includes exhaust casing adapter fabrication, cooling line rerouting, classification society drawing approvals, and guaranteed reductions in specific fuel oil consumption (SFOC).',
                    'bn' => 'পুরনো মডেলের টার্বোচার্জার পরিবর্তন করে সমসাময়িক প্রযুক্তি সংযুক্তির পূর্ণাঙ্গ সমাধান। এর মধ্যে রয়েছে গ্যাস ক্যাসিং অ্যাডাপ্টার তৈরি, কুলিং লাইন পুনর্বিন্যাস এবং ক্লাস সোসাইটি অনুমোদন।',
                ],
                'is_featured' => false,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(
                ['slug' => $svc['slug']],
                $svc
            );
        }
    }
}
