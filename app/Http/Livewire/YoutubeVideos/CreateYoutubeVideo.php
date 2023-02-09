<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\CreateEntry;
use App\Models\YoutubeVideo;
use App\Traits\DatabaseManager;
use App\Traits\YoutubeVideos\YoutubeVideosTrait;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateYoutubeVideo extends Component
{
    use YoutubeVideosTrait;
    use DatabaseManager;
    protected $paginationTheme = 'bootstrap';
    public string $videoName = '';
    public string $videoIframe = '';
    public bool $isValidCreation = false;

    public $messages = [
        'videoName.required' => 'This field is required.',
        'videoIframe.required' => 'This field is required.',
        'videoIframe.regex' => 'The Iframe is not correct, please copy it again directly from your Youtube video',
    ];

    public function rules()
    {
        return [
            'videoName' => 'required|string|min:3',
            'videoIframe' => 'required|string|regex:' . $this->regexIframe,
        ];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValidCreation = true;
        } catch (ValidationException $ex) {
            $this->isValidCreation = false;
        }

        $this->validateOnly($propertyName);
    }

    public function createEntry()
    {
        if (CreateEntry::run(YoutubeVideo::make(), $this->validate())) {
            $this->notifySuccess = 'Your entry(ies) has/have been successfully created !';
        } else {
            $this->notifyError = true;
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.create-youtube-video');
    }
}
