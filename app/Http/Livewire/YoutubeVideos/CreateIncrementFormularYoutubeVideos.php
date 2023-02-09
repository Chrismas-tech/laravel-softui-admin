<?php

namespace App\Http\Livewire\YoutubeVideos;

use Livewire\Component;

class CreateIncrementFormularYoutubeVideos extends Component
{
    public int $nbForm = 1;

    public function increment()
    {
        if ($this->nbForm < 8) {
            $this->nbForm++;
        }
    }

    public function decrement()
    {
        if ($this->nbForm > 1) {
            $this->nbForm--;
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.create-increment-formular-youtube-videos', ['nbForm' => $this->nbForm]);
    }
}
