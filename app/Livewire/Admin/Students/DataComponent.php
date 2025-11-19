<?php

namespace App\Livewire\Admin\Students;

use App\Models\Form;
use App\Models\Registration; 
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DataComponent extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'students.created_at';
    public string $sortDirection = 'desc';
    public int $perPage = 10;
    
    public $tahunFilter = null;
    public $gelombangFilter = null;
    public $jenjang = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'students.created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'tahunFilter' => ['except' => null],
        'gelombangFilter' => ['except' => null], 
    ];

    public function updatedTahunFilter() { $this->resetPage(); }
    public function updatedGelombangFilter() { $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }

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
        if ($this->tahunFilter && $this->gelombangFilter) return;

        $activeForm = Form::where('is_open', 1)->orderByDesc('tahun')->first();

        if ($activeForm) {
            $this->tahunFilter = $this->tahunFilter ?? (string) $activeForm->tahun;
            $this->gelombangFilter = $this->gelombangFilter ?? (string) $activeForm->gelombang_aktif;
            return;
        }

        $lastReg = Registration::orderByDesc('tahun')->orderByDesc('gelombang')->first();

        if ($lastReg) {
            $this->tahunFilter = $this->tahunFilter ?? $lastReg->tahun;
            $this->gelombangFilter = $this->gelombangFilter ?? $lastReg->gelombang;
            return;
        }

        $this->tahunFilter = date('Y');
        $this->gelombangFilter = '1';
    }

    private function baseQuery()
    {
        return Student::query()
            ->select([
                'students.id',
                'students.nomor_pendaftaran',
                'students.nama_lengkap',
                'students.nisn',
                'students.nik_siswa',
                'students.created_at',
                'registrations.status as reg_status',
                'registrations.is_paid',
                'registrations.jenjang_daftar',
                'registrations.tahun as reg_tahun',
                'registrations.gelombang as reg_gelombang',
                'form_submissions.submission_data',
            ])
            ->join('registrations', 'registrations.student_id', '=', 'students.id')
            ->leftJoin('form_submissions', 'form_submissions.student_id', '=', 'students.id')
            
            ->where('registrations.jenjang_daftar', $this->jenjang)
            ->where('registrations.status', 'approved')
            ->where('registrations.is_paid', 1)

            ->when($this->tahunFilter, fn($q) => $q->where('registrations.tahun', $this->tahunFilter))
            ->when($this->gelombangFilter, fn($q) => $q->where('registrations.gelombang', $this->gelombangFilter))
            
            ->when($this->search, function ($query) {
                $term = '%' . $this->search . '%';
                $query->where(function ($sub) use ($term) {
                    $sub->where('students.nama_lengkap', 'like', $term)
                        ->orWhere('students.nomor_pendaftaran', 'like', $term)
                        ->orWhere('students.nisn', 'like', $term)
                        ->orWhere('students.nik_siswa', 'like', $term);
                });
            });
    }

    public function getRowsProperty()
    {
        return $this->baseQuery()
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        $availableYears = Registration::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $availableWaves = Registration::select('gelombang')->distinct()->orderBy('gelombang', 'asc')->pluck('gelombang');

        return view('livewire.admin.students.data', [
            'rows' => $this->rows,
            'availableYears' => $availableYears,
            'availableWaves' => $availableWaves,
        ]);
    }
}