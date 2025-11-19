<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\Content;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;

#[Layout('layouts.app')]

class VideoComponent extends Component
{
    public $videoUrl = '';
    public $title = 'video';
    public $content_type = 'video';
    
    public $isEditing = false;
    public $videoId = null;

    public Collection $videos;
    public $currentEmbedUrl = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'videoUrl' => [
            'required',
            'url',
            'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'
        ],
    ];

    public function mount()
    {
        $this->loadVideos();
        $this->title = 'video';
    }

    public function updatedVideoUrl()
    {
        $this->generateEmbedUrl($this->videoUrl);
    }

    public function loadVideos()
    {
        $this->videos = Content::where('content', 'video')->orderBy('id', 'desc')->get();
    }

    public function uploadVideo()
    {
        $this->validate();

        Content::create([
            'filename' => $this->videoUrl, 
            'content' => $this->content_type,
            'title' => $this->title,
        ]);

        $this->reset(['videoUrl', 'title', 'isEditing', 'videoId', 'currentEmbedUrl']);
        $this->loadVideos();
        session()->flash('message', 'URL Video berhasil diunggah!');
    }

    public function edit($id)
    {
        $video = Content::findOrFail($id);
        
        $this->isEditing = true;
        $this->videoId = $video->id;
        $this->title = $video->title;
        $this->videoUrl = $video->filename;
        
        $this->generateEmbedUrl($this->videoUrl);
    }

    public function updateVideo()
    {
        $this->validate();
        
        $video = Content::findOrFail($this->videoId);
        $video->update([
            'filename' => $this->videoUrl,
            'title' => $this->title,
        ]);

        $this->reset(['videoUrl', 'title', 'isEditing', 'videoId', 'currentEmbedUrl']);
        $this->loadVideos();
        session()->flash('message', 'Video berhasil diperbarui!');
    }

    public function deleteVideo($id)
    {
        Content::destroy($id);
        $this->loadVideos();
        session()->flash('message', 'Video berhasil dihapus!');
    }

    public function cancelEdit()
    {
        $this->reset(['videoUrl', 'title', 'isEditing', 'videoId', 'currentEmbedUrl']);
    }

    protected function generateEmbedUrl($url)
    {
        $videoId = null;
        
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) {
            parse_str($query, $params);
            if (isset($params['v'])) {
                $videoId = $params['v'];
            }
        }
        
        if (!$videoId) {
            $path = parse_url($url, PHP_URL_PATH);
            if ($path && str_contains($url, 'youtu.be')) {
                $videoId = trim($path, '/');
            }
        }

        if ($videoId) {
            $this->currentEmbedUrl = "https://www.youtube.com/embed/{$videoId}";
        } else {
            $this->currentEmbedUrl = null;
        }
    }
    
    public function getThumbnailUrl($filename)
    {
        $this->generateEmbedUrl($filename);
        $videoId = substr(parse_url($this->currentEmbedUrl, PHP_URL_PATH), 7);
        return $videoId ? "https://img.youtube.com/vi/{$videoId}/mqdefault.jpg" : null;
    }


    public function render()
    {
        return view('livewire.admin.content.video');
    }
}