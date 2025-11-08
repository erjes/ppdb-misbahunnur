<?php

namespace App\Livewire\Admin\Students;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Student;
use App\Models\Registration;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]  

class MTSComponent extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'sort')]
    public string $sortField = 'students.created_at';

    #[Url(as: 'dir')]
    public string $sortDirection = 'desc';

    #[Url(as: 'pp')]
    public int $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'students.created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    private function baseQuery(): Builder
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
            ])
            ->join('registrations', 'registrations.student_id', '=', 'students.id')
            ->where('registrations.jenjang_daftar', 'MTS')
            ->where('registrations.status', 'approved')
            ->when($this->search !== '', function (Builder $q) {
                $s = '%' . str_replace(' ', '%', $this->search) . '%';
                $q->where(function (Builder $w) use ($s) {
                    $w->where('students.nama_lengkap', 'like', $s)
                      ->orWhere('students.nomor_pendaftaran', 'like', $s)
                      ->orWhere('students.nisn', 'like', $s)
                      ->orWhere('students.nik_siswa', 'like', $s);
                });
            });
    }

    public function getRowsProperty()
    {
        $allowedSorts = [
            'students.created_at',
            'students.nama_lengkap',
            'students.nomor_pendaftaran',
            'students.nisn',
        ];
        $sortField = in_array($this->sortField, $allowedSorts, true)
            ? $this->sortField
            : 'students.created_at';

        return $this->baseQuery()
            ->orderBy($sortField, $this->sortDirection === 'asc' ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.students.mts', [
            'rows' => $this->rows,
        ]);
    }
}
