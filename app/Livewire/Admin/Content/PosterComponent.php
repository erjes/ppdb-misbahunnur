<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Content;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]

class PosterComponent extends Component
{
    use WithFileUploads;

    public $title = 'poster';
    public $poster;
    public $content_type = 'poster';
    
    public $isEditing = false;
    public $posterId = null;
    public $oldFilename = null;
    
    public Collection $posters;

    protected $rules = [
        'title' => 'required|string|max:255',
        'poster' => 'required|image|max:2048',
    ];
    
    protected $messages = [
        'poster.required' => 'File poster wajib diunggah.',
        'poster.image' => 'File harus berupa gambar (JPEG, PNG, BMP, GIF, SVG, atau WebP).',
        'poster.max' => 'Ukuran file poster maksimal 2MB.',
    ];

    public function mount()
    {
        $this->loadPosters();
        $this->title = 'poster';
    }

    public function updatedPoster()
    {
        $this->validateOnly('poster');
    }

    public function loadPosters()
    {
        $this->posters = Content::where('content', 'poster')->orderBy('id', 'desc')->get();
    }

    public function uploadPoster()
    {
        if ($this->isEditing) {
            return $this->updatePoster();
        }

        $this->validate();

        $filename = $this->poster->store('posters', 'public');

        Content::create([
            'filename' => $filename, 
            'content' => $this->content_type,
            'title' => $this->title,
        ]);

        $this->reset(['poster', 'title', 'isEditing', 'posterId', 'oldFilename']);
        $this->loadPosters();
        session()->flash('message', 'Poster berhasil diunggah!');
    }

    public function edit($id)
    {
        $poster = Content::findOrFail($id);
        
        $this->rules['poster'] = 'nullable|image|max:2048';
        
        $this->isEditing = true;
        $this->posterId = $poster->id;
        $this->title = $poster->title;
        $this->oldFilename = $poster->filename;
        $this->poster = null;
    }

    public function updatePoster()
    {
        $this->validate();
        
        $poster = Content::findOrFail($this->posterId);
        $updateData = ['title' => $this->title];
        
        if ($this->poster) {
            if ($this->oldFilename) {
                Storage::disk('public')->delete($this->oldFilename);
            }
            $updateData['filename'] = $this->poster->store('posters', 'public');
        }
        
        $poster->update($updateData);

        $this->rules['poster'] = 'required|image|max:2048';

        $this->reset(['poster', 'title', 'isEditing', 'posterId', 'oldFilename']);
        $this->loadPosters();
        session()->flash('message', 'Poster berhasil diperbarui!');
    }

    public function deletePoster($id)
    {
        $poster = Content::findOrFail($id);
        
        if ($poster->filename) {
            Storage::disk('public')->delete($poster->filename);
        }
        
        $poster->delete();
        $this->loadPosters();
        session()->flash('message', 'Poster berhasil dihapus!');
    }

    public function cancelEdit()
    {
        $this->rules['poster'] = 'required|image|max:2048';
        $this->reset(['poster', 'title', 'isEditing', 'posterId', 'oldFilename']);
    }

    public function render()
    {
        return view('livewire.admin.content.poster');
    }
}