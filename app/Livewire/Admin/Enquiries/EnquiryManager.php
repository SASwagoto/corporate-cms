<?php

namespace App\Livewire\Admin\Enquiries;

use App\Models\Enquiry;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('components.layouts.admin')]
class EnquiryManager extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = 'all';

    #[Url(as: 'type')]
    public string $typeFilter = 'all';

    public ?int $selectedEnquiryId = null;
    public ?Enquiry $selectedEnquiry = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function viewEnquiry(int $id): void
    {
        $enquiry = Enquiry::find($id);
        if (!$enquiry) {
            return;
        }

        // Auto mark as read if it was new
        if ($enquiry->status === 'new') {
            $enquiry->update(['status' => 'read']);
        }

        $this->selectedEnquiryId = $id;
        $this->selectedEnquiry = $enquiry;
    }

    public function closeModal(): void
    {
        $this->selectedEnquiryId = null;
        $this->selectedEnquiry = null;
    }

    public function updateStatus(int $id, string $status): void
    {
        if (!in_array($status, ['new', 'read', 'replied', 'archived'])) {
            return;
        }

        $enquiry = Enquiry::find($id);
        if ($enquiry) {
            $enquiry->update(['status' => $status]);
            if ($this->selectedEnquiry && $this->selectedEnquiry->id === $id) {
                $this->selectedEnquiry = $enquiry->fresh();
            }
            session()->flash('message', "Inquiry #{$id} status updated to " . ucfirst($status) . '.');
        }
    }

    public function deleteEnquiry(int $id): void
    {
        $enquiry = Enquiry::find($id);
        if ($enquiry) {
            $enquiry->delete();
            if ($this->selectedEnquiryId === $id) {
                $this->closeModal();
            }
            session()->flash('message', "Inquiry #{$id} successfully deleted.");
        }
    }

    public function markAllAsRead(): void
    {
        Enquiry::where('status', 'new')->update(['status' => 'read']);
        session()->flash('message', 'All new inquiries marked as read.');
    }

    public function exportCsv(): StreamedResponse
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="nordroy_leads_' . date('Y-m-d_His') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Date', 'Type', 'Status', 'Client Name', 'Company', 'Email', 'Phone',
                'Vessel/Plant', 'Equipment/Model', 'Port/Location', 'Service Required', 'Urgency', 'Subject', 'Message'
            ]);

            $query = Enquiry::latest();
            if ($this->statusFilter !== 'all') {
                $query->where('status', $this->statusFilter);
            }
            if ($this->typeFilter !== 'all') {
                $query->where('type', $this->typeFilter);
            }

            $query->chunk(100, function ($enquiries) use ($handle) {
                foreach ($enquiries as $e) {
                    $payload = is_array($e->payload) ? $e->payload : [];
                    fputcsv($handle, [
                        $e->id,
                        $e->created_at->format('Y-m-d H:i:s'),
                        $e->type,
                        $e->status,
                        $e->full_name,
                        $e->company,
                        $e->email,
                        $e->phone,
                        $payload['vessel_plant_name'] ?? '',
                        $payload['turbocharger_model'] ?? '',
                        $payload['port_location'] ?? '',
                        $payload['service_required'] ?? '',
                        $payload['urgency'] ?? '',
                        $e->subject,
                        $e->message,
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function render()
    {
        $query = Enquiry::query()->latest();

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('full_name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('phone', 'like', $term)
                  ->orWhere('company', 'like', $term)
                  ->orWhere('subject', 'like', $term)
                  ->orWhere('message', 'like', $term)
                  ->orWhere('payload', 'like', $term);
            });
        }

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->typeFilter !== 'all') {
            $query->where('type', $this->typeFilter);
        }

        $enquiries = $query->paginate(12);

        $counts = [
            'all'      => Enquiry::count(),
            'new'      => Enquiry::where('status', 'new')->count(),
            'read'     => Enquiry::where('status', 'read')->count(),
            'replied'  => Enquiry::where('status', 'replied')->count(),
            'archived' => Enquiry::where('status', 'archived')->count(),
        ];

        return view('livewire.admin.enquiries.enquiry-manager', [
            'enquiries' => $enquiries,
            'counts'    => $counts,
        ])->title('Inquiries & RFQ Duty Desk | ' . config('app.name'));
    }
}
