<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\YoutubeVideos\UpdateYoutubeVideo;
use App\Models\YoutubeVideo;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateYoutubeVideoForm extends Component
{
    use LivewireAlert;
    protected $listeners = ['openEditModalButton'];
    public YoutubeVideo $video;
    public bool $openEditModal = false;
    public bool $isValidUpdate = true;
    public string $name;
    public string $iframe;
    public string $regexIframe = '/^<iframe\s+width="\d{3,4}"\s+height="\d{3,4}"\s+src="https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+"(?:(?!<\/iframe>).)*<\/iframe>$/';

    public $messages = [
        'name.required' => 'This field is required.',
        'iframe.required' => 'This field is required.',
        'iframe.regex' => 'The Iframe is not correct, please copy it again directly from your Youtube video.',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'iframe' => 'required|string|regex:' . $this->regexIframe,
        ];
    }

    public function openEditModalButton($attributes)
    {
        $this->openEditModal = true;
        $this->video = YoutubeVideo::findOrFail($attributes[0]);
        $this->name = $this->video->name;
        $this->iframe = $this->video->iframe;
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValidUpdate = true;
        } catch (ValidationException $ex) {
            $this->isValidUpdate = false;
        }

        $this->validateOnly($propertyName);
    }

    public function UpdateVideo()
    {
        if (UpdateYoutubeVideo::run($this->video, $this->validate())) {
            $this->alert('success', 'Your entry(ies) has/have been successfully updated !');
            $this->openEditModal = false;
            $this->emit('refreshYoutubeTable');
        } else {
            $this->alert('error', 'An error occured !');
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.update-youtube-video-form');
    }
}
