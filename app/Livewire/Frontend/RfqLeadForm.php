<?php

namespace App\Livewire\Frontend;

use App\Models\Enquiry;
use Livewire\Component;

class RfqLeadForm extends Component
{
    public string $full_name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $vessel_plant_name = '';
    public string $turbocharger_model = '';
    public string $port_location = 'Chattogram Port';
    public string $service_required = 'Complete Overhaul & Dynamic Balancing';
    public string $urgency = 'Standard Scheduled Maintenance';
    public string $message = '';

    // Honeypot field for anti-bot spam prevention
    public string $extra_honey = '';

    public bool $isSubmitted = false;
    public ?string $referenceCode = null;
    public ?array $submittedData = null;

    protected function rules(): array
    {
        return [
            'full_name'          => 'required|string|min:3|max:150',
            'email'              => 'required|email:filter|max:150',
            'phone'              => 'required|string|min:7|max:50',
            'company'            => 'nullable|string|max:150',
            'vessel_plant_name'  => 'required|string|min:2|max:150',
            'turbocharger_model' => 'required|string|min:2|max:150',
            'port_location'      => 'required|string|max:100',
            'service_required'   => 'required|string|max:150',
            'urgency'            => 'required|string|max:100',
            'message'            => 'required|string|min:10|max:3000',
        ];
    }

    protected function messages(): array
    {
        return [
            'full_name.required'          => 'Please provide the contact person / chief engineer name.',
            'email.required'              => 'A valid technical or corporate email address is required.',
            'phone.required'              => 'Direct phone or WhatsApp number is required for urgent port dispatch.',
            'vessel_plant_name.required'  => 'Please specify the vessel name (e.g. M/V Nordroy) or industrial plant unit.',
            'turbocharger_model.required' => 'Please enter the turbocharger manufacturer & model (e.g. ABB TPL-77, MAN TCR22).',
            'message.required'            => 'Please describe the symptoms, required scope, or observed vibrations.',
            'message.min'                 => 'Please provide at least a brief technical description (minimum 10 characters).',
        ];
    }

    public function submitRfq(): void
    {
        // Silent bot drop
        if (!empty($this->extra_honey)) {
            $this->isSubmitted = true;
            $this->referenceCode = 'NRQ-' . date('Y') . '-0001';
            return;
        }

        $validated = $this->validate();

        $enquiry = Enquiry::create([
            'type'       => 'quotation',
            'full_name'  => trim($validated['full_name']),
            'email'      => trim(strtolower($validated['email'])),
            'phone'      => trim($validated['phone']),
            'company'    => trim($validated['company'] ?? ''),
            'subject'    => "RFQ: {$validated['service_required']} - {$validated['vessel_plant_name']} ({$validated['turbocharger_model']})",
            'message'    => trim($validated['message']),
            'payload'    => [
                'vessel_plant_name'  => trim($validated['vessel_plant_name']),
                'turbocharger_model' => trim($validated['turbocharger_model']),
                'port_location'      => trim($validated['port_location']),
                'service_required'   => trim($validated['service_required']),
                'urgency'            => trim($validated['urgency']),
                'submitted_at'       => now()->toIso8601String(),
            ],
            'ip_address' => request()->ip(),
            'status'     => 'new',
        ]);

        $this->referenceCode = sprintf('NRQ-%s-%04d', date('Y'), $enquiry->id);

        $this->submittedData = [
            'vessel'  => $validated['vessel_plant_name'],
            'model'   => $validated['turbocharger_model'],
            'port'    => $validated['port_location'],
            'service' => $validated['service_required'],
            'urgency' => $validated['urgency'],
            'name'    => $validated['full_name'],
            'email'   => $validated['email'],
        ];

        $this->isSubmitted = true;
    }

    public function resetForm(): void
    {
        $this->reset([
            'full_name',
            'email',
            'phone',
            'company',
            'vessel_plant_name',
            'turbocharger_model',
            'message',
            'extra_honey',
            'isSubmitted',
            'referenceCode',
            'submittedData',
        ]);
        $this->port_location = 'Chattogram Port';
        $this->service_required = 'Complete Overhaul & Dynamic Balancing';
        $this->urgency = 'Standard Scheduled Maintenance';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.frontend.rfq-lead-form');
    }
}
