<?php

namespace App\Livewire\Admin\Students;

use App\Exports\StudentsExport;
use App\Models\Form;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.app')]
class ExportComponent extends Component
{
    public $tahun;
    public $gelombang;
    public $jenjang = '';

    public function mount()
    {
        $this->setJenjangByRole();

        $this->setDefaultFilters();
    }

    private function setJenjangByRole()
    {
        $role = Auth::user()->role;
        if ($role == 'admin_mts') {
            $this->jenjang = 'MTS';
        } elseif ($role == 'admin_ma') {
            $this->jenjang = 'MA';
        }
    }

    private function setDefaultFilters()
    {
        $activeForm = Form::where('is_open', 1)->orderByDesc('tahun')->first();

        if ($activeForm) {
            $this->tahun = (string) $activeForm->tahun;
            $this->gelombang = (string) $activeForm->gelombang_aktif;
            return;
        }

        $lastReg = Registration::orderByDesc('tahun')->orderByDesc('gelombang')->first();

        if ($lastReg) {
            $this->tahun = $lastReg->tahun;
            $this->gelombang = $lastReg->gelombang;
            return;
        }

        // Fallback terakhir
        $this->tahun = date('Y');
        $this->gelombang = '1';
    }

    public function export()
    {
        // Validasi input
        $this->validate([
            'tahun' => 'required',
            'gelombang' => 'required',
        ]);

        $fileName = 'Data_Siswa_' . $this->jenjang . '_' . $this->tahun . '_Gel_' . $this->gelombang . '.xlsx';

        return Excel::download(new StudentsExport(
            jenjang: $this->jenjang,
            search: null,
            sort: 'students.created_at',
            dir: 'desc',
            tahun: $this->tahun,
            gelombang: $this->gelombang
        ), $fileName);
    }

    public function render()
    {
        // Ambil opsi filter dari database
        $availableYears = Registration::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $availableWaves = Registration::select('gelombang')->distinct()->orderBy('gelombang', 'asc')->pluck('gelombang');

        return view('livewire.admin.students.export', [
            'availableYears' => $availableYears,
            'availableWaves' => $availableWaves,
        ]);
    }
}