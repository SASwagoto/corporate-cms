<?php

use App\Livewire\Admin\Access\AccessManager;
use App\Livewire\Admin\Enquiries\EnquiryManager;
use App\Livewire\Admin\Media\MediaManager;
use App\Livewire\Admin\Services\ServiceManager;
use App\Livewire\Admin\Settings\SettingsManager;
use App\Livewire\Admin\Theme\ThemeStudio;
use App\Services\IconRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/project-details/{slug?}', function (?string $slug = null) {
    $projects = [
        'marine-vessel-turbocharger-overhaul' => [
            'slug'           => 'marine-vessel-turbocharger-overhaul',
            'title'          => 'Marine Vessel Turbocharger Overhaul & High-Speed Dynamic Balancing',
            'subtitle'       => 'Complete turbocharger refit, ultrasonic cleaning, and rotor balancing for 85,000 DWT Container Carrier',
            'category'       => 'Marine Turbocharger Overhaul',
            'youtube_id'     => '9No-FiEInLA',
            'youtube_url'    => 'https://www.youtube.com/embed/9No-FiEInLA?autoplay=0&rel=0',
            'client'         => 'Pacific Oceanic Shipping Lines Ltd.',
            'location'       => 'Chittagong Port & Outer Anchorage',
            'sector'         => 'Commercial Shipping & Maritime Freight',
            'capacity'       => 'MAN NR/S 34 Series (18,500 Max RPM)',
            'duration'       => '36 Hours Turnaround (Zero Port Demurrage)',
            'year'           => '2024',
            'classification' => 'DNV & Lloyd\'s Register Certified',
            'status'         => 'Completed & In Service',
            'featured_image' => 'assets/images/gallery/gallery-vessel.jpg',
            'overview'       => 'During an international transit call, the 85,000 DWT container vessel experienced severe exhaust turbine vibrations exceeding 14.2 mm/s RMS, requiring immediate emergency intervention before onward ocean passage. Nordroy Marine dispatched an emergency response squad aboard with complete diagnostic instruments and genuine OEM spare kits.',
            'challenge'      => 'The ship had only a strict 36-hour berth window before scheduled departure. Failure to balance the rotor within this window would result in severe port demurrage penalties ($65,000/day) and risk complete catastrophic turbine blade rupture on high seas.',
            'solution'       => 'Our team extracted the turbocharger cartridge on-site, transported it to our certified workshop, performed ultrasonic chemical decarbonization, replaced worn labyrinth seals and ceramic journal bearings, and completed dynamic rotor balancing on our calibrated Schenck balance bench down to ISO 1940 Grade G1.0 tolerance (0.42 mm/s residual vibration). The cartridge was re-installed and validated during full sea-trial engine loading.',
            'metrics'        => [
                ['label' => 'Vibration Reduction', 'value' => '97.2%', 'detail' => 'Reduced from 14.2 mm/s to 0.4 mm/s'],
                ['label' => 'Port Turnaround', 'value' => '32 Hours', 'detail' => 'Delivered 4 hours ahead of vessel sailing schedule'],
                ['label' => 'Cost Savings', 'value' => '$130,000+', 'detail' => 'Demurrage averted & fuel efficiency restored'],
                ['label' => 'Warranty Coverage', 'value' => '12 Months', 'detail' => 'Comprehensive marine class warranty'],
            ],
            'scope_items'    => [
                'Complete cartridge extraction and heavy rigging operations aboard ship',
                'Ultrasonic chemical decarbonization of turbine blades and compressor wheel',
                'Precision rotor shaft micro-TIG re-profiling and run-out inspection',
                'High-speed dynamic balancing conforming to ISO 1940 Grade G1.0',
                'Replacement of thrust bearings, journal bearings, and oil seals with OEM parts',
                'Static pressure testing of water-cooled turbine casing at 4.5 bar',
                'Re-installation, torque-angle bolt tightening, and sea-trial data logging'
            ],
            'gallery'        => [
                'assets/images/gallery/gallery-vessel.jpg',
                'assets/images/gallery/gallery-balancing.webp',
                'assets/images/gallery/gallery-turbine.webp',
                'assets/images/gallery/gallery-technician.jpg',
            ]
        ],
        'industrial-power-plant-balancing' => [
            'slug'           => 'industrial-power-plant-balancing',
            'title'          => '2.5MW Industrial Power Plant Turbocharger Refit & Overhaul',
            'subtitle'       => 'Continuous heavy-duty turbine overhaul and compressor cartridge overhaul for heavy manufacturing plant',
            'category'       => 'Industrial Captive Power',
            'youtube_id'     => 'kJQP7kiw5Fk',
            'youtube_url'    => 'https://www.youtube.com/embed/kJQP7kiw5Fk?autoplay=0&rel=0',
            'client'         => 'Apex Industrial Energy & Steel Consortium',
            'location'       => 'Gazipur Industrial Belt, Bangladesh',
            'sector'         => 'Heavy Industry / Captive Energy',
            'capacity'       => '2.5 MW Dual-Fuel Turbocharged Generating Unit',
            'duration'       => '4 Days Scheduled Maintenance Outage',
            'year'           => '2024',
            'classification' => 'ISO 9001:2015 Class A Certified',
            'status'         => 'Operational & Fully Commissioned',
            'featured_image' => 'assets/images/gallery/gallery-plant.webp',
            'overview'       => 'A 2.5 MW captive power plant supplying electricity to continuous textile and steel production suffered severe thermal degradation and compressor surging, reducing generator capacity by 28%. Nordroy was contracted for complete overhaul, thermal crack repair, and performance tuning.',
            'challenge'      => 'A continuous manufacturing process with hundreds of loom lines could only sustain a maximum 96-hour plant shutdown. Casing distortion and blade micro-fractures required on-site metallurgy and immediate precision remediation.',
            'solution'       => 'Utilizing our portable dynamic balancing equipment and high-purity argon micro-TIG welding rigs, we repaired the gas inlet casing on-site, replaced the turbine rotor assembly, and dynamically balanced the rotor to aerospace tolerances. Total heat rate improved by 6.4%.',
            'metrics'        => [
                ['label' => 'Power Recovery', 'value' => '+700 kW', 'detail' => 'Restored generation to full 2.5 MW nameplate rating'],
                ['label' => 'Thermal Efficiency', 'value' => '+6.4%', 'detail' => 'Significant reduction in specific fuel consumption'],
                ['label' => 'Downtime Adherence', 'value' => '88 Hours', 'detail' => 'Completed 8 hours ahead of critical 96h limit'],
                ['label' => 'Availability Guarantee', 'value' => '99.5%', 'detail' => 'Zero unplanned outages since commissioning'],
            ],
            'scope_items'    => [
                'On-site cartridge dismantling with specialized hydraulic pullers',
                'Fluorescent penetrant inspection (NDT) to identify invisible micro-fissures',
                'Micro-TIG argon welding of casing erosion using nickel-alloy filler wires',
                'Dual-plane dynamic balancing of compressor wheel and turbine shaft assembly',
                'Laser alignment between generator shaft, gearbox, and turbine rotor',
                'Full electrical load testing and vibration signature spectrum analysis'
            ],
            'gallery'        => [
                'assets/images/gallery/gallery-plant.webp',
                'assets/images/gallery/gallery-generator.webp',
                'assets/images/gallery/gallery-welding.webp',
                'assets/images/gallery/gallery-substation.webp',
            ]
        ],
        'emergency-anchorage-flying-squad' => [
            'slug'           => 'emergency-anchorage-flying-squad',
            'title'          => 'Emergency Anchorage Flying Squad Turbocharger Cartridge Swap',
            'subtitle'       => 'Rapid boarding at outer anchorage via offshore tug to replace wrecked turbocharger cartridge at sea',
            'category'       => 'Emergency Flying Squad',
            'youtube_id'     => '9No-FiEInLA',
            'youtube_url'    => 'https://www.youtube.com/embed/9No-FiEInLA?autoplay=0&rel=0',
            'client'         => 'Mediterranean Bulk Logistics Corp.',
            'location'       => 'Outer Anchorage (Deep Sea Anchorage, Bay of Bengal)',
            'sector'         => 'Deep-Sea Bulk Cargo',
            'capacity'       => 'ABB TPL 77-B Marine Turbocharger Unit',
            'duration'       => '24-Hour Emergency Response Squad',
            'year'           => '2024',
            'classification' => 'American Bureau of Shipping (ABS) Certified',
            'status'         => 'Successfully Dispatched & Completed',
            'featured_image' => 'assets/images/gallery/gallery-turbine.webp',
            'overview'       => 'While waiting for anchorage lightering, an ocean-going bulk carrier reported catastrophic lubrication loss in its ABB TPL 77-B turbocharger, resulting in seized shaft bearings and smoke in the engine casing. Nordroy Flying Squad was mobilized in under 3 hours.',
            'challenge'      => 'Performing heavy mechanical rigging and precision micro-clearance assembly in choppy 2.5m swells at deep anchorage without access to shore-based cranes or workshop facilities.',
            'solution'       => 'A certified 5-person technical flying squad boarded the vessel with a pre-assembled, factory-balanced replacement cartridge. Using temporary chain hoists and onboard gantry systems, the seized unit was swapped, lube lines flushed, and main engine load tested successfully within 22 hours.',
            'metrics'        => [
                ['label' => 'Dispatch Mobilization', 'value' => '170 Mins', 'detail' => 'Squad departed port base within 3 hours of SOS call'],
                ['label' => 'Total At-Sea Work', 'value' => '19.5 Hours', 'detail' => 'Complete cartridge extraction & swap at anchorage'],
                ['label' => 'Demurrage Saved', 'value' => '$90,000+', 'detail' => 'Avoided emergency towing and port berth penalties'],
                ['label' => 'Safety Record', 'value' => 'Zero Incidents', 'detail' => 'Safe heavy rigging under rough sea conditions'],
            ],
            'scope_items'    => [
                'Emergency dispatch of 5-member DNV-certified marine engineering flying squad',
                'Boarding via offshore crew transfer vessel in deep anchorage',
                'Rigging and extraction of 1.8-ton seized cartridge assembly inside engine room',
                'Ultrasonic cleaning and high-pressure chemical flushing of lubricating oil lines',
                'Installation of factory-balanced OEM replacement cartridge',
                'Cold cranking test, hot bearing temperature monitoring, and sea-trial sign-off'
            ],
            'gallery'        => [
                'assets/images/gallery/gallery-turbine.webp',
                'assets/images/gallery/gallery-technician.jpg',
                'assets/images/gallery/gallery-vessel.jpg',
                'assets/images/gallery/gallery-balancing.webp',
            ]
        ],
    ];

    $slug = $slug ?? 'marine-vessel-turbocharger-overhaul';
    $project = $projects[$slug] ?? $projects['marine-vessel-turbocharger-overhaul'];

    return view('pages.project-details', [
        'project'  => $project,
        'projects' => $projects,
        'slug'     => $slug,
    ]);
})->name('project.details');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| Authentication Fallback & Direct Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Breeze Compatibility Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Corporate CMS Administration Panel (RBAC Protected)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth',
    'role:Super Administrator|Administrator|Editor|Content Manager',
])->prefix('admin')->name('admin.')->group(function () {

    // Executive Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Global Settings Studio
    Route::get('/settings', SettingsManager::class)
        ->middleware('permission:settings.manage')
        ->name('settings');

    // Inquiries & RFQ Duty Desk
    Route::get('/enquiries', EnquiryManager::class)
        ->middleware('permission:enquiries.view')
        ->name('enquiries');

    // Access Control Studio (Users & Permissions)
    Route::get('/access', AccessManager::class)
        ->middleware('permission:users.view|roles.manage')
        ->name('access');

    // Theme Customizer Studio
    Route::get('/theme', ThemeStudio::class)
        ->middleware('permission:theme.manage')
        ->name('theme');

    // Media Asset Library
    Route::get('/media', MediaManager::class)
        ->middleware('permission:media.view')
        ->name('media');

    // Marine Services & Precision Overhauls
    Route::get('/services', ServiceManager::class)
        ->middleware('permission:services.view')
        ->name('services');

    // Ultra-Fast Cached JSON Endpoint for Icon Picker (Zero Page Bloat)
    Route::get('/api/icons-manifest', function () {
        return response()->json(IconRegistry::getManifest())
            ->header('Cache-Control', 'public, max-age=604800, immutable');
    })->name('icons.manifest');
    
    // User Profile
    Route::view('/profile', 'profile')->name('profile');
});

/*
|--------------------------------------------------------------------------
| Breeze Livewire Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
