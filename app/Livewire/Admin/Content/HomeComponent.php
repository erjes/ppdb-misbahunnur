<?php
namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\Content; 
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

#[Layout('layouts.landing-page')]

class HomeComponent extends Component
{
    public $videoIndex = 0;
    public Collection $videoContent; 
    public $currentVideo;
    public $embedUrl = null;

    public $posterIndex = 0; 
    public Collection $posterContent;
    public $currentPoster; 

    public function mount()
    {
        $allContent = Content::orderBy('id', 'asc')->get();

        $this->videoContent = $allContent->where('content', 'video');
        $this->posterContent = $allContent->where('content', 'poster');
        
        $this->loadCurrentVideo();
        $this->loadCurrentPoster();
    }

    public function loadCurrentVideo()
    {
        if ($this->videoContent->isNotEmpty()) {
            $this->currentVideo = $this->videoContent->values()->get($this->videoIndex);
            $this->processContentUrl();
        } else {
            $this->currentVideo = null;
            $this->embedUrl = null;
        }
    }

    public function loadCurrentPoster()
    {
        if ($this->posterContent->isNotEmpty()) {
            $this->currentPoster = $this->posterContent->values()->get($this->posterIndex);
        } else {
            $this->currentPoster = null;
        }
    }
    
    public function nextVideo()
    {
        if ($this->videoContent->count() > 0) {
            $maxIndex = $this->videoContent->count() - 1;
            $this->videoIndex = ($this->videoIndex < $maxIndex) ? $this->videoIndex + 1 : 0;
            $this->loadCurrentVideo();
        }
    }

    public function previousVideo()
    {
        if ($this->videoContent->count() > 0) {
            $maxIndex = $this->videoContent->count() - 1;
            $this->videoIndex = ($this->videoIndex > 0) ? $this->videoIndex - 1 : $maxIndex;
            $this->loadCurrentVideo();
        }
    }
    
    // --- Navigasi Poster ---
    public function nextPoster()
    {
        if ($this->posterContent->count() > 0) {
            $maxIndex = $this->posterContent->count() - 1;
            $this->posterIndex = ($this->posterIndex < $maxIndex) ? $this->posterIndex + 1 : 0;
            $this->loadCurrentPoster();
        }
    }

    public function previousPoster()
    {
        if ($this->posterContent->count() > 0) {
            $maxIndex = $this->posterContent->count() - 1;
            $this->posterIndex = ($this->posterIndex > 0) ? $this->posterIndex - 1 : $maxIndex;
            $this->loadCurrentPoster();
        }
    }

    protected function processContentUrl()
    {
        $this->embedUrl = null;

        if ($this->currentVideo) {
            $url = $this->currentVideo->filename; 
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
                $this->embedUrl = "https://www.youtube.com/embed/{$videoId}";
            }
        }
    }

    public function render()
    {
        return view('livewire.home');
    }
}