<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Payment;
use Livewire\WithPagination;

class PaymentListComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $payments = Payment::query()
            ->where('user_id', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_pendaftaran', 'like', '%' . $this->search . '%')
            ->orWhere('nisn', 'like', '%' . $this->search . '%')
            ->orWhere('nama_lengkap', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.admin.payment.list', [
            'payments' => $payments,
        ]);
    }
}
