<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Fees;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class FeesComponent extends Component
{
    public $fees = [];

    public $feeId = null;
    public $nama_biaya = '';
    public $jumlah = 0;
    public $aktif = 1;

    protected $rules = [
        'nama_biaya' => 'required|string|max:255',
        'jumlah'     => 'required|numeric|min:0',
        'aktif'      => 'required|boolean',
    ];

    public function mount()
    {
        $this->loadFees();
    }

    public function loadFees()
    {
        $this->fees = Fees::orderBy('nama_biaya')->get();
    }

    public function resetForm()
    {
        $this->feeId      = null;
        $this->nama_biaya = '';
        $this->jumlah     = 0; 
        $this->aktif      = 1;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        if ($this->feeId) {
            $fee = Fees::findOrFail($this->feeId);
        } else {
            $fee = new Fees();
        }

        $fee->nama_biaya = $this->nama_biaya;
        $fee->jumlah     = $this->jumlah;
        $fee->aktif      = $this->aktif;
        $fee->save();

        session()->flash(
            'message',
            $this->feeId ? 'Biaya berhasil diperbarui.' : 'Biaya berhasil ditambahkan.'
        );

        $this->resetForm();
        $this->loadFees();
    }

    public function edit($id)
    {
        $fee = Fees::findOrFail($id);
    
        $this->feeId      = $fee->id;
        $this->nama_biaya = $fee->nama_biaya;
        $this->jumlah     = (int) $fee->jumlah; 
        $this->aktif      = (int) $fee->aktif; 

        // Memicu event browser untuk scroll ke form dan fokus input
        $this->dispatch('scroll-to-form');
    }
    
    public function delete($id)
    {
        $fee = Fees::findOrFail($id);
        $fee->delete();

        if ($this->feeId === $id) {
            $this->resetForm();
        }

        $this->loadFees();

        session()->flash('message', 'Biaya berhasil dihapus.');
    }


    public function render()
    {
        return view('livewire.admin.payment.fees', [
            'fees' => $this->fees,
        ]);
    }
}