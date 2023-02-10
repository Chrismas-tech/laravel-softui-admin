<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\CreateEntry;
use App\Models\YoutubeVideo;
use App\Traits\CrudManager\CrudManager;
use App\Traits\CrudManager\Notifications\Notifications;
use App\Traits\YoutubeVideos\YoutubeVideosTrait;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateYoutubeVideo extends Component
{
    use YoutubeVideosTrait;
    use Notifications;
    public string $modelName = '';
    public string $modelIframe = '';
    public bool $isValidCreation = false;

    public $messages = [
        'modelName.required' => 'This field is required.',
        'modelIframe.required' => 'This field is required.',
        'modelIframe.regex' => 'The Iframe is not correct, please copy it again directly from your Youtube video.',
    ];

    public function rules()
    {
        return [
            'modelName' => 'required|string|min:3',
            'modelIframe' => 'required|string|regex:' . $this->regexIframe,
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
