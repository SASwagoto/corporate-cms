<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    public function run(): void
    {
        if (Enquiry::count() > 0) {
            return;
        }

        $samples = [
            [
                'type'       => 'quotation',
                'full_name'  => 'Capt. Tariqul Islam (Chief Superintendent)',
                'email'      => 'tariqul.ops@pacific-oceanic.com',
                'phone'      => '+8801819234567',
                'company'    => 'Pacific Oceanic Shipping Lines Ltd.',
                'subject'    => 'RFQ: Complete Overhaul & Dynamic Balancing - M/V Ocean Pearl (MAN TCR22)',
                'message'    => 'Vessel arriving at Chattogram Outer Anchorage on 12th Nov for a 48h discharge window. Observed high-frequency vibration spectrum (12.8 mm/s RMS) on the main exhaust turbocharger. Require flying squad boarding with Schenck portable balancer and full gasket/bearing kit replacement.',
                'payload'    => [
                    'vessel_plant_name'  => 'M/V Ocean Pearl (IMO 9482103)',
                    'turbocharger_model' => 'MAN TCR22-41',
                    'port_location'      => 'Chattogram Outer Anchorage',
                    'service_required'   => 'Complete Overhaul & Dynamic Balancing',
                    'urgency'            => 'Urgent Port Call (Within 48h)',
                    'submitted_at'       => now()->subHours(2)->toIso8601String(),
                ],
                'ip_address' => '103.25.120.45',
                'status'     => 'new',
                'created_at' => now()->subHours(2),
            ],
            [
                'type'       => 'quotation',
                'full_name'  => 'Engr. Mahbubur Rahman (Plant Technical Director)',
                'email'      => 'mahbub@apex-energy-power.com',
                'phone'      => '+8801711987654',
                'company'    => 'Apex Industrial Energy & Steel Consortium',
                'subject'    => 'RFQ: CHRA Cartridge Exchange - Unit 2 Generator Turbine (ABB TPL-77)',
                'message'    => 'Need rapid scheduled delivery and cartridge replacement during our plant annual maintenance turnaround in Gazipur. Please provide quotation for genuine OEM-spec balanced cartridge assembly and on-site alignment certification.',
                'payload'    => [
                    'vessel_plant_name'  => 'Apex Steel Captive Power Unit 2',
                    'turbocharger_model' => 'ABB TPL 77-B',
                    'port_location'      => 'Gazipur Industrial Belt',
                    'service_required'   => 'CHRA Cartridge Exchange',
                    'urgency'            => 'Standard Scheduled Maintenance',
                    'submitted_at'       => now()->subDays(1)->toIso8601String(),
                ],
                'ip_address' => '118.67.215.12',
                'status'     => 'read',
                'created_at' => now()->subDays(1),
            ],
            [
                'type'       => 'quotation',
                'full_name'  => 'Mr. David Vance (Technical Fleet Director)',
                'email'      => 'fleet.director@med-bulk-carriers.ch',
                'phone'      => '+41791234567',
                'company'    => 'Mediterranean Bulk Logistics Corp.',
                'subject'    => 'RFQ: Emergency Flying Squad to Vessel - M/V Golden Horizon (Napier NA297)',
                'message'    => 'CRITICAL: Severe casing oil leak and impeller blade damage reported by Chief Engineer during voyage. Vessel currently anchored off Mongla Port. Requesting 24/7 flying squad mobilization with replacement bearings, carbon seals, and ultrasonic cleaning equipment immediately.',
                'payload'    => [
                    'vessel_plant_name'  => 'M/V Golden Horizon (DWT 75,000)',
                    'turbocharger_model' => 'Napier NA 297',
                    'port_location'      => 'Mongla Port Fairway',
                    'service_required'   => 'Emergency Flying Squad to Vessel',
                    'urgency'            => 'Emergency Vessel Blackout / AOG',
                    'submitted_at'       => now()->subMinutes(35)->toIso8601String(),
                ],
                'ip_address' => '195.176.24.89',
                'status'     => 'new',
                'created_at' => now()->subMinutes(35),
            ],
        ];

        foreach ($samples as $sample) {
            Enquiry::create($sample);
        }
    }
}
