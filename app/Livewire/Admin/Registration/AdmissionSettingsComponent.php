<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use App\Models\Form;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdmissionSettingsComponent extends Component
{
    public Form $form;

    public $tahun;
    public $gelombang_aktif;
    public $is_open;

    public function mount($slug = 'ppdb-online')
    {
        $this->form = Form::where('slug', $slug)->firstOrFail();

        $this->tahun          = $this->form->tahun ?? now()->year;
        $this->gelombang_aktif = $this->form->gelombang_aktif ?? 1;
        $this->is_open        = (bool) ($this->form->is_open ?? true);
    }

    protected function rules()
    {
        return [
            'tahun'           => ['required', 'integer', 'min:2020', 'max:' . (now()->year + 1)],
            'gelombang_aktif' => ['required', 'integer', 'min:1', 'max:9'],
            'is_open'         => ['required', 'boolean'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->form->tahun           = $this->tahun;
        $this->form->gelombang_aktif = $this->gelombang_aktif;
        $this->form->is_open         = $this->is_open;

        $steps = is_string($this->form->form_steps)
            ? json_decode($this->form->form_steps, true)
            : $this->form->form_steps;

        if (! is_array($steps)) {
            $steps = [];
        }

        foreach ($steps as &$step) {
            if (! isset($step['fields'])) {
                continue;
            }

            foreach ($step['fields'] as &$field) {
                if (($field['name'] ?? null) === 'gelombang') {
                    $field['value'] = (string) $this->gelombang_aktif;
                }
            }
        }
        unset($step, $field);

        $this->form->form_steps = $steps;
        $this->form->save();

        session()->flash('message', 'Pengaturan gelombang & tahun formulir berhasil disimpan.');
    }

    public function toggleStatus()
    {
        $this->is_open = ! $this->is_open;
        $this->form->is_open = $this->is_open;
        $this->form->save();

        session()->flash(
            'message',
            $this->is_open ? 'Gelombang pendaftaran dibuka.' : 'Gelombang pendaftaran ditutup.'
        );
    }

    public function render()
    {
        return view('livewire.admin.registration.admission-settings');
    }
}
